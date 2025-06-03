<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\Jobseeker;
use App\Models\Employer;
use App\Models\ProfilePicture;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Mail;

class JobApplicationController extends Controller
{
     public function applyForJobs($job_id)
    {
        // Get the currently logged-in user
        $user = Auth::user();

        // Fetch the jobseeker record using the user ID
        $jobseeker = Jobseeker::where('user_id', $user->id)->first();

        // Store the application
        JobApplication::create([
            'job_id' => $job_id,
            'jobseeker_id' => $jobseeker->id,
            'status' => 'pending' // optional, default
        ]);

        return back()->with('success', 'Application submitted successfully!');
    }

    public function JobApplications()
    {
        $employer = auth()->user()->employer; 
        $user = Auth::user();
        $profilePath = ProfilePicture::where('user_id', $user->id)->first();
        $applications = Job::with(['jobTitle', 'category', 'employer'])
        ->withCount('applications') // adds `applications_count`
        ->where('employer_id', $employer->id)
        ->where('status', 'active')
        ->get();
        
        return view('applications', compact('applications', 'employer', 'profilePath'));
        
    }

    public function JobApplicants($job_id)
    {
        $employer = auth()->user()->employer;
        $user = Auth::user();
        $profilePath = ProfilePicture::where('user_id', $user->id)->first();
        $jobApplications = JobApplication::with(['jobseeker.user.resume', 'job'])
        ->where('job_id', $job_id)->get();

        $applicationCount = $jobApplications->count();


        
        return view('jobApplicants', compact('jobApplications', 'applicationCount', 'employer', 'profilePath'));
        
    }


    public function rejectApplication($applicant_id)
    {
        $employer = auth()->user()->employer; 
        $company = Employer::with('user')->findOrFail($employer->id);
        $application = JobApplication::with('jobseeker.user')->findOrFail($applicant_id);

        $applicant_email = $application->jobseeker->user->email;
        $data = [
            'token' => $application->jobseeker->id + $employer->id,
            'applicant_fname' => $application->jobseeker->fname,
            'applicant_lname' => $application->jobseeker->lname,
            'company_name' => $company->company_name,
            'company_email' => $company->user->email,
            'company_phone' => $company->user->contact_number,
            'company_address' => $company->country,
            'company_website' => $company->website,
            // 'interview_date' => $request->interview_date,
            // 'meet_link' => $request->meet_link,
        ];

        $RejectApplication = Mail::send('emails.rejectApplication', $data, function ($message) use ($applicant_email) {
            $message->to($applicant_email)
            ->subject('Reject Job Application');
        });

        if($RejectApplication ){
            $application->status = 'rejected';
            $application->save();
            return back()->with('success', 'Application rejected successfully.');
        }
    }


    public function sendJobInterviewEmail(Request $request, $applicant_id)
    {
        $request->validate([
            'interview_date' => 'required|date',
            'meet_link' => 'nullable|url',
        ]);

        $employer = auth()->user()->employer; 
        $company = Employer::with('user')->findOrFail($employer->id);
        $application = JobApplication::with('jobseeker.user')->findOrFail($applicant_id);

        $applicant_email = $application->jobseeker->user->email;
        $data = [
            'token' => $application->jobseeker->id + $employer->id,
            'applicant_fname' => $application->jobseeker->fname,
            'applicant_lname' => $application->jobseeker->lname,
            'company_name' => $company->company_name,
            'company_email' => $company->user->email,
            'company_phone' => $company->user->contact_number,
            'company_address' => $company->country,
            'company_website' => $company->website,
            'interview_date' => $request->interview_date,
            'meet_link' => $request->meet_link,
        ];

        $InterViewEmail = Mail::send('emails.acceptApplication', $data, function ($message) use ($applicant_email) {
            $message->to($applicant_email)
                    ->subject('Interview Invitation');
        });

        if($InterViewEmail){
             $application->status = 'accepted';
            $application->save();
            return back()->with('success', 'Interview invitation sent.');
        }
       
       
    }


}
