<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   
      // Handle login logic
      public function login(Request $request)
      {
          $request->validate([
              'email' => 'required|email',
              'password' => 'required',
              'remember' => 'nullable',
          ]);
      
          $credentials = $request->only('email', 'password');
          $remember = $request->has('remember'); // Check if 'remember' is checked
      
          if (Auth::attempt($credentials, $remember)) {
              $user = Auth::user();
              
              // Update active status to 'online'
              $user->update(['active_status' => 'online']);
      
              return redirect()->route('dashboard')->with('success', 'Login successful!');
          }
      
          return back()->withErrors(['email' => 'Invalid credentials.']);
      }
  
      // Handle logout
      public function logout(Request $request)
      {

          // Update active_status to 'offline' before logout
          User::where('id', Auth::id())->update(['active_status' => 'offline']);

          Auth::logout(); // Logs out the user
  
          // Invalidate session & regenerate the CSRF token
          $request->session()->invalidate();
          $request->session()->regenerateToken();
  
          return redirect()->route('dashboard')->with('success', 'Logged out successfully.');
      }
}
