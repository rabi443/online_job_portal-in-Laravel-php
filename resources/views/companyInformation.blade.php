<x-header-footer>
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
                            <li class="breadcrumb-item active"><b>Company Information</b></li>
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
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- View Mode -->
                    <div id="viewMode">
                        <div class="card border-0 shadow mb-4 p-4">
                            <h3 class="mb-3"><b>Company Information</b></h3><hr>
                            <p><strong>Company Name:</strong> {{ $employer->company_name }}</p>
                            <p><strong>Country:</strong> {{ $employer->country }}</p>
                            <p><strong>Province:</strong> {{ $employer->province }}</p>
                            <p><strong>City:</strong> {{ $employer->city }}</p>
                            <p><strong>Organization Type:</strong> {{ $employer->organization_type }}</p>
                            <p><strong>Website:</strong> <a href="{{ $employer->website }}" target="_blank">{{ $employer->website }}</a></p>
                            <p><strong>About Company:</strong> {{ $employer->about_company }}</p>
                        </div>
                    </div>

                    <div class="text-end mb-3">
                        <button id="editButton" class="btn btn-primary">Edit</button>
                    </div>




                    <!-- Edit Mode -->
                    <div id="editMode" style="display: none;">
                        <form action="{{ route('companyInformation.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <div class="card border-0 shadow mb-4 p-4">
                                <h3 class="mb-3">Edit Company Information</h3>

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
                            
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                    <button type="button" id="cancelButton" class="btn btn-secondary">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>

        </div>
    </section>
    
    <script>
        const editButton = document.getElementById('editButton');
        const viewMode = document.getElementById('viewMode');
        const editMode = document.getElementById('editMode');
        const cancelButton = document.getElementById('cancelButton');
    
        editButton.addEventListener('click', function() {
            viewMode.style.display = 'none';
            editMode.style.display = 'block';
            editButton.style.display = 'none';
        });

        cancelButton.addEventListener('click', function() {
            editMode.style.display = 'none';
            viewMode.style.display = 'block';
            editButton.style.display = 'inline-block';
        });
    </script>
</x-header-footer>
