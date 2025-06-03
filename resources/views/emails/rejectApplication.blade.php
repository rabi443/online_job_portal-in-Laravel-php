<p><strong>Application Token:</strong> {{ $token }}</p>

<p>Dear {{ $applicant_fname }} {{ $applicant_lname }},</p>

<p>Thank you for taking the time to apply to <strong>{{ $company_name }}</strong>. After careful consideration, we regret to inform you that your application has not been selected for further processing at this time.</p>

<p>We truly appreciate your interest in joining our team and the effort you put into your application.</p>

<p>If you have any questions or would like feedback, feel free to contact us at <a href="mailto:{{ $company_email }}">{{ $company_email }}</a> or call us at {{ $company_phone }}.</p>

<p><strong>Company Address:</strong> {{ $company_address }}</p>
<p><strong>Website:</strong> <a href="{{ $company_website }}">{{ $company_website }}</a></p>

<p>We wish you all the best in your job search and future professional endeavors.</p>

<p>Kind regards,</p>
<p><strong>{{ $company_name }}</strong> Recruitment Team</p>
