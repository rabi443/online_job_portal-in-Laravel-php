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
        <div class="col-md-9 p-4">
            <div class="row g-3">
                <!-- Cards -->
                <div class="col-md-6 col-lg-4">
                    <div class="card text-white bg-success shadow-sm">
                        <div class="card-body">
                            <a href="{{route('admin.employers')}}"" class="text-white text-decoration-none">
                                <h6>Total Employers</h6>
                                <h3>{{ $employersCount ?? 0 }}</h3>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card text-white bg-info shadow-sm">
                        <div class="card-body">
                            <a href="{{route('admin.jobseekers')}}"" class="text-white text-decoration-none">
                                <h6>Total Jobseekers</h6>
                                <h3>{{ $jobseekersCount ?? 0 }}</h3>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card text-white bg-warning shadow-sm">
                        <div class="card-body">
                            <a href="{{route('admin.jobs')}}" class="text-white text-decoration-none">
                                <h6>Total Jobs</h6>
                                <h3>{{ $jobsCount ?? 0 }}</h3>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card text-white bg-danger shadow-sm">
                        <div class="card-body">
                            <a href="#" class="text-white text-decoration-none">
                                <h6>Applications Received</h6>
                                <h3>{{ $applicationsCount ?? 0 }}</h3>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</section>
      
</x-admin-header-footer>
