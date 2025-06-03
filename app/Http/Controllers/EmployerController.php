<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Employer;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Models\ProfilePicture;
use App\Models\Job;


class employerController extends Controller
{
   
    public function index()
    {
        $employers = Employer::with('user')->get();
        return view('admin.employer', compact('employers'));
    }

    // For Verified Employers
    // public function VerifiedEmployers()
    // {
    //     $employers = Employer::whereHas('user', function ($query) {
    //         $query->where('account_status', 'verified');
    //     })->with('user')->paginate(10);

    //     return view('admin.employer', compact('employers'))->with('type', 'verified');
    // }

    // For Unverified Employers
    // public function UnverifiedEmployers()
    // {
    //     $employers = Employer::whereHas('user', function ($query) {
    //         $query->where('account_status', '!=', 'verified');
    //     })->with('user')->paginate(10);

    //     return view('admin.employer', compact('employers'))->with('type', 'unverified');
    // }


    // public function ViewEmployer($id)
    // {
    //     $employer = Employer::with('user')->findOrFail($id);
    //     return view('admin.view_employer', compact('employer'));
    // }

    // public function DeleteEmployer($id)
    // {
    //     $employer = Employer::findOrFail($id);

    //     if ($employer->user) {
    //         $employer->user->delete(); // Delete associated user
    //     }

    //     $employer->delete(); // Delete employer
    //     return redirect()->back()->with('success', 'Employer deleted successfully.');
    // }

    
    public function store(Request $request)
    {
        // Validate input fields
        $request->validate([
            'companyName' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'organizationType' => 'nullable|string|max:255',
            'website' => 'nullable|url',
            'aboutCompany' => 'nullable|string',
        ]);

        // Get the logged-in user
        $user = Auth::user();

        // Update or create employer information
        $employer = Employer::updateOrCreate(
            ['user_id' => $user->id], // Match the employer by user_id
            [
                'company_name' => $request->companyName,
                'country' => $request->country,
                'province' => $request->province,
                'city' => $request->city,
                'organization_type' => $request->organizationType,
                'website' => $request->website,
                'about_company' => $request->aboutCompany,
            ]
        );

        // Redirect back with success message
        return redirect()->route('companyInformation')->with('success', 'Company information updated successfully!');
    }


    public function CompanyInformationForm()
    {
        $user = Auth::user();
        $profilePath = ProfilePicture::where('user_id', $user->id)->first();
        $employer = Employer::where('user_id', $user->id)->first();
        
        return view('companyInformation', compact('employer', 'profilePath'));
    }

    public function viewApplications()
    {
        $user = Auth::user();
        $employer = Employer::where('user_id', $user->id)->first();
        $applications = JobApplication::with([
            'jobseeker.user.resume',
            // 'jobseeker.resume',
            'job.jobTitle'
        ])->get();
        return view('applications', compact('applications', 'employer'));
    }

    
    public function myPostedJobs()
    {
        $employer = auth()->user()->employer; 
        $user = Auth::user();
        $profilePath = ProfilePicture::where('user_id', $user->id)->first();
        $jobs = Job::with(['jobTitle', 'employer', 'payment'])
        // ->withCount('applications') // adds `applications_count`
        ->where('employer_id', $employer->id)
        ->get();
        
        return view('my-jobs', compact('jobs', 'employer', 'profilePath'));
    }

}
