<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Employer;
use App\Models\JobSeeker;
use App\Models\Job;
use App\Models\User;
use App\Models\JobApplication;
use App\Models\JobTitle;
use App\Notifications\NewJobNotification;
use App\Models\JobCategory;
use App\Models\Skill;
use App\Models\ProfilePicture;
use Carbon\Carbon;


class jobController extends Controller
{
    public function index()
    {
        $jobs = Job::with(['jobTitle', 'category'])
            ->where('status', 'active')
            ->where('expire_date', '>', Carbon::today())
            ->orderByDesc('posted_date')
            ->take(6)
            ->get();

       $categories = JobCategory::withCount([
            'jobs as jobs_count' => function ($query) {
                $query->where('expire_date', '>', Carbon::now())
                    ->where('status', 'active'); // Add this line
            }
        ])
        ->having('jobs_count', '>', 0)
        ->orderByDesc('jobs_count')
        ->get();

        return view('dashboard', compact('jobs', 'categories'));
    }

    public function ActiveJobs()
    {
        $jobs = Job::with(['employer', 'payment']) // assuming there's a relationship
            ->where('status', 'active')
            ->where('expire_date', '>', Carbon::today())
            ->orderByDesc('posted_date')
             ->paginate(10);

        return view('admin.jobs', [
            'jobs' => $jobs,
            'type' => 'active'
        ]);
    }

    public function PendingJobs()
    {
        $jobs = Job::with(['employer', 'payment', 'JobTitle'])
            ->where('status', 'pending')
            ->where('expire_date', '>', Carbon::today())
            ->orderByDesc('posted_date')
             ->paginate(10);

        return view('admin.jobs', [
            'jobs' => $jobs,
            'type' => 'pending'
        ]);
    }

    public function ExpiredJobs()
    {
        $jobs = Job::with(['employer', 'payment'])
            ->where('expire_date', '<=', Carbon::today())
            ->orderByDesc('expire_date')
             ->paginate(10);

        return view('admin.jobs', [
            'jobs' => $jobs,
            'type' => 'expired'
        ]);
    }


    // public function EditJobs($id)
    // {
    //     $job = Job::findOrFail($id);
    //     return view('admin.edit-job', compact('job'));
    // }

    // public function DeleteJobs($id)
    // {
    //     $job = Job::findOrFail($id);
    //     $job->delete();

    //     return redirect()->back()->with('success', 'Job deleted successfully.');
    // }

    public function create()
    {
        $user = Auth::user();
        $profilePath = ProfilePicture::where('user_id', $user->id)->first();
        $employer = Employer::where('user_id', $user->id)->first();
        $jobCategories = JobCategory::all(); // Fetch all categories from DB
        $skills = Skill::all(); // Fetch all skills from DB
        
        return view('post-job', compact('employer', 'jobCategories', 'skills', 'profilePath'));
       
    }

    public function store(Request $request)
    {
        $rules = [
            'category_id'        => 'required|exists:job_category,id',
            'job_title_id'       => 'required|exists:job_title,id',
            'job_type'           => 'required|in:Full-Time,Part-Time,Contract',
            'number_of_vacancies'=> 'required|integer|min:1',
            'salary_basis'       => 'required|in:monthly,yearly,contract',
            'offered_salary'     => 'required|in:fixed,range,negotiable',
            'functional_area'    => 'required|string|max:255',
            'experience'         => 'required|string|max:255',
            'skills'             => 'nullable|array',
            'job_description'    => 'required|string',
            'what_we_offer'      => 'nullable|string',
            'posted_date'        => 'required|date',
            'expire_date'        => 'required|date|after:posted_date',
            'updated_date'       => 'nullable|date',
        ];


         // Add specific salary validation based on salary type
         if ($request->offered_salary === 'fixed' || $request->offered_salary === 'negotiable') {
             $rules['salary'] = 'required|numeric|min:1';
         } elseif ($request->offered_salary === 'range') {
             $rules['min_salary'] = 'required|numeric|min:1';
             $rules['max_salary'] = 'required|numeric|min:1';
         }
     
         $request->validate($rules);
     
         // Get the logged-in employer
         $employer = Auth::user()->employer;
         if (!$employer) {
             return redirect()->back()->with('error', 'You must be an employer to post a job.');
         }
     
         // Generate a unique job ID manually
         do {
             $id = mt_rand(1000, 9999); // Generate a random ID between 1000 and 9999
         } while (Job::where('id', $id)->exists()); // Ensure the ID doesn't already exist
     
         // Prepare job data
         $jobData = [
             'id' => $id,
             'employer_id' => $employer->id,
             'title_id' => $request->job_title_id,
             'category_id' => $request->category_id,
             'skills' => $request->skills ? implode(',', $request->skills) : null,
             'experience' => $request->experience,
             'job_type' => $request->job_type,
             'number_of_vacancies' => $request->number_of_vacancies,
             'salary_basis' => $request->salary_basis,
             'offered_salary' => $request->offered_salary,
             'industry' => $request->industry,
             'functional_area' => $request->functional_area,
             'job_description' => $request->job_description,
             'what_we_offer' => $request->what_we_offer,
             'status' => 'pending',
             'posted_date' => $request->posted_date,
             'expire_date' => $request->expire_date,
             'updated_date' => $request->updated_date,
             
         ];
     
         // Add salary fields conditionally
         if ($request->offered_salary === 'fixed' || $request->offered_salary === 'negotiable') {
             $jobData['salary'] = $request->salary;
         } elseif ($request->offered_salary === 'range') {
             $jobData['min_salary'] = $request->min_salary;
             $jobData['max_salary'] = $request->max_salary;
         }

        $job = Job::create($jobData);
        // Redirect to Esewa page
        return view('esewa', compact('id', 'employer'));
     
     }
     


    /**
     * Display the specified resource.
     */
    public function jobDetails(string $id)
    {
        $job = Job::with(['jobTitle', 'category', 'employer.user'])->findOrFail($id);
        $employer = $job->employer;
        $jobApplied = null;
        $jobseeker = null;
    
        // Check if user is logged in
        if (Auth::check()) {
            $user = Auth::user();
    
            if ($user->role === 'jobseeker') {
                $jobseeker = JobSeeker::where('user_id', $user->id)->first();
            } 
        
            if($jobseeker){
                $exists = JobApplication::where('jobseeker_id', $jobseeker->id)
                ->where('job_id', $job->id)
                ->exists();

                if ($exists){
                $jobApplied= 1;
                } else {
                $jobApplied= 0;
                }
            }
        } else {
            // Even if not logged in, we still want to show the job's employer info
            $employer = Employer::where('id', $job->employer_id)->first();
        }

    
        return view('job-details', compact('job', 'employer', 'jobApplied'));
    }


    public function searchJobTitles(Request $request)
    {
        $searchTerm = $request->get('search');
        $jobTitles = JobTitle::where('name', 'like', '%' . $searchTerm . '%')->get();

        return response()->json(['jobTitles' => $jobTitles]);
    }


    // public function searchJobTitles(Request $request)
    // {
    //     $searchTerm = $request->get('search');

    //     $jobTitles = JobTitle::where('name', 'like', '%' . $searchTerm . '%')
    //         ->whereHas('jobs', function ($query) use ($searchTerm) {
    //             $query->where('status', 'active')
    //                 ->where('functional_area', 'like', '%' . $searchTerm . '%');
    //         })
    //         ->get();

    //     return response()->json(['jobTitles' => $jobTitles]);
    // }




    public function getTitlesByCategory($categoryId)
    {
        $titles = JobTitle::where('category_id', $categoryId)->get();
        return response()->json($titles);
    }


    // public function searchJobs(Request $request)
    // {
    //     $search = $request->input('search');

    //     $jobs = Job::with(['jobTitle', 'category', 'employer'])
    //         ->when($search, function ($query, $search) {
    //             $query->where(function ($q) use ($search) {
    //                 $q->whereHas('jobTitle', function ($q2) use ($search) {
    //                     $q2->where('job_title', 'like', "%$search%");
    //                 })
    //                 ->orWhereHas('category', function ($q2) use ($search) {
    //                     $q2->where('job_category', 'like', "%$search%");
    //                 })
    //                 ->orWhereHas('employer', function ($q2) use ($search) {
    //                     $q2->where('city', 'like', "%$search%");
    //                 })
    //                 ->orWhereRaw("FIND_IN_SET(?, skills)", [$searchSkillId = Skill::where('name', 'like', "%$search%")->value('id')]);
    //             });
    //         })
    //         ->paginate(10);

    //     // Attach skill list (Eloquent collection of Skill models) to each job
    //     foreach ($jobs as $job) {
    //         $skillIds = array_filter(explode(',', $job->skills));
    //         $job->skill_list = Skill::whereIn('id', $skillIds)->get();
    //     }

    //     return view('searched-jobs', compact('jobs', 'search'));
    // }

    public function searchJobs(Request $request)
    {
        $search = $request->input('search');

        $jobs = Job::with(['jobTitle', 'category', 'employer'])
            ->where('status', 'active') // ✅ Only active jobs
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('jobTitle', function ($q2) use ($search) {
                        $q2->where('job_title', 'like', "%$search%");
                    })
                    ->orWhereHas('category', function ($q2) use ($search) {
                        $q2->where('job_category', 'like', "%$search%");
                    })
                    ->orWhere('functional_area', 'like', "%$search%")
                    ->orWhereRaw("FIND_IN_SET(?, skills)", [
                        Skill::where('name', 'like', "%$search%")->value('id')
                    ]);
                });
            })
            ->paginate(10);

        // Attach skill list to each job
        foreach ($jobs as $job) {
            $skillIds = array_filter(explode(',', $job->skills));
            $job->skill_list = Skill::whereIn('id', $skillIds)->get();
        }

        return view('searched-jobs', compact('jobs', 'search'));
    }



    public function jobListByCategory($category_id)
    {
        $category_name = JobCategory::where('id', $category_id)->value('job_category');

        $jobs = Job::with(['jobTitle', 'category', 'employer'])
            ->where('category_id', $category_id)
            ->where('status', 'active') // Only active jobs
            ->where('expire_date', '>', Carbon::now()) // Only jobs that haven't expired
            ->get();

        foreach ($jobs as $job) {
            $skillIds = array_filter(explode(',', $job->skills));
            $job->skill_list = Skill::whereIn('id', $skillIds)->get();
        }

        return view('jobBycategory', compact('jobs', 'category_name'));
    }


    // public function viewJobDetails($job_id)
    // {
    //     $job = Job::with(['jobTitle', 'category', 'employer'])->findOrFail($job_id);
    //     $employer = Employer::where('id', $job->employer_id)->first();
        
    //     return view('admin.viewJobDetails', compact('job', 'employer'));
    // }

}
