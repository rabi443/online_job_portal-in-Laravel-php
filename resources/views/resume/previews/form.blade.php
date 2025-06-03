<x-header-footer>
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
                            <li class="breadcrumb-item active"><b>Build Resume</b></li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-3">
                    <div class="card border-0 shadow mb-4 p-3">
                        <div class="s-body text-center mt-3">
                            <img src="{{ asset('images/avatar7.png') }}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                            <p class="text-muted mb-1 fs-6">{{ Auth::user()->name }}</p>
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
                                    <li class="list-group-item p-3"><a href="{{ route('resume') }}">Resume</a></li>
                                @elseif(Auth::user()->role == 'employer')
                                    <li class="list-group-item p-3"><a href="{{ route('postJob') }}">Post a Job</a></li>
                                    <li class="list-group-item p-3"><a href="{{ asset('/my-jobs') }}">My Posted Jobs</a></li>
                                    <li class="list-group-item p-3"><a href="{{ asset('/job-applications') }}">Job Applications</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-lg-9">
                    <div class="card border-0 shadow mb-4 p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div id="formHeading" class="mb-4">
                                <h4>Fill the form to create your resume</h4>
                            </div>
                            <div>
                                <button id="previewModeBtn" class="btn btn-secondary">Preview Mode</button>
                                <button id="editModeBtn" class="btn btn-secondary d-none">Edit Mode</button>
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Resume Form -->
                        <div id="resumeFormSection">
                            <form action="{{ route('resume.generate') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- Basic Info -->
                                <div class="form-group"><label>Name:</label><input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required></div>
                                <div class="form-group"><label>Email:</label><input type="email" name="email" class="form-control" value="{{ old('email') }}" required></div>
                                <div class="form-group"><label>Phone:</label><input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required></div>
                                <div class="form-group"><label>Location:</label><input type="text" name="location" class="form-control" value="{{ old('location') }}" required></div>
                                <div class="form-group"><label>LinkedIn (optional):</label><input type="url" name="linkedin" class="form-control" value="{{ old('linkedin') }}"></div>
                                <div class="form-group"><label>Profile Picture:</label><input type="file" name="profile_pic" class="form-control-file" accept="image/*"></div><br>
                                <div class="form-group"><label>Professional Summary:</label><textarea name="summary" class="form-control" rows="4" required>{{ old('summary') }}</textarea></div><br>

                                <!-- Experience -->
                                <label>Experience:</label>
                                <div id="experience-wrapper">
                                    @php $expData = old('experience', [['position'=>'','company'=>'','years'=>'']]); @endphp
                                    @foreach ($expData as $i => $exp)
                                        <div class="form-group">
                                            <input type="text" name="experience[{{ $i }}][position]" placeholder="Position" class="form-control" value="{{ $exp['position'] ?? '' }}" required>
                                            <input type="text" name="experience[{{ $i }}][company]" placeholder="Company" class="form-control" value="{{ $exp['company'] ?? '' }}" required>
                                            <input type="text" name="experience[{{ $i }}][years]" placeholder="Years" class="form-control" value="{{ $exp['years'] ?? '' }}" required>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addExperience()">+ Add Experience</button><br><br>

                                <!-- Education -->
                                <label>Education:</label>
                                <div id="education-wrapper">
                                    @php $eduData = old('education', [['degree'=>'','institution'=>'','year'=>'']]); @endphp
                                    @foreach ($eduData as $i => $edu)
                                        <div class="form-group">
                                            <input type="text" name="education[{{ $i }}][degree]" placeholder="Degree" class="form-control" value="{{ $edu['degree'] ?? '' }}" required>
                                            <input type="text" name="education[{{ $i }}][institution]" placeholder="Institution" class="form-control" value="{{ $edu['institution'] ?? '' }}" required>
                                            <input type="text" name="education[{{ $i }}][year]" placeholder="Year" class="form-control" value="{{ $edu['year'] ?? '' }}" required>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addEducation()">+ Add Education</button><br><br>

                                <div class="form-group">
                                    <label>Skills (comma-separated):</label>
                                    <input type="text" name="skills" class="form-control" value="{{ old('skills') }}" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Save Resume</button>
                            </form>
                        </div>

                        <!-- Resume Preview -->
                        <div id="resumePreviewSection" class="d-none border p-4 bg-white">
                            <div class="text-center">
                                <img src="{{ asset('images/avatar7.png') }}" alt="avatar" class="rounded-circle mb-3" style="width: 120px;">
                                <h3>{{ old('name', Auth::user()->name) }}</h3>
                                <p>{{ old('email') }}</p>
                                <p>{{ old('phone') }}</p>
                                <p>{{ old('location') }}</p>
                                @if(old('linkedin'))<p><strong>LinkedIn:</strong> {{ old('linkedin') }}</p>@endif
                            </div>
                            <hr>
                            <h4>Professional Summary</h4>
                            <p>{{ old('summary') }}</p>
                            <h4>Experience</h4>
                            <ul>
                                @foreach(old('experience', []) as $exp)
                                    <li><strong>{{ $exp['position'] ?? '' }}</strong> at {{ $exp['company'] ?? '' }} ({{ $exp['years'] ?? '' }})</li>
                                @endforeach
                            </ul>
                            <h4>Education</h4>
                            <ul>
                                @foreach(old('education', []) as $edu)
                                    <li>{{ $edu['degree'] ?? '' }} - {{ $edu['institution'] ?? '' }} ({{ $edu['year'] ?? '' }})</li>
                                @endforeach
                            </ul>
                            <h4>Skills</h4>
                            <p>{{ old('skills') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- JavaScript --}}
    <script>
        let expIndex = {{ count(old('experience', [['position'=>'']])) }};
        function addExperience() {
            const wrapper = document.getElementById('experience-wrapper');
            const div = document.createElement('div');
            div.classList.add('form-group');
            div.innerHTML = `
                <input type="text" name="experience[${expIndex}][position]" placeholder="Position" class="form-control" required>
                <input type="text" name="experience[${expIndex}][company]" placeholder="Company" class="form-control" required>
                <input type="text" name="experience[${expIndex}][years]" placeholder="Years" class="form-control" required>
            `;
            wrapper.appendChild(div);
            expIndex++;
        }

        let eduIndex = {{ count(old('education', [['degree'=>'']])) }};
        function addEducation() {
            const wrapper = document.getElementById('education-wrapper');
            const div = document.createElement('div');
            div.classList.add('form-group');
            div.innerHTML = `
                <input type="text" name="education[${eduIndex}][degree]" placeholder="Degree" class="form-control" required>
                <input type="text" name="education[${eduIndex}][institution]" placeholder="Institution" class="form-control" required>
                <input type="text" name="education[${eduIndex}][year]" placeholder="Year" class="form-control" required>
            `;
            wrapper.appendChild(div);
            eduIndex++;
        }

        document.getElementById('editModeBtn').addEventListener('click', function () {
            document.getElementById('resumeFormSection').classList.remove('d-none');
            document.getElementById('resumePreviewSection').classList.add('d-none');
            this.classList.add('d-none');
            document.getElementById('previewModeBtn').classList.remove('d-none');
        });

        document.getElementById('previewModeBtn').addEventListener('click', function () {
            document.getElementById('resumeFormSection').classList.add('d-none');
            document.getElementById('resumePreviewSection').classList.remove('d-none');
            this.classList.add('d-none');
            document.getElementById('editModeBtn').classList.remove('d-none');
        });

        document.getElementById('editModeBtn').addEventListener('click', function () {
    document.getElementById('resumeFormSection').classList.remove('d-none');
    document.getElementById('resumePreviewSection').classList.add('d-none');
    document.getElementById('formHeading').classList.remove('d-none');
    document.getElementById('editModeBtn').classList.add('d-none');
    document.getElementById('previewModeBtn').classList.remove('d-none');
});

document.getElementById('previewModeBtn').addEventListener('click', function () {
    document.getElementById('resumeFormSection').classList.add('d-none');
    document.getElementById('resumePreviewSection').classList.remove('d-none');
    document.getElementById('formHeading').classList.add('d-none');
    document.getElementById('editModeBtn').classList.remove('d-none');
    document.getElementById('previewModeBtn').classList.add('d-none');
});

    </script>
</x-header-footer>
