<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobCategory;
use App\Models\JobTitle;
use App\Models\Skill;
use App\Models\Employer;
use App\Models\JobSeeker;




class AdminController extends Controller
{
   
    public function showLoginForm()
    {
        return view('admin.adminLogin');
    }

    public function handleLogin(Request $request)
    {
        //Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:super_admin,sub_admin',
        ]);

        //Check credentials and role
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $admin = Auth::guard('admin')->user();

            // Match role
            if ($admin->role !== $request->role) {
                Auth::guard('admin')->logout(); // logout mismatched role
                return redirect()->back()->withErrors(['role' => 'Incorrect role selected.']);
            }

            //Update is_active to true
            $admin->is_active = true;
            $admin->save();

            return redirect()->route('admin.dashboard')->with('success', 'Login successful!');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid email or password.']);
    }

    public function dashboard()
    {
        return view('admin.dashboard', [
        'employersCount' => User::where('role', 'employer')->count(),
        'jobSeekersCount' => User::where('role', 'jobseeker')->count(),

        // Active jobs (assuming 'status' column is used and 'active' means approved/visible)
        'activeJobsCount' => Job::where('status', 'active')->count(),

        // Pending jobs (waiting for admin approval, etc.)
        'pendingJobsCount' => Job::where('status', 'pending')->count(),

        'jobsCount' => Job::count(), // Optional: total jobs (all statuses)
        'applicationsCount' => JobApplication::count(),

        'recentJobs' => Job::latest('posted_date')->take(5)->get(),
    ]);

    }

    public function logout(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        if ($admin) {
            $admin->update(['is_active' => false]); //Mark as inactive
        }
    
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->route('admin.login')->with('success', 'Logged out successfully!');
    }
    
    public function ViewEmployer($id)
    {
        $employer = Employer::with('user')->findOrFail($id);
        return view('admin.view_employer', compact('employer'));
    }

    public function DeleteEmployer($id)
    {
        $employer = Employer::findOrFail($id);

        if ($employer->user) {
            $employer->user->delete(); // Delete associated user
        }

        $employer->delete(); // Delete employer
        return redirect()->back()->with('success', 'Employer deleted successfully.');
    }

    public function UnverifiedEmployers()
    {
        $employers = Employer::whereHas('user', function ($query) {
            $query->where('account_status', '!=', 'verified');
        })->with('user')->paginate(10);

        return view('admin.employer', compact('employers'))->with('type', 'unverified');
    }

    public function VerifiedEmployers()
    {
        $employers = Employer::whereHas('user', function ($query) {
            $query->where('account_status', 'verified');
        })->with('user')->paginate(10);

        return view('admin.employer', compact('employers'))->with('type', 'verified');
    }




    // For Verified
    public function VerifiedJobSeekers()
    {
        $JobSeeker = JobSeeker::whereHas('user', function ($query) {
            $query->where('account_status', 'verified');
        })->with('user')->get();

        return view('admin.jobseeker', compact('JobSeeker'))->with('type', 'verified');
    }

    // For Unverified
    public function UnverifiedJobSeekers()
    {
        $JobSeeker = JobSeeker::whereHas('user', function ($query) {
            $query->where('account_status', '!=', 'verified');
        })->with('user')->get();

        return view('admin.jobseeker', compact('JobSeeker'))->with('type', 'unverified');
    }

    public function DeleteJobSeeker($id)
    {
        $jobseeker = JobSeeker::findOrFail($id);

        if ($jobseeker->user) {
            $jobseeker->user->delete(); // Delete associated user
        }

        $jobseeker->delete(); // Delete jobseeker
        return redirect()->back()->with('success', 'JobSeeker deleted successfully.');
    }


    public function ViewJobSeeker($id)
    {
        $jobseeker = JobSeeker::with('user')->findOrFail($id);
        return view('admin.view_jobseeker', compact('jobseeker'));
    }

    public function ViewJobDetails($id)
    {
        // $job = Job::with('employer')->findOrFail($id);
        // return view('admin.view-job', compact('job'));
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

    
        return view('admin.view-job', compact('job', 'employer', 'jobApplied'));
    }

    // Delete a job
    public function destroyJobs($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();
        return redirect()->back()->with('success', 'Job deleted successfully.');
    }

    public function approveJobs($job_id)
    {
        $job = Job::findOrFail($job_id);
        $job->status = 'active';
        $job->save();
        return redirect()->back()->with('success', 'Job approved successfully.');
    }


    public function view($id)
    {
        $job = Job::with(['jobTitle', 'category', 'employer.user'])->findOrFail($id);
        $employer = $job->employer;
        $jobApplied = null;
        $jobseeker = null;

        if (Auth::check()) {
            $user = Auth::user();

            if ($user->role === 'jobseeker') {
                $jobseeker = JobSeeker::where('user_id', $user->id)->first();

                if ($jobseeker) {
                    $jobApplied = JobApplication::where('jobseeker_id', $jobseeker->id)
                        ->where('job_id', $job->id)
                        ->exists() ? 1 : 0;
                }
            }
        } else {
            // Even if not logged in, fetch employer
            $employer = Employer::find($job->employer_id);
        }

        return response()->json([
            'id' => $job->id,
            'title' => $job->jobTitle->job_title ?? '-',
            'description' => $job->job_description,
            'category' => $job->category->job_category ?? '-',
            'location' => $employer->city ?? '-',
            'posted_date' => \Carbon\Carbon::parse($job->posted_date)->format('F d, Y'),
            'status' => ucfirst($job->status),
            'company' => $employer->company_name ?? '-',
            'employer_email' => $employer->user->email ?? '-',
            'job_applied' => $jobApplied,
        ]);
    }



}
