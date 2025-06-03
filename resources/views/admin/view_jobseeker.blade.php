<x-admin-header-footer>
    <div class="container mt-5">
        <h2><b><i><u>JobSeeker Detail</u></i></b></h2>
        <p><strong>Name:</strong> {{ $jobseeker->fname }} 
            @if($jobseeker->mname)
                {{ $jobseeker->mname }}
            @endif
             {{ $jobseeker->lname }}
        </p>
        <p><strong>Email:</strong> {{ $jobseeker->user->email }} 
            @if($jobseeker->user->email_status == 'verified')
                <span class="badge bg-success">Verified</span>
            @else
                <span class="badge bg-warning">Unverified</span>
            @endif
        </p>
        <p><strong>Phone:</strong> {{ $jobseeker->user->contact_number }}</p>
        <p><strong>Address:</strong> {{ $jobseeker->city }} , {{ $jobseeker->country }}</p>
        <p><strong>Account Status:</strong>
            @if($jobseeker->user->account_status == 'verified')
                <span class="badge bg-success">Verified</span>
            @else
                <span class="badge bg-warning">Unverified</span>
            @endif
        </p>

        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">
            ← Back
        </a>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</x-admin-header-footer>
