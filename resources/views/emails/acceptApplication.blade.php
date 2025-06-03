<p>Token no. {{$token}}</p>
<p>Dear {{ $applicant_fname}} {{ $applicant_lname}},</p>

<p>You have been selected for an interview.BY {{$company_name}} Company.</p>

<p><strong>Interview Date & Time:</strong> {{ \Carbon\Carbon::parse($interview_date)->format('F j, Y, g:i A') }}</p>

@if ($meet_link)
    <p><strong>Interview Link:</strong> <a href="{{ $meet_link }}">{{ $meet_link }}</a></p>
@endif

<p>Please be available on time.</p>
<p>If you have any questions, feel free to reach out to us at <a href="mailto:{{ $company_email }}">{{ $company_email }}</a> or call us at {{ $company_phone }}.</p>
<p>Company Address: {{ $company_address }}</p>
<p>Company Website: <a href="{{ $company_website }}">{{ $company_website }}</a></p>
<p>We wish you the best of luck!</p>
<p>Thank you for your interest in joining our team.</p>

{{-- <p>Best regards,<br>HR Team</p> --}}
