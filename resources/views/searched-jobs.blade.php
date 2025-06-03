
<x-header-footer>
    <style>
        .fixed-height-card {
            height: 350px; /* Set a fixed height for the card */
            overflow: hidden;
        }

        .scrollable-content {
            flex-grow: 1;
            overflow-y: auto; /* Enable vertical scrolling */
            max-height: 180px; /* Adjust height for scrollable area */
            padding-right: 5px; /* Add some spacing to prevent scrollbar overlap */
        }

        /* Hide scrollbar for Chrome, Safari and Edge */
        .scrollable-content::-webkit-scrollbar {
            width: 5px;
        }

        .scrollable-content::-webkit-scrollbar-thumb {
            background: #ddd;
            border-radius: 10px;
        }

        .scrollable-content::-webkit-scrollbar-thumb:hover {
            background: #aaa;
        }

        .navbar .badge {
            font-size: 0.7rem;
        }


    </style>

    @if(session('success'))
        <div id="success-message" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    <style>
        #success-message {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
        }
        
        .large-gap {
            height: 150px; /* Adjust this value to increase the gap before the footer */
        }
    </style>
    <style>
        .scrollable-job-content::-webkit-scrollbar {
            width: 5px;
        }
        .scrollable-job-content::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }
        .scrollable-job-content {
            max-height: 120px;
            padding-right: 5px;
        }
        
    </style>
    
    <script>
        setTimeout(function() {
            let successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.opacity = "0";
                setTimeout(() => successMessage.remove(), 500);
            }
        }, 700);
    </script>

    <section class="section-1 py-5"> 
        <div class="container">
            <div class="card border-0 shadow p-5">
                <form method="GET" action="{{ route('searchJobs') }}">
                    <div class="row">
                        <div class="col-md-9 mb-3">
                            <input type="text" class="form-control" name="search" id="search" placeholder="Search by Job Title or Skills or Location" value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-block">Search</button>
                            </div>
                        </div>
                    </div>  
                </form>
            </div>
        </div>
    </section>

    <hr>
  

    <section id="searched-jobs" class="section-3 bg-2 py-5">
        <div class="container">
            <h2><u><b>Searched Jobs :</b></u></h2>
            <div class="row pt-5 job_listing_area">
                @if($jobs->count())
                    @foreach($jobs as $job)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card p-4 shadow-sm h-100 d-flex flex-column" style="height: 400px; overflow: hidden;">
                                <h4 class="mb-2">{{ $job->jobTitle->job_title ?? 'No Title' }}</h4>
                                {{-- <p class="mb-1">
                                    <strong>Category:</strong> {{ $job->category->job_category ?? 'No Category' }}
                                </p>
                                <p class="mb-1">
                                    <strong>Job Type:</strong> {{ $job->job_type }} |
                                    <strong>Location:</strong> {{ $job->employer->city ?? 'N/A' }}
                                </p> --}}
    
                                <div class="scrollable-job-content mt-2 mb-3 border" style="overflow-y: auto; flex-grow: 1;">
                                    <p class="mb-2"><strong>Required Skills:</strong></p>
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
    
                                <a href="{{ route('job-details', ['id' => $job->id]) }}" class="btn btn-primary btn-lg w-100 mt-auto">View Details</a>
                            </div>
                        </div>
                    @endforeach
    
                    <div class="d-flex justify-content-center mt-4">
                        {{ $jobs->appends(request()->input())->links() }}
                    </div>
                @else
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            No jobs found matching your search.
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    
    <hr>
    <script>
        window.onload = function() {
            const targetSection = document.getElementById('searched-jobs');
            if (targetSection) {
                targetSection.scrollIntoView({ behavior: 'smooth' });
            }
        };
    </script>
    
</x-header-footer>