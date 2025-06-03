<x-admin-header-footer>
    <div class="container mt-5">
        <h2><b><i><u>Employer Detail</u></i></b></h2>
        <p><strong>Company Name:</strong> {{ $employer->company_name }}</p>
        <p><strong>Email:</strong> {{ $employer->user->email }} 
            @if($employer->user->email_status == 'verified')
                <span class="badge bg-success">Verified</span>
            @else
                <span class="badge bg-warning">Unverified</span>
            @endif
        </p>
        <p><strong>Phone:</strong> {{ $employer->user->contact_number }}</p>
        <p><strong>Address:</strong> {{ $employer->city }} , {{ $employer->country }}</p>
        <p><strong>Account Status:</strong>
            @if($employer->user->account_status == 'verified')
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
