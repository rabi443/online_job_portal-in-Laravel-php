
<x-header-footer>
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
                            {{-- <li class="breadcrumb-item active">Job Applications</li> --}}
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <!-- Sidebar -->
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
                                    <li class="list-group-item p-3">
                                        <a href="{{ asset('/account-setting') }}">Account Settings</a>
                                    </li>
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

                <!-- Job Applications Section -->
                <div class="col-lg-9">
                   @if(session('success'))
                        <div class="alert alert-success" id="successMessage">
                            {{ session('success') }}
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                setTimeout(() => {
                                    const successMsg = document.getElementById('successMessage');
                                    if (successMsg) {
                                        successMsg.style.display = 'none';
                                    }
                                }, 1000); // 1000ms = 1 second
                            });
                        </script>
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
                        <h4 class="mb-4"><b>Applicants</b></h4>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle p-3">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Resume</S>
                                        <th>Application Status</th>
                                        <th>Applied Date</th>
                                        <th>Action</th>
                                      </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jobApplications as $applicant) 
                                        @php
                                            $user = $applicant->jobseeker->user;
                                            $jobseeker = $applicant->jobseeker;
                                            $resume = $user->resume;
                                            $job = $applicant->job;
                                            // $employer = $job->employer;
                                        @endphp
                                        <tr class="application-row">
                                            <td>{{ $jobseeker->fname ?? 'N/A' }}{{ $jobseeker->lname ?? 'N/A' }}</td>
                                            <td>{{ $user->email ?? 'N/A' }}</td>
                                            <td>{{ $user->contact_number ?? 'N/A' }}</td>
                                            <td>
                                                @if ($resume)
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#resumeModal{{ $applicant->id }}">View Resume</a>
                                                @else
                                                    Pending
                                                @endif
                                            </td>
                                            <td>
                                                @php

                                                    $status = strtolower($applicant->status ?? 'N/A');
                                                    $statusClass = match($status) {
                                                        // 'Pending' => 'bg-black',
                                                        'accepted' => 'bg-success',
                                                        'rejected' => 'bg-danger',
                                                        default => 'bg-secondary'
                                                    };
                                                @endphp
                                                <span class="badge {{ $statusClass }}">{{ ucfirst($applicant->status ?? 'Unknown') }}</span>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($applicant->created_at)->format('F d, Y') }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline dropdown-toggle" type="button" id="dropdownMenuButton{{ $job->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                        ⋮
                                                    </button>
                                                    <ul class="dropdown-menu" >
                                                        @if($applicant->status == 'pending')   
                                                            <li>
                                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#interviewModal{{ $jobseeker->id }}">
                                                                    Accept
                                                                </a>
                                                            </li>
                                                            <li><a class="dropdown-item" href="{{route('reject-applicants', ['applicant_id' => $applicant->id]) }}" onclick="return confirm('Are you sure you want to reject this applicant?')">reject</a></li>
                                                        @elseif($applicant->status == 'accepted')
                                                            <li>
                                                                <a class="dropdown-item text-success" href="#"
                                                                style="pointer-events: none; opacity: 0.6; cursor: default;" 
                                                                aria-disabled="true">Accepted</a>
                                                            </li>
                                                        @elseif($applicant->status == 'rejected')
                                                            <li>        
                                                                <a class="dropdown-item text-danger" href="#"
                                                                style="pointer-events: none; opacity: 0.6; cursor: default;" 
                                                                aria-disabled="true">Rejected</a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal for Interview Date -->
                                        <div class="modal fade" id="interviewModal{{ $jobseeker->id }}" tabindex="-1" aria-labelledby="interviewModalLabel{{ $applicant->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="{{ route('send.interview.invitation', $applicant->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="interviewModalLabel{{ $jobseeker->id }}"><b>Interview Invitation</b></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="interview_date">Interview Date & Time</label>
                                                                <input type="datetime-local" name="interview_date" class="form-control" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="meet_link">Meeting Link (optional)</label>
                                                                <input type="url" name="meet_link" class="form-control" placeholder="https://meet.google.com/...">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Send Invitation</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        {{-- Modal for Resume  start --}}
                                        @php
                                            $user = $applicant->jobseeker->user;
                                            $resume = \App\Models\Resume::where('user_id', $user->id)->first();
                                            $profile = \App\Models\ProfilePicture::where('user_id', $user->id)->first();
                                        @endphp

                                        @if ($resume)
                                        <div class="modal fade" id="resumeModal{{ $applicant->id }}" tabindex="-1" aria-labelledby="resumeModalLabel{{ $applicant->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered modal-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body p-4">
                                                        <div class="text-center mb-4">
                                                            <img src="{{ $profile?->file_path ? asset('storage/' . $profile->file_path) : asset('images/avatar7.png') }}"
                                                                class="rounded-circle"
                                                                style="width: 120px; height: 120px; object-fit: cover;"
                                                                alt="Profile Photo">
                                                            <h4 class="mt-3">{{ $resume->name }}</h4>
                                                            <p class="text-muted">{{ $user->email }}</p>
                                                            <p class="text-muted">{{ $user->contact_number }}</p>
                                                        </div>
                                                        <hr>
                                                        <h5><strong><u>Description :</u></strong></h5>
                                                        <p>{{ $resume->summary ?? 'N/A' }}</p>
                                                        @php
                                                        // Decode before sending to view
                                                        $resume['experience'] = json_decode($resume['experience'], true);
                                                        $resume['education'] = json_decode($resume['education'], true);
                                                        $resume['skills'] = $resume['skills'] ? explode(',', $resume['skills']) : [];
                                                        @endphp

                                                        <h5><strong><u>Skills :</u></strong></h5>
                                                        @if(is_array($resume->skills) && count($resume->skills) > 0)
                                                            <p>{{ implode(', ', $resume->skills) }}</p>
                                                        @else
                                                            <p>No skills listed.</p>
                                                        @endif

                                                        <h5><strong><u>Education :</u></strong></h5>
                                                        <ul>
                                                            @foreach($resume->education as $edu)
                                                                <li>
                                                                    <strong>{{ $edu['degree'] }}</strong> at 
                                                                    {{ $edu['institution'] }} ({{ $edu['year'] }})
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                        <h5><strong><u>Experience :</u></strong></h5>
                                                        <ul>
                                                            @foreach($resume->experience as $exp)
                                                                <li>
                                                                    <strong>{{ $exp['position'] }}</strong> at {{ $exp['company'] }},
                                                                    <span>since ({{ $exp['years'] }})</span>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>

                            <p id="jobCount" class="mt-3 text-end fw-semibold">
                                Total Applicants: {{ $applicationCount }}
                            </p>
                            <p id="jobCount" class="mt-3 text-end fw-semibold">
                                <a href="{{route('applications')}}"><button>back</button></a>    
                            </p>
                            <div id="pagination" class="mt-3 d-flex justify-content-center gap-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pagination Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const rows = document.querySelectorAll(".application-row");
            const rowsPerPage = 5;
            const paginationContainer = document.getElementById("pagination");
            const applicationCountDisplay = document.getElementById("applicationCount");

            function showPage(pageNumber) {
                const start = (pageNumber - 1) * rowsPerPage;
                const end = start + rowsPerPage;

                rows.forEach((row, index) => {
                    row.style.display = index >= start && index < end ? "" : "none";
                });

                updatePagination(pageNumber);
                updateApplicationCount(rows.length);
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

            function updateApplicationCount(total) {
                applicationCountDisplay.innerText = `Total Applications: ${total}`;
            }

            showPage(1);
        });
    </script>
</x-header-footer>
