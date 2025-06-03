<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\JobSeeker;
use App\Models\JobApplication;
use App\Models\ProfilePicture;
use Illuminate\Http\Request;

class jobSeekerController extends Controller
{
  
    // // For Verified
    // public function VerifiedJobSeekers()
    // {
    //     $JobSeeker = JobSeeker::whereHas('user', function ($query) {
    //         $query->where('account_status', 'verified');
    //     })->with('user')->get();

    //     return view('admin.jobseeker', compact('JobSeeker'))->with('type', 'verified');
    // }

    // // For Unverified
    // public function UnverifiedJobSeekers()
    // {
    //     $JobSeeker = JobSeeker::whereHas('user', function ($query) {
    //         $query->where('account_status', '!=', 'verified');
    //     })->with('user')->get();

    //     return view('admin.jobseeker', compact('JobSeeker'))->with('type', 'unverified');
    // }

    // public function DeleteJobSeeker($id)
    // {
    //     $jobseeker = JobSeeker::findOrFail($id);

    //     if ($jobseeker->user) {
    //         $jobseeker->user->delete(); // Delete associated user
    //     }

    //     $jobseeker->delete(); // Delete jobseeker
    //     return redirect()->back()->with('success', 'JobSeeker deleted successfully.');
    // }


    // public function ViewJobSeeker($id)
    // {
    //     $jobseeker = JobSeeker::with('user')->findOrFail($id);
    //     return view('admin.view_jobseeker', compact('jobseeker'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $profilePath = ProfilePicture::where('user_id', $user->id)->first();
        $jobSeeker = JobSeeker::where('user_id', $user->id)->first();

        // If no JobSeeker is found, redirect to a different page or show an error
        if (!$jobSeeker) {
            return redirect()->route('dashboard')->with('error', 'Please complete your job seeker profile.');
        }
        
        return view('jobSeekerInformation', compact('jobSeeker', 'profilePath'));
    }

   
    public function store(Request $request)
    {
        // Validate input fields
        $validated = $request->validate([
            'user_id'        => 'required|exists:users,id',
            'fName'          => 'required|string|max:255',
            'lName'          => 'required|string|max:255',
            'mName'          => 'required|string|max:255',
            'dob'            => 'required|date',
            'gender'         => 'required|in:male,female,other',
            'maritalStatus'  => 'required|in:single,married',
            'country'        => 'required|string|max:255',
            'province'       => 'required|integer|min:1|max:7',
            'city'           => 'required|string|max:255',
        ]);

        // Get the logged-in user
        $user = Auth::user();

        // Update or create jobseeker information
        $jobseeker = JobSeeker::updateOrCreate(
            ['user_id' => $user->id], // Match the jobseeker by user_id
            [
                'fname'           => $validated['fName'],
                'lname'           => $validated['lName'],
                'mname'           => $validated['mName'],
                'dob'             => $validated['dob'],
                'gender'          => $validated['gender'],
                'marital_status'  => $validated['maritalStatus'],
                'country'         => $validated['country'],
                'province'        => $validated['province'],
                'city'            => $validated['city'],
            ]
        );

        // Redirect back with success message
        return redirect()->route('jobSeekerInformation')->with('success', 'jobseeker information updated successfully!');
    }

    public function appliedJobs(){
        // Check if user is logged in
        if (Auth::check()) {
            $user = Auth::user();
            $profilePath = ProfilePicture::where('user_id', $user->id)->first();
            $jobSeeker = JobSeeker::where('user_id', $user->id)->first();
            $jobApplications = JobApplication::where('jobseeker_id', $jobSeeker->id)->orderBy('created_at', 'desc')->get();
            return view('applied-jobs', compact('jobSeeker', 'jobApplications', 'profilePath'));
        } else {
            return redirect()->route('login')->with('error', 'You must be logged in to view this page.');
        }
        
    }

}
