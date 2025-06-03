<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employer;
use App\Models\JobSeeker;
use App\Models\ProfilePicture;
use App\Models\Resume;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    // Handle registration
    public function handleRegister(Request $request)
    {
        try {

            if($request->role == 'employer') {

                $validatedData = $request->validate([
                    'role' => 'required|in:employer,jobseeker',
                    'password' => 'required|min:6',
                    'email' => 'required|email|unique:users,email',
                    'contact_number' => 'required|digits:10|unique:users,contact_number',
                    'companyName' => 'required|string|max:255',
                    'country' => 'required|string|max:255',
                    'province' => 'required|string|max:255',
                    'city' => 'required|string|max:255',
                    'organizationType' => 'nullable|string|max:255',
                    'website' => 'nullable|url',
                    'aboutCompany' => 'nullable|string',
                ]);

                do {
                    $id = mt_rand(100, 999);
                } while (User::where('id', $id)->exists());

                do {
                    $employer_id = mt_rand(100, 999);
                } while (Employer::where('id', $employer_id)->exists());
    
                // Generate OTP
                $otp = rand(100000, 999999);
    
                // Send OTP via email
                Mail::send('emails.otp', ['otp' => $otp], function ($message) use ($request) {
                    $message->to($request->email)
                            ->subject('Your OTP Code');
                });

                // Store user in the database
                $user = User::create([
                    'id' => $id,
                    'role' => $request->role,
                    'password' => Hash::make($request->password), // Hash password
                    'otp' => $otp,
                    'contact_number' => $request->contact_number,
                    'email' => $request->email,
                ]);

                $employer = Employer::create([
                    'id' => $employer_id,
                    'user_id' => $id,
                    'company_name' => $request->companyName,
                    'country' => $request->country,
                    'province' => $request->province,
                    'city' => $request->city,
                    'organization_type' => $request->organizationType,
                    'website' => $request->website,
                    'about_company' => $request->aboutCompany,
                ]);

                // Store user ID in session to track OTP verification
                Session::put('pending_user_id', $id);

                // Show OTP input form
                return view('auth.otp', ['user_id' => $id]);

            } else {

                $validatedData = $request->validate([
                    'role'           => 'required|in:employer,jobseeker',
                    'password'       => 'required|min:6',
                    'email' => 'required|email|unique:users,email',
                    'contact_number' => 'required|digits:10|unique:users,contact_number',
                    'fName'          => 'required|string|max:50',
                    'lName'          => 'required|string|max:50',
                    'mName'          => 'nullable|string|max:50',
                    'dob'            => 'required|date',
                    'gender'         => 'required|in:male,female,other',
                    'maritalStatus'  => 'required|in:single,married',
                    'country'        => 'required|string|max:255',
                    'province'       => 'required|integer|min:1|max:7',
                    'city'           => 'required|string|max:255',
                ]   );

                do {
                    $id = mt_rand(100, 999);
                } while (User::where('id', $id)->exists());

                // Generate OTP
                $otp = rand(100000, 999999);

                // Send OTP via email
                Mail::send('emails.otp', ['otp' => $otp], function ($message) use ($request) {
                    $message->to($request->email)
                            ->subject('Your OTP Code');
                });

                // Store user in the database
                $user = User::create([
                    'id'                => $id,
                    'role'              => $request->role,
                    'password'          => Hash::make($request->password), // Hash password
                    'otp'               => $otp,
                    'contact_number'    => $request->contact_number,
                    'email'             => $request->email,
                ]);

                $jobseeker = JobSeeker::create([
                    'user_id'         => $id,
                    'fname'           => $request->fName,
                    'lname'           => $request->lName,
                    'mname'           => $request->mName,
                    'dob'             => $request->dob,
                    'gender'          => $request->gender,
                    'marital_status'  => $request->maritalStatus,
                    'country'         => $request->country,
                    'province'        => $request->province,
                    'city'            => $request->city,
                ]);

               

                // Store user ID in session to track OTP verification
                Session::put('pending_user_id', $id);

                // Show OTP input form
                return view('auth.otp', ['user_id' => $id]);

            }

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
            // return back()->with('error', 'Email has been already taken or An error occurred during registration.');
        }
    }


    // Handle OTP verification
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::where('id', $request->user_id)->where('otp', $request->otp)->first();

        if ($user) {
            // OTP matched, activate account and clear OTP
            $user->update([
                'otp' => null,
                'account_status' => 'verified',
                'email_status' => 'verified',
            ]);

            // Remove session
            Session::forget('pending_user_id');

            return redirect()->route('login')->with('success', 'Account created successfully! Please login.');
        }

        // return back()->withErrors(['otp' => 'Invalid OTP, please try again.']);
        return redirect()->route('otp', ['user_id' => $request->user_id])
        ->withErrors(['otp' => 'Invalid OTP, please enter correct 6 digit otp.']);
    }

    // Handle user leaving OTP page without verification
    public function cancelOtpVerification()
    {
        if (Session::has('pending_user_id')) {
            $userId = Session::get('pending_user_id');

            // Delete user from database
            User::where('id', $userId)->delete();

            // Clear session
            Session::forget('pending_user_id');
        }

        return redirect()->route('registerJobSeeker')->with('error', 'Registration canceled. Please try again.');
    }

    public function UploadPhoto(Request $request)
    {
        $request->validate([
            'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Handle Profile Picture Upload
        $profilePicPath = null;
        if ($request->hasFile('profile_pic')) {
            $profilePicPath = $request->file('profile_pic')->store('profile_pics', 'public');
        }

        $user = Auth::user();
        // Update or create profile picture
        ProfilePicture::updateOrCreate(
            ['user_id' => $user->id],
            ['file_path' => $profilePicPath],
        );
        return redirect()->back()->with('success', 'Profile picture updated successfully.');
    }
   

    public function deletePhoto(Request $request)
    {
        $user = auth()->user();
        $profilePicture = $user->profilePicture;
        $resume = $user->resume;

        if ($profilePicture && $profilePicture->file_path) {
            // Delete the file from storage if it exists
            if (Storage::exists($profilePicture->file_path)) {
                Storage::delete($profilePicture->file_path);
            }

            // Delete the profile picture record
            $profilePicture->delete();
        }
        
        // Set profile_pic to null in resume table
        if ($resume) {
            $resume->profile_pic = null;
            $resume->save();
        }

        return back()->with('success', 'Profile picture deleted successfully.');
    }
}
