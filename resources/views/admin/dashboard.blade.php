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
        <!-- Main Content -->
        <div class="col-md-12 p-4">
            <div class="row g-3">
                <!-- Cards -->
                <div class="col-md-6 col-lg-4">
                    <div class="card text-white bg-success shadow-sm">
                        <div class="card-body">
                            <a href="{{ route('admin.VerifiedEmployers') }}" class="text-white text-decoration-none">
                                <h6>Total Employers</h6>
                                <h3>{{ $employersCount ?? 0 }}</h3>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card text-white bg-success shadow-sm">
                        <div class="card-body">
                            <a href="{{ route('admin.VerifiedJobSeekers') }}" class="text-white text-decoration-none">
                                <h6>Total Jobseekers</h6>
                                <h3>{{ $jobSeekersCount ?? 0 }}</h3>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card text-white bg-info shadow-sm">
                        <div class="card-body">
                            <a href="{{route('admin.ActiveJobs')}}" class="text-white text-decoration-none">
                                <h6>Total Active Jobs</h6>
                                <h3>{{ $activeJobsCount ?? 0 }}</h3>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card text-white bg-warning shadow-sm">
                        <div class="card-body">
                            <a href="{{route('admin.PendingJobs')}}" class="text-white text-decoration-none">
                                <h6>Total pending Jobs</h6>
                                <h3>{{ $pendingJobsCount ?? 0 }}</h3>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    
</section>
      
</x-admin-header-footer>
