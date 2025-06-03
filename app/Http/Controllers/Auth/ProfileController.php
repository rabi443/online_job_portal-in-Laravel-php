<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employer;
use App\Models\ProfilePicture;
use App\Models\JobSeeker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    // public function ChangePasswordForm()
    // {
    //     return view('auth.changePassword');
    // }

    public function changePassword(Request $request)
    {
        // Validate input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Check if the current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Old password is incorrect.']);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password updated successfully');
    }

    public function AccountSetting()
    {
        $user = Auth::user();
        $profilePath = ProfilePicture::where('user_id', $user->id)->first();
        if ($user->role == 'jobseeker') {
            $jobSeeker = JobSeeker::where('user_id', $user->id)->first();
            return view('account-setting', compact('jobSeeker', 'profilePath'));
        } elseif ($user->role == 'employer') {
            $employer = Employer::where('user_id', $user->id)->first();
            return view('account-setting', compact('employer', 'profilePath'));
        }

        // fallback if role doesn't match
        return redirect()->back()->with('error', 'Unknown user role.');
    }
}

