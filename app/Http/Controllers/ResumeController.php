<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Resume;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\JobSeeker;
use App\Models\Skill;
use App\Models\ProfilePicture;


class ResumeController extends Controller
{

    public function create()
    {
        $skills = Skill::all();
          // Check if user is logged in
          if (Auth::check()) {
            $user = Auth::user();

            // Load the resume if it exists
            $resume = Resume::where('user_id', $user->id)->first();
            $profilePath = ProfilePicture::where('user_id', $user->id)->first();

            if ($resume) {
                // Decode before sending to view
                $resume['experience'] = json_decode($resume['experience'], true);
                $resume['education'] = json_decode($resume['education'], true);
                $resume['skills'] = $resume['skills'] ? explode(',', $resume['skills']) : [];

                $jobSeeker = JobSeeker::with('user')->where('user_id', $user->id)->first();
                return view('resume.form', compact('jobSeeker','skills', 'resume', 'profilePath'));
            } else {
                // If no resume exists, return an empty form
                $jobSeeker = JobSeeker::with('user')->where('user_id', $user->id)->first();
                return view('resume.form', compact('jobSeeker', 'skills', 'resume', 'profilePath'));
            }
           
        } else {
           return redirect()->route('login')->with('error', 'You must be logged in to view this page.');
        }
    }

    public function storeResumeData(Request $request)
    {
        $user = Auth::user();
         // Validate form data
         $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'location' => 'required|string',
            'linkedin' => 'nullable|url',
            'summary' => 'required|string',
            'experience' => 'required|array',
            'education' => 'required|array', // ✅ Add this line
            // 'skills' => 'required|string',
            'skills' => 'nullable|array',
            // 'template' => 'required|in:basic,modern,elegant,creative,professional',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle Profile Picture Upload
        $profilePicPath = null;
        if ($request->hasFile('profile_pic')) {
            $profilePicPath = $request->file('profile_pic')->store('profile_pics', 'public');
        }

        // Prepare Data for Resume
        $data = [
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'location' => $validated['location'],
            'linkedin' => $validated['linkedin'],
            'summary' => $validated['summary'],
            'experience' => json_encode($validated['experience']),
            'education' => json_encode($validated['education']),
            'skills' => $request->skills ? implode(',', $request->skills) : null,
            'profile_pic' => $profilePicPath,
        ];

        // Store the Resume in the Database
        Resume::updateOrCreate(['user_id' => $user->id],$data);

        if($profilePicPath){
             ProfilePicture::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'user_id' => $user->id,
                    'file_path' => $profilePicPath,

                ]
            );
        }
       

        // Decode before sending to view
        $data['experience'] = json_decode($data['experience'], true);
        $data['education'] = json_decode($data['education'], true);
        $data['skills'] = $data['skills'] ? explode(',', $data['skills']) : [];

        return back()->with('success', 'Your resume has been created and saved as PDF successfully.');

    }


    public function downloadResume()
    {
        $user = Auth::user();
        $resume = Resume::where('user_id', $user->id)->firstOrFail();
         // Decode before sending to view
        $resume['experience'] = json_decode($resume['experience'], true);
        $resume['education'] = json_decode($resume['education'], true);
        $resume['skills'] = $resume['skills'] ? explode(',', $resume['skills']) : [];
        $templateView = 'resume.templates.' . 'basic';
        return Pdf::loadView($templateView, compact('resume'))
                ->setPaper('A4')
                ->download('resume_' . $resume->name . '.pdf');
    }
  

}
