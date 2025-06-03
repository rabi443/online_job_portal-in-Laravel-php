<x-header-footer>
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
                            <li class="breadcrumb-item active"><b>Important Links</b></li>
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
                                    <li class="list-group-item p-3"><a href="{{ route('companyInformation') }}">Company Information</a></li>
                                @elseif(Auth::user()->role == 'jobseeker')
                                    <li class="list-group-item p-3"><a href="{{ route('jobSeekerInformation') }}">Personal Information</a></li>
                                @endif
                                <li class="list-group-item p-3"><a href="{{ asset('/account-setting') }}">Account Settings</a></li>
                                @if(Auth::user()->role == 'jobseeker')
                                    <li class="list-group-item p-3"><a href="{{ asset('/applied-jobs') }}">Jobs Applied</a></li>
                                    <li class="list-group-item p-3"><a href="{{ route('cv-preview') }}">My CV</a></li>
                                    <li class="list-group-item p-3"><a href="{{ route('education') }}">Educations</a></li>
                                    <li class="list-group-item p-3"><a href="{{ route('skill') }}">Skills</a></li>
                                    <li class="list-group-item p-3"><a href="{{ route('experience') }}">Experience</a></li>
                                    {{-- <li class="list-group-item p-3"><a href="{{ route('objective') }}">Objectives</a></li> --}}
                                    <li class="list-group-item p-3"><a href="{{ route('important-links') }}">Important Links</a></li>
                                @elseif(Auth::user()->role == 'employer')
                                    <li class="list-group-item p-3"><a href="{{ route('postJob') }}">Post a Job</a></li>
                                    <li class="list-group-item p-3"><a href="{{ asset('/my-jobs') }}">My Posted Jobs</a></li>
                                    <li class="list-group-item p-3"><a href="{{ asset('/job-applications') }}">Job Applications</a></li>
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
    
                    <!-- View Mode -->
                    <div id="viewMode">
                        <div class="card border-0 shadow mb-4">
                            <div class="card-body p-4">
                                <h3 class="fs-4 mb-3">Important Links</h3>
                                <p><strong>Facebook:</strong> {{ old('facebook', $importantLinks->facebook ?? '') }}</p>
                                <p><strong>Instagram:</strong> {{ old('instagram', $importantLinks->instagram ?? '') }}</p>
                                <p><strong>LinkedIn:</strong> {{ old('linkedIn', $importantLinks->linkedIn ?? '') }}</p>
                                <p><strong>GitHub:</strong> {{ old('gitHub', $importantLinks->gitHub?? '') }}</p>
    
                                <div class="text-end">
                                    <button id="editButton" class="btn btn-primary mt-3">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Edit Mode -->
                    <div id="editMode" style="display: none;">
                        <form action="{{ route('add-cv-data') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <div class="card border-0 shadow mb-4">
                                <div class="card-body p-4">
                                    <h3 class="fs-4 mb-3">Edit Important Links</h3>
    
                                    <div class="mb-4">
                                        <label for="facebook" class="mb-2">Facebook</label>
                                        <input type="url" class="form-control" id="facebook" name="facebook" 
                                            value="{{ old('facebook', $importantLinks->facebook ?? '') }}">
                                    </div>
    
                                    <div class="mb-4">
                                        <label for="instagram" class="mb-2">Instagram</label>
                                        <input type="url" class="form-control" id="instagram" name="instagram" 
                                            value="{{ old('instagram', $importantLinks->instagram ?? '') }}">
                                    </div>
    
                                    <div class="mb-4">
                                        <label for="linkedin" class="mb-2">LinkedIn</label>
                                        <input type="url" class="form-control" id="linkedin" name="linkedin" 
                                            value="{{ old('linkedIn', $importantLinks->linkedIn ?? '') }}">
                                    </div>
    
                                    <div class="mb-4">
                                        <label for="github" class="mb-2">GitHub</label>
                                        <input type="url" class="form-control" id="github" name="github" 
                                            value="{{ old('gitHub', $importantLinks->gitHub ?? '') }}">
                                    </div>
    
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success">Save Changes</button>
                                        <button type="button" id="cancelButton" class="btn btn-secondary ms-2">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
    
                </div> <!-- col-lg-9 end -->
            </div> <!-- row end -->
        </div> <!-- container end -->
    </section>
    
    <script>
        const editButton = document.getElementById('editButton');
        const cancelButton = document.getElementById('cancelButton');
        const viewMode = document.getElementById('viewMode');
        const editMode = document.getElementById('editMode');
    
        editButton.addEventListener('click', function() {
            viewMode.style.display = 'none';
            editMode.style.display = 'block';
        });
    
        cancelButton.addEventListener('click', function() {
            editMode.style.display = 'none';
            viewMode.style.display = 'block';
        });
    </script>
    </x-header-footer>
    