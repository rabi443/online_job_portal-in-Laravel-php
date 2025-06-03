<x-header-footer>
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
                            <li class="breadcrumb-item active"><b>My Objective</b></li>
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
                            <p class="text-muted mb-1 fs-6"> {{ "$jobSeeker->fname $jobSeeker->mname $jobSeeker->lname" }}</p>
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
                                    <li class="list-group-item p-3">
                                        <a href="{{ route('cv-preview') }}">My CV</a>
                                    </li>
                                    <li class="list-group-item p-3">
                                        <a href="{{ route('education') }}">Educations</a>
                                    </li>
                                    <li class="list-group-item p-3">
                                        <a href="{{ route('skill') }}">Skills</a>
                                    </li>
                                    <li class="list-group-item p-3">
                                        <a href="{{ route('experience') }}">Experience</a>
                                    </li>
                                    {{-- <li class="list-group-item p-3">
                                        <a href="{{ route('objective') }}">Objectives</a>
                                    </li> --}}
                                    <li class="list-group-item p-3">
                                        <a href="{{ route('important-links') }}">Important Links</a>
                                    </li>
                                @elseif(Auth::user()->role == 'employer')
                                    <li class="list-group-item p-3">
                                        <a href="{{ route('postJob') }}">Post a Job</a>
                                    </li>
                                    <li class="list-group-item p-3">
                                        <a href="{{ asset('/my-jobs') }}">My Posted Jobs</a>
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

                    
                    <form action="{{ asset('/postJob.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}"> <!-- Hidden user_id field -->
                       <div class="card border-0 shadow mb-4">
                            <div class="card-body p-4">
                                <h3 class="fs-4 mb-1">Career Objective</h3>
                                <div class="mb-4">
                                    <textarea name="objective" class="form-control" rows="4" required></textarea>
                                </div>
                              
                            <div class="card-footer  p-4">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>  
                    </form>
                    

                </div>
            </div>
        </div>
    </section>
</x-header-footer>
