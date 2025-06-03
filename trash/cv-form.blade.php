<x-header-footer>
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
                            <li class="breadcrumb-item active"><b>CV Information</b></li>
                        </ol>
                    </nav>
                </div>
            </div>
    
            <div class="row">
                <div class="col-lg-3">
                    <div class="card border-0 shadow mb-4 p-3">
                        <div class="s-body text-center mt-3">
                            <img src="{{ asset('images/avatar7.png') }}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                            <p class="text-muted mb-1 fs-6">{{ "$jobSeeker->fname $jobSeeker->mname $jobSeeker->lname" }}</p>
                        </div>
                    </div>
    
                    <div class="card account-nav border-0 shadow mb-4 mb-lg-0">
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item p-3">
                                    <a href="{{ route('jobSeekerInformation') }}">Personal Information</a>
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
                                <li class="list-group-item p-3">
                                    <a href="{{ route('objective') }}">Objectives</a>
                                </li>
                                <li class="list-group-item p-3">
                                    <a href="{{ route('important-links') }}">Important Links</a>
                                </li>
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
    
                    <form action="{{ asset('/cv.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card border-0 shadow mb-4 p-4">
                            <h3 class="mb-4">CV Information</h3>
    
                            <!-- Objective -->
                            {{-- <div class="mb-4">
                                <label class="mb-2">Career Objective<span class="req">*</span></label>
                                <textarea name="objective" class="form-control" rows="4" placeholder="Enter your career objective" required>{{ old('objective') }}</textarea>
                            </div> --}}
    
                            <!-- Education -->
                            <h5 class="mt-5 mb-3">Education</h5>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <input type="text" name="education_level" class="form-control" placeholder="Education Level (e.g. Bachelor's)" required value="{{ old('education_level') }}">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <input type="text" name="institute_name" class="form-control" placeholder="Institute Name" required value="{{ old('institute_name') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <input type="text" name="education_start" class="form-control" placeholder="Start Year" required value="{{ old('education_start') }}">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <input type="text" name="education_end" class="form-control" placeholder="End Year" required value="{{ old('education_end') }}">
                                </div>
                            </div>
                            <div class="mb-4">
                                <textarea name="eduvation_description" class="form-control" rows="3" placeholder="Describe your education by telling about your course name. " required>{{ old('education_description') }}</textarea>
                            </div>
    
    
                            <!-- Experience -->
                            <h5 class="mt-5 mb-3">Experience</h5>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <input type="text" name="company_name" class="form-control" placeholder="Company Name" required value="{{ old('company_name') }}">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <input type="text" name="position" class="form-control" placeholder="Position" required value="{{ old('position') }}">
                                </div>
                            </div>
                            <div class="mb-4">
                                <textarea name="experience_description" class="form-control" rows="3" placeholder="Describe your experience" required>{{ old('experience_description') }}</textarea>
                            </div>
    
                            <!-- Skills -->
                            <h5 class="mt-5 mb-3">Skills</h5>
                            <div class="mb-4">
                                <input type="text" name="skills" class="form-control" placeholder="Skills (e.g. HTML, CSS, Laravel, etc.)" required value="{{ old('skills') }}">
                            </div>
    
                            <!-- Important Links -->
                            <h5 class="mt-5 mb-3">Important Links</h5>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <input type="url" name="linkedin" class="form-control" placeholder="LinkedIn Profile Link" value="{{ old('linkedin') }}">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <input type="url" name="portfolio" class="form-control" placeholder="Portfolio/Website Link" value="{{ old('portfolio') }}">
                                </div>
                            </div>
    
                            <!-- Profile Photo -->
                            <h5 class="mt-5 mb-3">Profile Photo</h5>
                            <div class="mb-4">
                                <input type="file" name="profile_photo" class="form-control">
                            </div>
    
                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-success">Save CV</button>
                            </div>
                        </div>
                    </form>
                </div>
    
            </div>
        </div>
    </section>
    </x-header-footer>
    