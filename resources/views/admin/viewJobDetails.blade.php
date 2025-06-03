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
    </div>

    <section class="section-4 bg-2">    
        <div class="container pt-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Back to Jobs</a></li>
                        </ol>
                    </nav>
                </div>
            </div> 
        </div>
        <div class="container job_details_area">
            <div class="row pb-5">
                <div class="col-md-8">
                    <div class="card shadow border-0">
                        <div class="job_details_header">
                            <div class="single_jobs white-bg d-flex justify-content-between">
                                <div class="jobs_left d-flex align-items-center">
                                    
                                    <div class="jobs_conetent">
                                        <a href="#">
                                            
                                            <h4>{{ $job->jobTitle->job_title ?? 'No Title' }} ({{ $job->category->job_category ?? 'No Category' }})</h4><br>

                                        </a>
                                        <div class="links_locat d-flex align-items-center">
                                            <div class="location">
                                                <p> <i class="fa fa-map-marker"></i>{{$employer->city}}</p>
                                            </div>
                                            <div class="location">
                                                <p> <i class="fa fa-clock-o"></i>{{$job->job_type}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="jobs_right">
                                    <div>
                                        Status: {{$job->status}}
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="descript_wrap white-bg">
                            <div class="single_wrap">
                                <h4>Required Skills:</h4>
                                @if($job->skill_list->count())
                                <ul>
                                    @foreach($job->skill_list as $skill)
                                        <li>{{ $skill->name }}</li>
                                    @endforeach
                                </ul>    
                                @else
                                    <p>No skills listed.</p>
                                @endif
                            </div>

                            <div class="single_wrap">
                                <h4>Experience:</h4>
                                <p>{{$job->experience}}</p>
                            </div>

                            <div class="single_wrap">
                                <h4>Job description</h4>
                                <p>{{$job->job_description}}</p>
                            </div>

                            <div class="single_wrap">
                                <h4>What we offer</h4>
                                <p>{{$job->what_we_offer}}</p>
                            </div>

                          
                            <div class="border-bottom"></div>
                            <div class="pt-3 text-end">
                                <a href="{{route('dashboard')}}" class="btn btn-secondary">cancel</a>
                                @auth
                                    @if(Auth::user()->role === 'jobseeker')
                                        @if($jobApplied)
                                            <button class="btn btn-secondary" disabled>Already Applied</button>
                                        @else
                                            <a href="{{ route('apply-for-job', $job->id) }}" class="btn btn-primary">Apply Now</a>
                                        @endif
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow border-0">
                        <div class="job_sumary">
                            <div class="summery_header pb-1 pt-4">
                                <h3>Job Summery</h3>
                            </div>
                            <div class="job_content pt-3">
                                <ul>
                                    <li>Published on: <span>{{$job->posted_date}}</span></li>
                                    <li>Expired on: <span>{{$job->expire_date}}</span></li>
                                    <li>Vacancy: <span>{{$job->number_of_vacancies}}</span></li>
                                    <li>Salary: 
                                        <span>
                                            @if($job->min_salary && $job->max_salary)
                                                {{ $job->min_salary }} - {{ $job->max_salary }}
                                            @else
                                                
                                                @if($job->salary_basis == 'monthly')
                                                    {{ $job->salary ?? 'N/A' }} per month
                                                @elseif($job->salary_basis == 'yearly')
                                                    {{ $job->salary ?? 'N/A' }} per annum
                                                @endif
                                                
                                            @endif
                                        </span>
                                    </li>
                                    <li>Location: <span>{{$employer->city}}</span></li>
                                    <li>Job Nature: <span> {{$job->job_type}} </span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow border-0 my-4">
                        <div class="job_sumary">
                            <div class="summery_header pb-1 pt-4">
                                <h3>Company Details</h3>
                            </div>
                            <div class="job_content pt-3">
                                <ul>
                                    <li><i>Name:</i> <br><span>{{$employer->company_name}}</span></li>
                                    <li><i>Locaion:</i> <br><span>{{$employer->city}},{{$employer->country}}</span></li>
                                    <li><i>Webite:</i> <br><span>{{$employer->website}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</section>
      
</x-admin-header-footer>
