<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobSeekerController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CVController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\WalletController;



//dashboard route
Route::get('/', [JobController::class, 'index'])->name('dashboard');

// Show registration form route and handle registration
Route::view('/registerJobSeeker', 'auth.registerJobSeeker')->name('registerJobSeeker')->middleware('guest');
Route::view('/registerEmployer', 'auth.registerEmployer')->name('registerEmployer')->middleware('guest');
Route::post('/register', [UserController::class, 'handleRegister'])->name('register')->middleware('guest');


// Show OTP form route and handle OTP verification
Route::get('/otp/{user_id}', function ($user_id) {
    return view('auth.otp', ['user_id' => $user_id]);
})->name('otp');

Route::post('/verify-otp', [UserController::class, 'verifyOtp'])->name('verifyOtp');
Route::post('/cancel-otp', [UserController::class, 'cancelOtpVerification'])->name('cancelOtp');

// Show login form route
Route::view('/login', 'auth.login')
->middleware('guest') // Restrict access to only logged-out users
->name('login');


// Handle login
Route::post('/login', [AuthController::class, 'login'])->name('login');
// Handle logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


Route::view('forgot-password', 'auth.forgot-password')->middleware('guest')->name('password.request'); // Show forgot password form
Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->middleware('guest')->name('password.email');  // Handle form submit
Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');  // Show reset password form
Route::post('reset-password', [NewPasswordController::class, 'resetPassword'])->middleware('guest')->name('password.update');  // Handle password reset

// Change passwordForm route
// Route::view('/change-password', 'auth.changePassword')->middleware('auth') ->name('change.password');
// Change password handle route
Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('change-password')->middleware('auth');
















//job-post form route
Route::get('/postJob', [JobController::class, 'create'])->name('postJob')->middleware('auth');

//job-post store route
Route::post('/postJob', [JobController::class, 'store'])->name('postJob.store');

//job-post delete route
Route::delete('/jobs-destroy/{id}', [JobController::class, 'destroy'])->name('jobs-destroy');


//companyInformation form route
Route::get('/company-information', [EmployerController::class, 'CompanyInformationForm'])->name('companyInformation')->middleware('auth');

//companyInformation store route
Route::post('/company-information/store', [EmployerController::class, 'store'])->name('companyInformation.store');

//jobSeekerinformation form route
Route::get('/JobSeeker-information', [jobSeekerController::class, 'create'])->name('jobSeekerInformation')->middleware('auth');

//jobSeekerInformation store route
Route::post('/JobSeeker-information/store', [jobSeekerController::class, 'store'])->name('jobSeekerInformation.store');

//Job-Details route
Route::get('/job-details/{id}', [JobController::class, 'jobDetails'])->name('job-details');


//acount-setting route
Route::get('/account-setting', [ProfileController::class, 'AccountSetting'])->middleware('auth')->name('account-setting');

//my-jobs route
Route::get('/my-jobs', [EmployerController::class, 'myPostedJobs'])->name('my-jobs')->middleware('auth');

//find-jobs route
Route::get('/find-jobs', [JobController::class, 'findJobs'])->name('find-jobs')->middleware('auth');

//applied-jobs route
Route::get('/applied-jobs', [JobSeekerController::class, 'appliedJobs'])->name('applied-jobs')->middleware('auth');

//apply-for-job route
Route::get('/apply-for-job/{jobId}', [JobApplicationController::class, 'applyForJobs'])->name('apply-for-job')->middleware('auth');

//job-application route
Route::get('/applications', [JobApplicationController::class, 'JobApplications'])->name('applications')->middleware('auth');
Route::get('/applicants/{job_id}', [JobApplicationController::class, 'JobApplicants'])->name('applicants')->middleware('auth');

//accept and reject application route
Route::get('/reject-applicants/{applicant_id}', [JobApplicationController::class, 'rejectApplication'])->name('reject-applicants')->middleware('auth');

Route::post('/interview/send/{id}', [JobApplicationController::class, 'sendJobInterviewEmail'])->name('send.interview.invitation');





//admin route

Route::prefix('admin')->name('admin.')->group(function () {
    
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminController::class, 'handleLogin'])->name('login');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/admin/jobs/view/{job_id}', [AdminController::class, 'view'])->name('admin.jobs.view');


       
        Route::get('/VerifiedEmployers', [AdminController::class, 'VerifiedEmployers'])->name('VerifiedEmployers');
        Route::get('/UnverifiedEmployers', [AdminController::class, 'UnverifiedEmployers'])->name('UnverifiedEmployers');
        Route::get('/ViewEmployer/{id}', [AdminController::class, 'ViewEmployer'])->name('ViewEmployer');
        Route::delete('/DeleteEmployer/{id}', [AdminController::class, 'DeleteEmployer'])->name('DeleteEmployer');


        Route::get('/VerifiedJobSeekers', [AdminController::class, 'VerifiedJobSeekers'])->name('VerifiedJobSeekers');
        Route::get('/UnverifiedJobSeekers', [AdminController::class, 'UnverifiedJobSeekers'])->name('UnverifiedJobSeekers');
         Route::get('/ViewJobSeeker/{id}', [AdminController::class, 'ViewJobSeeker'])->name('ViewJobSeeker');
        Route::delete('/DeletejobSeeker/{id}', [AdminController::class, 'DeleteJobSeeker'])->name('DeleteJobSeeker');

        Route::get('/ActiveJobs', [JobController::class, 'ActiveJobs'])->name('ActiveJobs');
        Route::get('/PendingJobs', [JobController::class, 'PendingJobs'])->name('PendingJobs');
        Route::get('/ExpiredJobs', [JobController::class, 'ExpiredJobs'])->name('ExpiredJobs');

        Route::get('/ViewJobs/{id}', [AdminController::class, 'ViewJobDetails'])->name('ViewJobs');
        // Route::get('/EditJobs/{id}', [JobController::class, 'edit'])->name('EditJobs');
        Route::delete('/DeleteJobs/{id}', [AdminController::class, 'destroyJobs'])->name('DeleteJobs');

        Route::get('/job-payments', [PaymentController::class, 'makeJobPayment'])->name('payments');
        Route::get('/approve-jobs/{job_id}', [AdminController::class, 'approveJobs'])->name('approve-jobs');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
        
    });
});





//route for payment success 
Route::get('/payment-success', [PaymentController::class, 'handlePaymentaymentSuccess'])->name('payment-success');

//route for payment fail
Route::get('/payment-fail', [PaymentController::class, 'handlePaymentFail'])->name('payment-fail');





//route to show form for resume
Route::get('/resume', [ResumeController::class, 'create'])->name('resume')->middleware('auth');
//route to store resume data
Route::post('/resume/generate', [ResumeController::class, 'storeResumeData'])->name('resume.generate');
//route to download resume
Route::get('/download-resume', [ResumeController::class, 'downloadResume'])->name('downloadResume')->middleware('auth');


Route::get('/api/job-titles/{categoryId}', [JobController::class, 'getTitlesByCategory']);

//route to shows the searched jobs
Route::get('/jobs/search', [JobController::class, 'searchJobs'])->name('searchJobs');

//job by category
Route::get('/jobs/byCategory/{category_id}', [JobController::class, 'jobListByCategory'])->name('jobListByCategory');




Route::get('/skill-search', [ResumeController::class, 'searchSkills'])->name('skills.search');
// Route::get('/wallet/balance', [WalletController::class, 'getWalletBalance'])->middleware('auth');

// web.php
Route::post('/jobseeker/photo/upload', [JobSeekerController::class, 'uploadPhoto'])->name('jobseeker.photo.upload');
Route::delete('/jobseeker/photo/delete', [JobSeekerController::class, 'deletePhoto'])->name('jobseeker.photo.delete');


// Route::get('/resume', function () {
//     return view('resumeTemplate');
// });


// user.photo.upload
Route::post('/user-photo-upload', [UserController::class, 'UploadPhoto'])->name('user-photo-upload');
// user.photo.delete
Route::delete('/user-photo-delete', [UserController::class, 'deletePhoto'])->name('user-photo-delete');