<x-header-footer>
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
                            <li class="breadcrumb-item active"><b>Experiences</b></li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3">
                    {{-- Sidebar --}}
                    <div class="card border-0 shadow mb-4 p-3">
                        <div class="s-body text-center mt-3">
                            <img src="{{ asset('images/avatar7.png') }}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                            <p class="text-muted mb-1 fs-6">{{ "$jobSeeker->fname $jobSeeker->mname $jobSeeker->lname" }}</p>
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

                    <div class="card border-0 shadow mb-4">
                        <div class="card-body p-4">
                            <h4 class="fs-4 mb-4"><u>Experience :</u></h4>

                            {{-- Display existing Experience --}}
                            @if(!empty($experiences))
                                <div class="mb-4">
                                    <h3 id="experienceText" class="fs-4 mb-4">{{ $experiences->experiences }}</h3>
                                </div>
                            @else
                                <p class="text-muted">No experience added yet.</p>
                            @endif

                            {{-- Edit Button --}}
                            <div class="text-end">
                                <button class="btn btn-primary" id="editBtn">Edit</button>
                            </div>

                            {{-- Hidden Edit Form --}}
                            <form action="{{ route('add-cv-data') }}" method="POST" id="editForm" style="display: none; margin-top: 30px;">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                <div class="mb-4">
                                    <label for="experience" class="form-label">Update Experience</label>
                                    <textarea name="experience" id="experience" class="form-control" rows="4" placeholder="write about your experience ." required>{{ old('experiences', $experiences-> experiences?? '') }}</textarea>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary" id="cancelBtn">Cancel</button>
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- JavaScript to toggle form --}}
    <script>
        document.getElementById('editBtn').addEventListener('click', function (e) {
            e.preventDefault();
            document.getElementById('editForm').style.display = 'block';
            this.style.display = 'none';
        });

        document.getElementById('cancelBtn').addEventListener('click', function (e) {
            e.preventDefault();
            document.getElementById('editForm').style.display = 'none';
            document.getElementById('editBtn').style.display = 'inline-block';
        });
    </script>
</x-header-footer>
