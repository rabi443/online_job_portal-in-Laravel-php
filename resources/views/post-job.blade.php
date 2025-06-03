<x-header-footer>



    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">Post Jobs</li>
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
                            <p class="text-muted mb-1 fs-6">{{ $employer->company_name }}</p>

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
                                        <a href="{{ route('resume') }}">Resume</a>
                                    </li>
                                @elseif(Auth::user()->role == 'employer')
                                    <li class="list-group-item p-3">
                                        <a href="{{ route('postJob') }}">Post a Job</a>
                                    </li>
                                    <li class="list-group-item p-3">
                                        <a href="{{ asset('/my-jobs') }}">My Posted Jobs</a>
                                    </li>
                                    <li class="list-group-item p-3">
                                        <a href="{{ route('applications') }}">Job Applications</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">

                    @if(session('success'))
                        <div id="success-alert"  class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div id="error-alert"  style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px;">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('postJob.store') }}" method="POST">
                        @csrf

                        <div class="card border-0 shadow mb-4">
                            <div class="card-body card-form p-4">
                                <h3 class="fs-4 mb-1"><b><u>Fill all required fields to post a job</u></b></h3><br><hr>
                                <div class="row mt-4">
                                    <div class="col-md-6 mb-4">
                                        <label for="category" class="mb-2">Job Category<span class="req">*</span></label>
                                        <select name="category_id" id="category" class="form-select" required>
                                            <option value="">Select Category</option>
                                            @foreach ($jobCategories as $category)
                                                <option value="{{ $category->id }}">{{ $category->job_category }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="job_title" class="mb-2">Job Title<span class="req">*</span></label>
                                        <select name="job_title_id" id="job_title" class="form-select" required>
                                            <option value="">Select Title</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="job_type" class="mb-2">Job Type<span class="req">*</span></label>
                                        <select name="job_type" class="form-select" required>
                                            <option value="">Select Type</option>
                                            <option value="Full-Time">Full Time</option>
                                            <option value="Part-Time">Part Time</option>
                                            {{-- <option value="Contract">Contract</option> --}}
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="vacancy" class="mb-2">Vacancy<span class="req">*</span></label>
                                        <input type="number" name="number_of_vacancies" id="vacancy" class="form-control" placeholder="Vacancy" min="1" max="100000" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="salary_basis" class="mb-2">Salary Basis<span class="req">*</span></label>
                                        <select name="salary_basis" id="salary_basis" class="form-select" required>
                                            <option value="">Select Basis</option>
                                            <option value="monthly">Monthly</option>
                                            <option value="yearly">Yearly</option>
                                            {{-- <option value="contract">Contract</option> --}}
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="offered_salary" class="mb-2">Offered Salary<span class="req">*</span></label>
                                        <select name="offered_salary" id="offered_salary" class="form-select" onchange="toggleSalaryFields()" required>
                                            <option value="">Select Type</option>
                                            <option value="fixed">Fixed</option>
                                            <option value="range">Range</option>
                                            <option value="negotiable">Negotiable</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4" id="salary_field" style="display: none;">
                                        <label for="salary" class="mb-2">Salary Amount</label>
                                        <input type="number" name="salary" id="salary" class="form-control" min="1" max="10000000" placeholder="Enter Salary">
                                    </div>
                                    <div class="col-md-6 mb-4" id="min_salary_field" style="display: none;">
                                        <label for="min_salary" class="mb-2">Minimum Salary</label>
                                        <input type="number" name="min_salary" id="min_salary" class="form-control" min="1" max="10000000" placeholder="Min Salary">
                                    </div>
                                    <div class="col-md-6 mb-4" id="max_salary_field" style="display: none;">
                                        <label for="max_salary" class="mb-2">Maximum Salary</label>
                                        <input type="number" name="max_salary" id="max_salary" class="form-control" min="1" max="10000000" placeholder="Max Salary">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="functional_area" class="mb-2">Location<span class="req">*</span></label>
                                        <input type="text" name="functional_area" id="functional_area" class="form-control" placeholder="Location" required>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="experience" class="mb-2">Experience<span class="req">*</span></label>
                                        <select name="experience" id="experience" class="form-select" required>
                                            <option value="">Select Type</option>
                                            <option value="freshers">Freshers</option>
                                            <option value="upto_one_year">One Year</option>
                                            <option value="upto_two_years">Two Years</option>
                                            <option value="upto_three_years">Three Years</option>
                                            <option value="more_than_three_years">More than three Years</option>
                                        </select>
                                    </div>
                                </div>

                                @php
                                    // Convert to Nepal timezone and format with AM/PM
                                    $nowNepal = now()->setTimezone('Asia/Kathmandu');
                                @endphp

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="posted_date" class="mb-2">Posted Date</label>
                                        <!-- Human-readable format with AM/PM -->
                                        <input type="text" id="posted_date" class="form-control" value="{{ $nowNepal->format('Y-m-d h:i A') }}" disabled>
                                        <!-- Hidden input for backend submission (24-hour format for consistency) -->
                                        <input type="hidden" name="posted_date" value="{{ $nowNepal->format('Y-m-d H:i:s') }}">
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="expire_date" class="mb-2">Expire Date<span class="req">*</span></label>
                                        <input type="datetime-local" id="expire_date" name="expire_date" class="form-control" required>
                                    </div>
                                

                                <div class="col-md-12 mb-4">
                                    <label class="mb-2">Required Skills</label>
                                    <div style="max-height: 200px; overflow-y: auto; border: 1px solid #ccc; border-radius: 5px; padding: 10px;">
                                        <div class="row">
                                            @foreach($skills as $skill)
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-check">
                                                        <input
                                                            class="form-check-input"
                                                            type="checkbox"
                                                            name="skills[]"
                                                            value="{{ $skill->id }}"
                                                            id="skill_{{ $skill->id }}"
                                                        >
                                                        <label class="form-check-label" for="skill_{{ $skill->id }}">
                                                            {{ $skill->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                
                                
                                

                                <div class="mb-4">
                                    <label for="job_description" class="mb-2">Job Description<span class="req">*</span></label>
                                    <textarea name="job_description" id="job_description" class="form-control" rows="4" placeholder="Enter Job Description" required></textarea>
                                </div>

                                <div class="mb-4">
                                    <label for="what_we_offer" class="mb-2">What We Offer</label>
                                    <textarea name="what_we_offer" id="what_we_offer" class="form-control" rows="4" placeholder="What benefits and perks are offered?"></textarea>
                                </div>

                                <input type="hidden" name="companyName" value="{{ old('companyName', $employer->company_name ?? '') }}">
                                <input type="hidden" name="aboutCompany" value="{{ old('aboutCompany', $employer->about_company ?? '') }}">
                                <input type="hidden" name="website" value="{{ old('website', $employer->website ?? '') }}">
                            </div>

                            <div class="card-footer p-4">
                                <button type="submit" class="btn btn-primary">Post Job</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


</x-header-footer>

<script>
    function toggleSalaryFields() {
        let offeredSalary = document.getElementById('offered_salary').value;
        document.getElementById('salary_field').style.display = (offeredSalary === 'fixed' || offeredSalary === 'negotiable') ? 'block' : 'none';
        document.getElementById('min_salary_field').style.display = (offeredSalary === 'range') ? 'block' : 'none';
        document.getElementById('max_salary_field').style.display = (offeredSalary === 'range') ? 'block' : 'none';
    }

    // Fetch job titles based on category
    document.getElementById('category').addEventListener('change', function () {
        let categoryId = this.value;
        let jobTitleSelect = document.getElementById('job_title');
        jobTitleSelect.innerHTML = '<option>Loading...</option>';

        fetch(`/api/job-titles/${categoryId}`)
            .then(res => res.json())
            .then(data => {
                jobTitleSelect.innerHTML = '<option value="">Select Title</option>';
                data.forEach(title => {
                    jobTitleSelect.innerHTML += `<option value="${title.id}">${title.job_title}</option>`;
                });
            })
            .catch(err => {
                console.error(err);
                jobTitleSelect.innerHTML = '<option>Error loading titles</option>';
            });
    });

    setTimeout(function () {
        let successAlert = document.getElementById('success-alert');
        let errorAlert = document.getElementById('error-alert');
        if (successAlert) {
            successAlert.style.transition = "opacity 0.5s ease";
            successAlert.style.opacity = "0";
            setTimeout(() => successAlert.style.display = "none", 500);
        }
        if (errorAlert) {
            errorAlert.style.transition = "opacity 0.5s ease";
            errorAlert.style.opacity = "0";
            setTimeout(() => errorAlert.style.display = "none", 500);
        }
    }, 2000);
</script>
