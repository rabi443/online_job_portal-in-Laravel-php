<x-header-footer>
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
                            <li class="breadcrumb-item active"><b>My CV</b></li>
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
    
                    {{-- CV View --}}
                    {{-- <div class="cv-container bg-white p-4 shadow rounded">
                        <div class="text-center mb-4">
                            <img src="{{ asset('images/avatar7.png') }}" alt="Profile Photo" class="rounded-circle mb-3" style="width: 130px; height: 130px; object-fit: cover; border: 3px solid #007bff;">
                            <h1 class="h4">{{ "$jobSeeker->fname $jobSeeker->mname $jobSeeker->lname" }}</h1>
                            <p class="text-muted">
                                rabinchaudhari@example.com<br>
                                9811349989<br>
                                Biratnagar, Nepal
                            </p>
                        </div> --}}
    
                        {{-- Objective --}}
                        {{-- <div class="mb-4">
                            <h2 class="h5 border-bottom pb-2">Objective</h2>
                            <p>To work in a dynamic and challenging environment that fosters growth and learning, while contributing effectively to the organization’s goals using my technical and soft skills.</p>
                        </div> --}}
    
                        {{-- Education --}}
                        {{-- <div class="mb-4">
                            <h2 class="h5 border-bottom pb-2">Education</h2>
                            <ul>
                                <li><strong>Bachelor of Computer Application</strong> - Purbanchal University, 2023</li>
                                <li><strong>+2 Science</strong> - Model College, 2019</li>
                            </ul>
                        </div> --}}
    
                        {{-- Skills --}}
                        {{-- <div class="mb-4">
                            <h2 class="h5 border-bottom pb-2">Skills</h2>
                            <ul>
                                <li>Laravel & PHP</li>
                                <li>JavaScript, Vue.js</li>
                                <li>MySQL & Database Design</li>
                                <li>HTML5, CSS3, Bootstrap</li>
                                <li>Git, GitHub</li>
                            </ul>
                        </div> --}}
    
                        {{-- Experience --}}
                        {{-- <div class="mb-4">
                            <h2 class="h5 border-bottom pb-2">Experience</h2>
                            <ul>
                                <li>
                                    <strong>Web Developer Intern</strong> - XYZ Tech Company (Jan 2024 - Apr 2024)
                                    <p>Assisted in the development of Laravel-based applications, collaborated in UI development and backend APIs.</p>
                                </li>
                                <li>
                                    <strong>Freelance Projects</strong>
                                    <p>Developed dynamic web applications for small businesses and portfolios.</p>
                                </li>
                            </ul>
                        </div> --}}
    
                        {{-- Important Links --}}
                        {{-- <div class="mb-4">
                            <h2 class="h5 border-bottom pb-2">Important Links</h2>
                            <ul>
                                <li><strong>Facebook:</strong> <a href="https://facebook.com/rabinchaudhari" target="_blank">facebook.com/rabinchaudhari</a></li>
                                <li><strong>GitHub:</strong> <a href="https://github.com/rabinchaudhari" target="_blank">github.com/rabinchaudhari</a></li>
                                <li><strong>LinkedIn:</strong> <a href="https://linkedin.com/in/rabinchaudhari" target="_blank">linkedin.com/in/rabinchaudhari</a></li>
                                <li><strong>Portfolio:</strong> <a href="https://rabinchaudhari.com.np" target="_blank">rabinchaudhari.com.np</a></li>
                            </ul>
                        </div> --}}
    





                        <div class="text-center mb-4">
                            <img src="{{ $data['profile_pic'] }}" alt="Profile Photo" class="rounded-circle mb-3" style="width: 130px; height: 130px; object-fit: cover; border: 3px solid #007bff;">
                            <h1 class="h4">{{ $data['name'] }}</h1>
                            <p class="text-muted">
                                {{ $data['email'] }}<br>
                                {{ $data['phone'] }}<br>
                                {{ $data['location'] }}
                            </p>
                        </div>
                        
                        @if(!empty($data['summary']))
                        <div class="mb-4">
                            <h2 class="h5 border-bottom pb-2">Objective</h2>
                            <p>{{ $data['summary'] }}</p>
                        </div>
                        @endif
                        
                        @if(!empty($data['education']))
                        <div class="mb-4">
                            <h2 class="h5 border-bottom pb-2">Education</h2>
                            <ul>
                                @foreach($data['education'] as $edu)
                                    <li><strong>{{ $edu['degree'] }}</strong> - {{ $edu['institution'] }}, {{ $edu['year'] }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        
                        @if(!empty($data['skills']))
                        <div class="mb-4">
                            <h2 class="h5 border-bottom pb-2">Skills</h2>
                            <ul>
                                @foreach($data['skills'] as $skill)
                                    <li>{{ $skill }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        
                        @if(!empty($data['experience']))
                        <div class="mb-4">
                            <h2 class="h5 border-bottom pb-2">Experience</h2>
                            <ul>
                                @foreach($data['experience'] as $exp)
                                    <li>
                                        <strong>{{ $exp['position'] }}</strong> - {{ $exp['company'] }} ({{ $exp['years'] ?? '' }})
                                        @if(!empty($exp['description']))<p>{{ $exp['description'] }}</p>@endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        


                        <div class="text-center">
                            <a href="{{ route('download-cv') }}" class="btn btn-primary">Download as PDF</a>
                        </div>
                    {{-- </div> --}}
    
                </div>
            </div>
        </div>
    </section>
    
    {{-- Styling for CV --}}
    <style>
        .cv-container ul {
            padding-left: 20px;
        }
    </style>
    </x-header-footer>
    