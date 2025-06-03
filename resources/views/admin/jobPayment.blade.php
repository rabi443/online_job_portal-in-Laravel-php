<x-admin-header-footer>
    <style>
        .admin-sidebar {
            min-height: 100vh;
            background-color: #f8f9fa;
            border-right: 1px solid #ddd;
            position: sticky;
            top: 0;
        }
    
        .admin-sidebar ul li a {
            display: block;
            padding: 10px 15px;
            color: #333;
            font-weight: 500;
            text-decoration: none;
        }
    
        .admin-sidebar ul li a:hover,
        .admin-sidebar ul li a.active {
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
        }
    </style>
    
<section class="admin-dashboard container-fluid py-4 mt-4">
    <div class="row gx-0">
        <!-- Sidebar -->
        <div class="col-md-3 admin-sidebar p-3">
            <h5 class="text-primary mb-4">Admin Menu</h5>
            <ul class="list-unstyled">
                  <li><a href="{{ route('admin.dashboard') }}" class="active">🏠 Dashboard</a></li>
                <li><a href="{{ route('admin.employers') }}">👥 Manage Employers</a></li>
                <li><a href="{{ route('admin.jobseekers') }}">📋 Manage JobSeekers</a></li>
                <li><a href="{{ route('admin.jobs') }}">📄 Manage Jobs</a></li>
                <li><a href="{{ route('admin.payments') }}">📄 Manage Jobs payment</a></li>
                <li><a href="{{ url('/admin.categories') }}">🗂️ Job Categories</a></li>
                <li><a href="{{ url('/admin.settings') }}">⚙️ Settings</a></li>
            </ul>
        </div>
    
        <!-- Main Content -->
        <div class="card col-md-9 border-0 shadow p-4">
            <h4 class="mb-4">Payments for Jobs</h4>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Payment Id</th>
                            <th>Job Id</th>
                            <th>Amount</th>
                            <th>Tax Amount</th>
                            <th>Total Amount</th>
                            <th>Payment Status</th>
                            <th>Payment Date</th>
                            {{-- <th>Expire Date</th> --}}
                            {{-- <th>No. of Application</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            {{-- @php
                                $jobTitle = $job->jobTitle;
                                $employer = $job->employer;
                                $jobCategory = $job->category;
                            @endphp --}}
                            <tr class="job-row">
                                <td>{{ $payment->id ?? 'N/A' }}</td>
                                <td>{{ $payment->job_id ?? 'N/A' }}</td>
                                <td>{{ $payment->amount ?? 'N/A' }}</td>
                                <td>{{ $payment->tax_amount ?? 'N/A' }}</td>
                                <td>{{ $payment->total_amount ?? 'N/A' }}</td>
                                <td>{{ $payment->payment_status ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('F d, Y') }}</td>
                                {{-- <td>{{ \Carbon\Carbon::parse($job->expire_date)->format('F d, Y') }}</td> --}}
                                {{-- <td>{{ $job->applications_count ?? 'N/A' }}</td> --}}
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline dropdown-toggle" type="button" id="dropdownMenuButton{{ $payment->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                            ⋮
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $payment->job_id }}">
                                            <li><a class="dropdown-item" href="{{ route('admin.job-details', ['job_id' => $payment->job_id]) }}">View Job Details</a></li>
                                            <li><a class="dropdown-item text-primary" href="{{ route('admin.approve-jobs', ['job_id' => $payment->job_id]) }}">Approve</a></li>
                                            
                                            <li>
                                                <form action="{{ url('/jobs/' . $payment->job_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item text-danger" type="submit">Delete</button>
                                                </form>
                                            </li>
                                           
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
        
                {{-- <p id="jobCount" class="mt-3 text-end fw-semibold">
                    Total Active Jobs: {{ $activeJobs->count() }}
                </p> --}}
        
                {{-- Client-side Pagination Container --}}
                <div id="pagination" class="mt-3 d-flex justify-content-center gap-2"></div>
            </div>

            {{-- <h4 class="mb-4">Expired Jobs</h4>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Job Id</th>
                            <th>Job Category</th>
                            <th>Job Title</th>
                            <th>Company Name</th>
                            <th>Location</th>
                            <th>Posted Date</th>
                            <th>Expire Date</th>
                            <th>No. of Application</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expiredJobs as $job)
                            @php
                                $jobTitle = $job->jobTitle;
                                $employer = $job->employer;
                                $jobCategory = $job->category;
                            @endphp
                            <tr class="job-row">
                                <td>{{ $job->id ?? 'N/A' }}</td>
                                <td>{{ $jobCategory->job_category ?? 'N/A' }}</td>
                                <td>{{ $jobTitle->job_title ?? 'N/A' }}</td>
                                <td>{{ $employer->company_name ?? 'No Company Name' }}</td>
                                <td>{{ $employer->city ?? 'No City' }}</td>
                                <td>{{ \Carbon\Carbon::parse($job->posted_date)->format('F d, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($job->expire_date)->format('F d, Y') }}</td>
                                <td>{{ $job->applications_count ?? 'N/A' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline dropdown-toggle" type="button" id="dropdownMenuButton{{ $job->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                            ⋮
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $job->id }}">
                                            <li><a class="dropdown-item" href="{{ url('/jobs/' . $job->id) }}">View</a></li>
                                            <li><a class="dropdown-item" href="{{ url('/jobs/' . $job->id . '/edit') }}">Edit</a></li>
                                            
                                            
                                            <li>
                                                <form action="{{ url('/jobs/' . $job->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item text-danger" type="submit">Delete</button>
                                                </form>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        
                <p id="jobCount" class="mt-3 text-end fw-semibold">
                    Total Expired Jobs: {{ $expiredJobs->count() }}
                </p>
        
                
                <div id="pagination" class="mt-3 d-flex justify-content-center gap-2"></div>
            </div> --}}
        </div>

    </div>
    
</section>
      
</x-admin-header-footer>
