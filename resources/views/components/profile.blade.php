<x-header-footer>
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">Company Information</li>
                        </ol>
                    </nav>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-3">
                    <div class="card border-0 shadow mb-4 p-3">
                        <div class="s-body text-center mt-3">
                            <img src="{{ asset('images/avatar7.png') }}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                            {{-- <h5 class="mt-3 pb-0">{{ Auth::user()->name }}</h5> --}}
                            <p class="text-muted mb-1 fs-6"> {{ "$employer->company_name" }}</p>
                            <div class="d-flex justify-content-center mb-2">
                                <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn btn-primary">
                                    Change Profile Picture
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card account-nav border-0 shadow mb-4 mb-lg-0">
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                @if(Auth::user()->role == 'employer')
                                    <li class="list-group-item p-3">
                                        <a href="{{ route('companyInformation') }}">Company Information</a>
                                    </li>
                                @elseif(Auth::user()->role == 'jobseeker')
                                    <li class="list-group-item p-3">
                                        <a href="{{ route('jobSeekerInformation') }}">Personal Information</a>
                                    </li>
                                @endif
                                
                                <li class="list-group-item p-3">
                                    <a href="{{ asset('/account-setting') }}">Account Settings</a>
                                </li>

                                @if(Auth::user()->role == 'jobseeker')
                                    <li class="list-group-item p-3">
                                        <a href="{{ asset('/applied-jobs') }}">Jobs Applied</a>
                                    </li>
                                @elseif(Auth::user()->role == 'employer')
                                    <li class="list-group-item p-3">
                                        <a href="{{ route('postJob') }}">Post a Job</a>
                                    </li>
                                    <li class="list-group-item p-3">
                                        <a href="{{ asset('/my-jobs') }}">My Jobs</a>
                                    </li>
                                    <li class="list-group-item p-3">
                                        <a href="{{ asset('/job-applications') }}">Job Applications</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">


                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- <form action="{{ route('companyInformation.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}"> <!-- Hidden user_id field -->
                        <div class="card border-0 shadow mb-4">
                            <div class="card-body card-form p-4">
                                <h3 class="fs-4 mb-1">Company Information</h3>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="companyName" class="mb-2">Company Name<span class="req">*</span></label>
                                        <input type="text" name="companyName" id="companyName" class="form-control" 
                                            placeholder="Company Name" required
                                            value="{{ old('companyName', $employer->company_name ?? '') }}">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="country" class="mb-2">Country<span class="req">*</span></label>
                                        <input type="text" name="country" id="country" class="form-control" 
                                            placeholder="Country" required
                                            value="{{ old('country', $employer->country ?? '') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="province" class="mb-2">Province<span class="req">*</span></label>
                                        <select name="province" class="form-select">
                                            <option value="">Select Province</option>
                                            @for ($i = 1; $i <= 7; $i++)
                                                <option value="{{ $i }}" {{ isset($employer) && $employer->province == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="city" class="mb-2">City<span class="req">*</span></label>
                                        <input type="text" name="city" id="city" class="form-control" 
                                            placeholder="City" required
                                            value="{{ old('city', $employer->city ?? '') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="organizationType" class="mb-2">Organization Type<span class="req">*</span></label>
                                        <input type="text" name="organizationType" id="organizationType" class="form-control" 
                                            placeholder="Organization Type" required
                                            value="{{ old('organizationType', $employer->organization_type ?? '') }}">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="website" class="mb-2">Website</label>
                                        <input type="url" class="form-control" id="website" name="website"
                                            value="{{ old('website', $employer->website ?? '') }}">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="aboutCompany" class="mb-2">About Company</label>
                                    <input type="text" placeholder="About company" id="aboutCompany" name="aboutCompany" class="form-control"
                                        value="{{ old('aboutCompany', $employer->about_company ?? '') }}">
                                </div>
                            
                                <div class="card-footer p-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                         --}}
                         {{$slot}}
                </div>
            </div>
        </div>
    </section>
</x-header-footer>
