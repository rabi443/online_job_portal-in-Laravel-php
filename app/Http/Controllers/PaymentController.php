<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Employer;
use App\Models\JobSeeker;
use App\Models\User;
use App\Models\JobApplication;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    //if payment is successful
    public function handlePaymentaymentSuccess(Request $request)
    {
        $jobId = $request->query('job_id');
        $amount = $request->query('amount');
        $taxAmount = $request->query('tax_amount');
        $totalAmount = $request->query('total_amount');
        $job = Job::find($jobId);

        if ($job) {

            // Create payment record
            Payment::create([
                'job_id' => $job->id,
                'payment_status' => 'success',
            ]);

            return redirect()->route('postJob')->with('success', 'Payment successful.');
        } else {
            return redirect()->route('postJob')->with('error', 'payment unsucessful.');
        }
    }

    //if payment is failed
    public function handlePaymentFail(Request $request)
    {
        $jobId = $request->query('job_id');
        $amount = $request->query('amount');
        $taxAmount = $request->query('tax_amount');
        $totalAmount = $request->query('total_amount');
        $job = Job::find($jobId);
        

         if ($job) {

            // Create payment record
            Payment::create([
                'job_id' => $job->id,
                'payment_status' => 'failed',
            ]);

            return redirect()->route('postJob')->with('error', 'Payment Failed! Please try again.');
        } else {
            return redirect()->route('postJob')->with('error','Please try again.');
        }
        
    }

    public function makeJobPayment(){

        $payments = Payment::whereHas('job', function ($query) {
        $query->where('status', 'pending');
        })->get();

        return view('admin.jobPayment', compact('payments')); // pass data to the view
    }
}
