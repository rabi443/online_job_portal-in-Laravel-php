<x-header-footer>
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">jobs applied</li>
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

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card border-0 shadow p-4">
                        <h4 class="mb-4"><b>Applied Jobs</b></h4>
                    
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Application Id</th>
                                        <th>Job Id</th>
                                        <th>Date Applied</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jobApplications as $job)
                                    <tr class="job-row">
                                        <td>{{$job->id}}</td>
                                        <td>{{$job->job_id}}</td>
                                        <td>{{ \Carbon\Carbon::parse($job->created_at)->format('F d, Y') }}</td>
                                        <td>
                                            @php
                                                $statusClass = match($job->status) {
                                                    'Pending' => 'bg-warning',
                                                    'accepted' => 'bg-success',
                                                    'rejected' => 'bg-danger',
                                                    default => 'bg-secondary'
                                                };
                                            @endphp
                                            <span class="badge {{ $statusClass }}">{{ $job->status }}</span>
                                        </td>
                                        <td><a href="{{ route('job-details', ['id' => $job->job_id]) }}" class="btn btn-sm btn-outline-primary">View</a></td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>

                            <p id="jobCount" class="mt-3 text-end fw-semibold"></p>

                            <div id="pagination" class="mt-3 d-flex justify-content-center gap-2"></div>

                        </div>
                    </div>
                    

                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const rows = document.querySelectorAll(".job-row");
            const rowsPerPage = 4;
            const paginationContainer = document.getElementById("pagination");
            const jobCountDisplay = document.getElementById("jobCount");
    
            function showPage(pageNumber) {
                const start = (pageNumber - 1) * rowsPerPage;
                const end = start + rowsPerPage;
    
                rows.forEach((row, index) => {
                    row.style.display = index >= start && index < end ? "" : "none";
                });
    
                updatePagination(pageNumber);
                updateJobCount(rows.length); // 👈 Update count every time (optional)
            }
    
            function updatePagination(currentPage) {
                const totalPages = Math.ceil(rows.length / rowsPerPage);
                paginationContainer.innerHTML = "";
    
                for (let i = 1; i <= totalPages; i++) {
                    const button = document.createElement("button");
                    button.classList.add("btn", "btn-sm", "btn-outline-primary");
                    if (i === currentPage) button.classList.add("active");
                    button.innerText = i;
                    button.addEventListener("click", () => showPage(i));
                    paginationContainer.appendChild(button);
                }
            }
    
            function updateJobCount(total) {
                jobCountDisplay.innerText = `Total Applied Jobs: ${total}`;
            }
    
            showPage(1); // Show the first page by default
        });
    </script>
    
    
    
</x-header-footer>

