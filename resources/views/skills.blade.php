<x-header-footer>
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
                            <li class="breadcrumb-item active"><b>Skills</b></li>
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
                    <form action="{{ asset('/resume.generate') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    
                        <!-- Template Selection -->
                        <label><strong>Select Template:</strong></label><br>
                        @foreach(['basic', 'modern', 'creative', 'elegant', 'professional'] as $tpl)
                            <label>
                                <input type="radio" name="template" value="{{ $tpl }}" {{ $loop->first ? 'checked' : '' }}> {{ ucfirst($tpl) }}
                            </label>
                        @endforeach
                        <br><br>
                    
                        <!-- Contact Information -->
                        <label>Name: <input type="text" name="name" required></label><br>
                        <label>Email: <input type="email" name="email" required></label><br>
                        <label>Phone: <input type="text" name="phone" required></label><br>
                        <label>Location: <input type="text" name="location" required></label><br>
                        <label>LinkedIn (optional): <input type="url" name="linkedin"></label><br>
                    
                        <!-- Profile Picture -->
                        <label>Profile Picture:</label><br>
                        <input type="file" name="profile_pic" accept="image/*"><br><br>
                    
                        <!-- Summary -->
                        <label>Professional Summary:</label><br>
                        <textarea name="summary" rows="4" required></textarea><br>
                    
                        <!-- Experience -->
                        <h4>Experience:</h4>
                        <div id="experience-wrapper">
                            <div>
                                <input type="text" name="experience[0][position]" placeholder="Position" required>
                                <input type="text" name="experience[0][company]" placeholder="Company" required>
                                <input type="text" name="experience[0][years]" placeholder="Years" required>
                            </div>
                        </div>
                        <button type="button" onclick="addExperience()">Add Experience</button><br><br>
                    
                        <!-- Education -->
                        <h4>Education:</h4>
                        <div id="education-wrapper">
                            <div>
                                <input type="text" name="education[0][degree]" placeholder="Degree" required>
                                <input type="text" name="education[0][institution]" placeholder="Institution" required>
                                <input type="text" name="education[0][year]" placeholder="Year" required>
                            </div>
                        </div>
                        <button type="button" onclick="addEducation()">Add Education</button><br><br>
                    
                        <!-- Skills -->
                        <label>Skills (comma-separated):</label><br>
                        <input type="text" name="skills" required><br><br>
                    
                        <button type="submit">Generate Resume</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </section>

    <script>
        let expIndex = 1;
        function addExperience() {
            const wrapper = document.getElementById('experience-wrapper');
            const div = document.createElement('div');
            div.innerHTML = `
                <input type="text" name="experience[${expIndex}][position]" placeholder="Position" required>
                <input type="text" name="experience[${expIndex}][company]" placeholder="Company" required>
                <input type="text" name="experience[${expIndex}][years]" placeholder="Years" required>
            `;
            wrapper.appendChild(div);
            expIndex++;
        }
    
        let eduIndex = 1;
        function addEducation() {
            const wrapper = document.getElementById('education-wrapper');
            const div = document.createElement('div');
            div.innerHTML = `
                <input type="text" name="education[${eduIndex}][degree]" placeholder="Degree" required>
                <input type="text" name="education[${eduIndex}][institution]" placeholder="Institution" required>
                <input type="text" name="education[${eduIndex}][year]" placeholder="Year" required>
            `;
            wrapper.appendChild(div);
            eduIndex++;
        }
    </script>
</x-header-footer>
