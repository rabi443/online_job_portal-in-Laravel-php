<x-admin-header-footer>
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                {{-- <div class="col-lg-3">
                    <div class="card account-nav border-0 shadow mb-4 mb-lg-0">
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item p-3">
                                    <a href="{{ route('admin.ActiveJobs') }}">Active Jobs</a>
                                </li>
                                <li class="list-group-item p-3">
                                    <a href="{{ route('admin.PendingJobs') }}">Pending Jobs</a>
                                </li>
                                <li class="list-group-item p-3">
                                    <a href="{{ route('admin.ExpiredJobs') }}">Expired Jobs</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> --}}


         
                <div class="col-md-8">
                    <div class="card shadow border-0" style="overflow: hidden; padding: 20px; border-radius: 5px;">
                        <div class="job_details_header">
                            <div class="single_jobs white-bg d-flex justify-content-between">
                                <div class="jobs_left d-flex align-items-center">
                                    <div class="jobs_conetent">
                                       <h3> <b><i>{{ $job->category->job_category ?? 'No Category' }} :   
                                        {{ $job->jobTitle->job_title ?? 'No Title' }}</i></b> </h3>
                                        <h4><b><i>Job Status: {{$job->status}}</i></b></h4>
                                    </div>
                                </div>
                            </div>
                        </div><hr>
                        <div class="descript_wrap white-bg">
                            <div class="single_wrap">
                                <h4><b><u>Required Skills:</u></b></h4>
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
                                <h4><b><u>Experience:</u></b></h4>
                                <p>{{$job->experience}}</p>
                            </div>

                            <div class="single_wrap">
                                <h4><u><b>Job description :</b></u></h4>
                                <p>{{$job->job_description}}</p>
                            </div>

                            @if($job->what_we_offer)
                                <div class="single_wrap">
                                    <h4><u><b>What we offer :</b></u></h4>
                                    <p>{{$job->what_we_offer}}</p>
                                </div>
                            @endif
                            <div class="border-bottom"></div>
                            <div class="pt-3 text-end">
                                <a href="{{route('admin.PendingJobs')}}" class="btn btn-secondary">cancel</a>
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
                    <div class="card shadow border-0" style="overflow: hidden; padding: 20px; border-radius: 5px;">
                        <div class="job_sumary">
                            <div class="summery_header pb-1 ">
                                <h3><b><u>Job Summery</u></b></h3>
                            </div>
                            <div class="job_content pt-3">
                                <ul>
                                    <li><i><b>Published on:</b></i> <span>{{$job->posted_date}}</span></li>
                                    <li><i><b>Expired on:</b></i> <span>{{$job->expire_date}}</span></li>
                                    <li><i><b>Vacancy:</b></i> <span>{{$job->number_of_vacancies}}</span></li>
                                    <li><i><b>Salary: </b></i>
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
                                    <li><b>Location:</b><i></i> <span>{{$employer->city}}</span></li>
                                    <li><i><b>Job Nature:</b></i> <span> {{$job->job_type}} </span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow border-0 my-4" style="overflow: hidden; padding: 20px; border-radius: 5px;">
                        <div class="job_sumary">
                            <div class="summery_header pb-1">
                                <h3><b><u>Company Details</u></b></h3>
                            </div>
                            <div class="job_content pt-3">
                                <ul>
                                    <li><i><b>Name:</b></i><span>{{$employer->company_name}}</span></li>
                                    <li><i><b>Locaion:</b></i><span>{{$employer->city}},{{$employer->country}}</span></li>
                                    <li><i><b>Webite:</b></i><span>{{$employer->website}}</span></li>
                                </ul>
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
