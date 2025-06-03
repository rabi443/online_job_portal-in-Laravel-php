<x-header-footer>
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
                            <li class="breadcrumb-item active"><b>Resume</b></li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <div class="card border-0 shadow mb-4 p-3">
                        <div class="s-body text-center mt-3">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#viewPhotoModal">
                                @if($profilePath)
                                <img src="{{ $profilePath->file_path ? asset('storage/' .$profilePath->file_path ) : asset('images/avatar7.png') }}" 
                                    alt="avatar" 
                                    class="rounded-circle img-fluid" 
                                    style="width: 150px; height: 150px; object-fit: cover;">
                                @else
                                <img src="{{ asset('images/avatar7.png') }}" 
                                    alt="avatar" 
                                    class="rounded-circle img-fluid" 
                                    style="width: 150px; height: 150px; object-fit: cover;">
                                @endif
                            </a>
                            <p class="text-muted mb-1 fs-6">{{ $jobSeeker->fname }} 
                                @if($jobSeeker->mname)
                                    {{ $jobSeeker->mname }} 
                                @endif
                                {{ $jobSeeker->lname }}</p>

                            <div class="d-flex justify-content-center gap-2 flex-wrap mb-2">
                                <!-- Change/Upload Photo -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadPhotoModal">
                                    @if($profilePath)
                                        {{ $profilePath->file_path ? 'Change Photo' : 'Upload Photo' }}
                                    @else
                                        Upload Photo
                                    @endif
                                </button>

                                @if($profilePath)
                                    <!-- Delete Photo -->
                                    <form action="{{ route('user-photo-delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this photo?');">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="profile_pic_path" value="{{ $profilePath->file_path }}">
                                        <button type="submit" class="btn btn-secondary">Delete Photo</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                
                    {{-- Modal for Viewing profile Photo --}}
                    <div class="modal fade" id="viewPhotoModal" tabindex="-1" aria-labelledby="viewPhotoLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body text-center">
                                    @if($profilePath)
                                        <img src="{{ $profilePath->file_path ? asset('storage/' .$profilePath->file_path ) : asset('images/avatar7.png') }}" 
                                        alt="profile photo" class="img-fluid rounded">
                                    @else
                                        <img src="{{ asset('images/avatar7.png') }}" 
                                        alt="profile photo" class="img-fluid rounded">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal for Uploading/Changing profile Photo --}}
                    <div class="modal fade" id="uploadPhotoModal" tabindex="-1" aria-labelledby="uploadPhotoLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('user-photo-upload') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="uploadPhotoLabel"> @if($profilePath){{ $profilePath->file_path ? 'Change' : 'Upload' }} Profile Photo @else Upload Profile Photo @endif</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <input type="file" name="profile_pic" class="form-control" accept="image/*" required>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Save Photo</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
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

                <div class="col-lg-9">
                    <div class="card border-0 shadow mb-4">
                        @if(Auth::user()->role == 'jobseeker')
                            <div class="mb-3 p-4">
                                @if($resume)
                                    <div class="mt-3">
                                        <div style="font-family: Arial, sans-serif; padding: 0px; max-width: 800px; margin: auto; background: white; color: black;">
                                            {{-- <div style="overflow: hidden;"> --}}
                                                <div class="mb-4">
                                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#resumeModal">
                                                        Edit Resume
                                                    </button>
                                                    <a href="{{route('downloadResume')}}" class="btn btn-primary ms-2">
                                                        Download as PDF
                                                    </a>
                                                </div><hr>
                                            {{-- </div> --}}
                                           
                                            <div style="overflow: hidden; background-color: #f8f9fa; padding: 20px; border-radius: 5px;">
                                                <div style="overflow: hidden; padding: 20px; border-radius: 5px;">
                                                    <div class="text-center"><h4><u>Resume</u></h4></div>
                                                    <div style="float: left; width: 80%;">
                                                    
                                                        <h1 style="font-size: 22px; font-weight: bold; text-transform: uppercase;">{{ strtoupper($resume->name) }}</h1>
                                                        <p><strong>Address :</strong>{{ $resume->location }}</p>
                                                        <p><strong>Cell Phone :</strong> {{ $resume->phone }}</p>
                                                        <p><strong>Email address:</strong> {{ $resume->email }}</p>
                                                        @if(!empty($resume->linkedin))
                                                            <p><strong>LinkedIn:</strong> {{ $resume->linkedin }}</p>
                                                        @endif
                                                    </div>
                                                    @if(!empty($profilePath->file_path))
                                                        <div style="float: right; width: 120px; height: 140px;">
                                                            <img src="{{ asset('storage/'. $profilePath->file_path) }}" alt="Profile Picture" style="width: 100%; height: 100%; border: 1px solid #000; object-fit: cover;">
                                                        </div>
                                                    @endif
                                                </div>
                                            <hr>

                                            {{-- <div style="overflow: hidden; background-color: #f8f9fa; padding: 20px; border-radius: 5px;"> --}}
                                            <!-- Summary -->
                                            <h6 style="margin-top: 30px; text-decoration: underline;"><b>DESCRIPTION:</b></h6>
                                            <p>{{ $resume->summary }}</p>

                                            <!-- Work Experience -->
                                            <h6 style="margin-top: 30px; text-decoration: underline;"><b>WORK EXPERIENCE:</b></h6>
                                            <ul>
                                                @foreach($resume->experience as $exp)
                                                    <li>
                                                        <strong>{{ $exp['position'] }}</strong> at {{ $exp['company'] }},
                                                        <span>since ({{ $exp['years'] }})</span>
                                                    </li>
                                                @endforeach
                                            </ul>

                                            <!-- Education -->
                                            <h6 style="margin-top: 30px; text-decoration: underline;"><b>EDUCATIONAL ATTAINMENT:</b></h6>
                                            <ul>
                                                @foreach($resume->education as $edu)
                                                    <li>
                                                        <strong>{{ $edu['degree'] }}</strong> at 
                                                        {{ $edu['institution'] }} ({{ $edu['year'] }})
                                                    </li>
                                                @endforeach
                                            </ul>

                                            <!-- Skills -->
                                            <h6 style="margin-top: 30px; text-decoration: underline;"><b>SKILLS:</b></h6>
                                            @if(is_array($resume->skills) && count($resume->skills) > 0)
                                                <p>{{ implode(', ', $resume->skills) }}</p>
                                            @else
                                                <p>No skills listed.</p>
                                            @endif
                                        </div>

                                    </div>
                                @else
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#resumeModal">
                                        Generate Resume
                                    </button>
                                    <h5 class="mt-2">Click the above button to generate your resume.</h5>
                                @endif
                            </div>
                        @endif
                    </div>



                    <!-- Resume Modal -->
                    <div class="modal fade" id="resumeModal" tabindex="-1" aria-labelledby="resumeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="resumeModalLabel">{{ $resume ? 'Edit' : 'Generate' }} Resume</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{-- Resume Form Here --}}
                                    <div class="card border-0 shadow mb-4 p-4">
                                        <h4 class="mb-4">Fill the form to create your resume</h4>

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul class="mb-0">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <form action="{{ route('resume.generate') }}" method="POST" enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-group">
                                                <label for="name"><i>Name:</i><span class="req">*</span></label>
                                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name',$jobSeeker->fname." ".$jobSeeker->mname." ".$jobSeeker->lname ?? '') }}" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label for="email"><i>Email:</i></label>
                                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $jobSeeker->user->email ?? '') }}" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label for="phone"><i>Phone:</i><span class="req">*</span></label>
                                                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $jobSeeker->user->contact_number ?? '') }}" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label for="location"><i>Location:</i><span class="req">*</span></label>
                                                <input type="text" name="location" id="location" class="form-control"  value="{{ old('location', $jobSeeker->city.' - '.($jobSeeker->country) ?? '') }}" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label for="linkedin"><i>LinkedIn (optional):</i></label>
                                                <input type="url" name="linkedin" id="linkedin" class="form-control" value="{{ old('linkedin', $resume->linkedin ?? '') }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="profile_pic"><i>Profile Picture:</i><span class="req">*</span></label><br>
                                                
                                                @if($profilePath)
                                                    <input type="file" name="profile_pic" id="profile_pic" class="form-control-file" accept="image/*" value="{{ old('profile_pic', $profilePath->file_path ?? '') }}">
                                                @else
                                                <input type="file" name="profile_pic" id="profile_pic" class="form-control-file" accept="image/*" >
                                                @endif
                                                <br>
                                                <small class="form-text text-muted">Upload a clear profile picture.</small>
                                            </div><br>

                                            <div class="form-group">
                                                <label for="summary"><i>Your Description:</i></label>
                                                <textarea name="summary" id="summary" class="form-control" rows="4" required>{{ old('summary', $resume->summary ?? '') }}</textarea>
                                            </div><br>

                                            <!-- Experience -->
                                            <label for="experience"><i>Experience:</i></label><br>
                                            @php
                                                $experiences = old('experience', $resume->experience ?? [['position' => '', 'company' => '', 'years' => '']]);
                                            @endphp
                                            
                                            <div id="experience-wrapper">
                                                @foreach ($experiences as $i => $exp)
                                                    <div class="form-group">
                                                        <input type="text" name="experience[{{ $i }}][position]" placeholder="Position"
                                                            value="{{ $exp['position'] }}" class="form-control" required>
                                                        <input type="text" name="experience[{{ $i }}][company]" placeholder="Company"
                                                            value="{{ $exp['company'] }}" class="form-control" required>
                                                        <input type="text" name="experience[{{ $i }}][years]" placeholder="Years"
                                                            value="{{ $exp['years'] }}" class="form-control" required>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button type="button" class="btn btn-secondary" onclick="addExperience()">+ experience</button><br><br>

                                            <!-- Education -->
                                            <label for="education"><i>Education:</i></label><br>
                                            @php
                                                $educations = old('education', $resume->education ?? [['degree' => '', 'institution' => '', 'year' => '']]);
                                            @endphp
                                            <div id="education-wrapper">
                                                @foreach ($educations as $i => $edu)
                                                    <div class="form-group">
                                                        <input type="text" name="education[{{ $i }}][degree]" placeholder="Degree"
                                                            value="{{ $edu['degree'] }}" class="form-control" required>
                                                        <input type="text" name="education[{{ $i }}][institution]" placeholder="Institution"
                                                            value="{{ $edu['institution'] }}" class="form-control" required>
                                                        <input type="text" name="education[{{ $i }}][year]" placeholder="Year"
                                                            value="{{ $edu['year'] }}" class="form-control" required>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button type="button" class="btn btn-secondary" onclick="addEducation()">+ education</button><br><br>

                                            <div class="col-md-12 mb-4">
                                                <label class="mb-2"><i>Skills :</i> <span class="req">*</span></label>
                                                <div style="max-height: 200px; overflow-y: auto; border: 1px solid #ccc; border-radius: 5px; padding: 10px;">
                                                    <div class="row">
                                                        @foreach($skills as $skill)
                                                            <div class="col-md-6 mb-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input"
                                                                        type="checkbox"
                                                                        name="skills[]"
                                                                        value="{{ $skill->name }}"
                                                                        id="skill_{{ $skill->id }}"
                                                                        {{ in_array($skill->name, old('skills', $resume->skills ?? [])) ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="skill_{{ $skill->id }}">
                                                                        {{ $skill->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </section>

    {{-- Select2 & jQuery --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- JavaScript for Dynamic Fields --}}
    <script>
        let expIndex = 1;
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

        let eduIndex = 1;
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

        // Initialize Select2 for skills
        $('#skills').select2({
            placeholder: 'Type to search skills',
            minimumInputLength: 1,
            ajax: {
                url: '{{ route('skills.search') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return { q: params.term };
                },
                processResults: function(data) {
                    return {
                        results: data.map(skill => ({
                            id: skill.name,
                            text: skill.name
                        }))
                    };
                },
                cache: true
            },
            tags: true // allow adding custom skills
        });
    </script>
</x-header-footer>
