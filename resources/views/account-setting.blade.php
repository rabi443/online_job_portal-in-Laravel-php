<x-header-footer>
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">Account Setting</li>
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
                            @if(Auth::user()->role == 'employer')
                                <p class="text-muted mb-1 fs-6">{{ $employer->company_name }}</p>
                            @elseif(Auth::user()->role == 'jobseeker')
                                <p class="text-muted mb-1 fs-6">{{ $jobSeeker->fname }} 
                                    @if($jobSeeker->mname)
                                        {{ $jobSeeker->mname }} 
                                    @endif
                                    {{ $jobSeeker->lname }}
                                </p>
                            @endif

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
                                        <a href="{{ route('applied-jobs') }}">Jobs Applied</a>
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

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('change-password') }}" method="POST">
                        @csrf
                       <div class="card border-0 shadow mb-4">
                            <div class="card-body p-4">
                                <h3 class="fs-4 mb-1"><b>Change Password</b></h3><hr>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Old Password*</label>
                                    <input type="password" name="current_password" placeholder="Old Password" class="form-control" required>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">New Password*</label>
                                    <input type="password" name="new_password" placeholder="New Password" class="form-control" required>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Confirm Password*</label>
                                    <input type="password" name="new_password_confirmation" placeholder="Confirm Password" class="form-control" required>
                                </div>                        
                            </div>
                            <div class="card-footer  p-4">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </div>  
                    </form>
                                
                </div>
            </div>
        </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(function () {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500); // Remove the alert from DOM after fade-out
            });
        }, 500); // 0.5 second delay before hiding starts
    });
</script>

</x-header-footer>


