<x-header-footer>
    <style>
        .fixed-height-card {
            height: 350px;
            overflow: hidden;
        }

        .scrollable-content {
            flex-grow: 1;
            overflow-y: auto;
            max-height: 180px;
            padding-right: 5px;
        }

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

        #success-message {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
        }

        .large-gap {
            height: 150px;
        }

        /* Background image container styles */
        .section-0 {
            min-height: 250px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
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

    <script>
        setTimeout(function() {
            let successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.opacity = "0";
                setTimeout(() => successMessage.remove(), 500);
            }
        }, 500);  
    </script>

    <section class="section-0 d-flex dark align-items-center" 
        style="background-image: url('{{ asset('images/banner6.jpg') }}');">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-8">
                    <h1 id="dynamic-text" class="text-light fw-bold">Find your dream job</h1>
                    <h1><p id="date" class="text-light mt-3" style="font-weight: 500;"></p></h1>
                </div>
            </div>
        </div>
    </section>

    <section id="popular-categories" class="section-1 py-5">
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

    <section class="section-2 bg-2 py-5">
        <div class="container">
            <h2><u><b>Popular Categories:</b></u></h2>
            <div class="row pt-5">
                @foreach($categories as $category)
                    <div class="col-lg-4 col-xl-3 col-md-6 mb-4">
                        <div class="single_catagory border-0 p-3 shadow">
                            <a href="{{ route('jobListByCategory', $category->id) }}">
                                <h4 class="pb-2">{{ $category->job_category }}</h4>
                            </a>
                            <p class="mb-0">
                                <span>{{ $category->jobs_count }}</span>
                                Available Job{{ $category->jobs_count !== 1 ? "'s" : '' }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <hr>

    <section class="section-3 bg-2 py-5">
        <div class="container">
            <h2><u><b>Latest Jobs:</b></u></h2>
            <div class="row pt-5">
                <div class="job_listing_area">
                    <div class="job_lists">
                        <div class="row">
                            @if(isset($jobs) && count($jobs) > 0)
                                @foreach($jobs as $job)
                                    <div class="col-md-4">
                                        <div class="card border-0 p-3 shadow mb-4 fixed-height-card">
                                            <div class="card-body d-flex flex-column">
                                                <h3 class="fs-5 pb-2 mb-0">{{ $job->jobTitle->job_title ?? 'No Title' }}</h3>
                                                <div class="scrollable-content">
                                                    <div class="bg-light p-3 border">
                                                        <p class="mb-0">
                                                            <strong><i class="fa fa-map-marker"></i></strong>
                                                            <span class="ps-1">{{ $job->functional_area ?? 'N/A' }}</span>
                                                        </p>
                                                        <p class="mb-0">
                                                            <strong><i class="fa fa-clock-o"></i></strong>
                                                            <span class="ps-1">{{ $job->job_type }}</span>
                                                        </p>
                                                        <p class="mb-0">
                                                            <strong><i class="fa fa-rupee"></i></strong>
                                                            <span class="ps-1">
                                                                @if($job->min_salary && $job->max_salary)
                                                                    {{ $job->min_salary }} - {{ $job->max_salary }}
                                                                @else
                                                                    {{ $job->salary ?? 'N/A' }} {{ $job->salary_basis === 'monthly' ? 'per month' : 'per annum' }}
                                                                @endif
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <p>{{ $job->job_description }}</p>
                                                </div>
                                                <div class="mt-3">
                                                    <a href="{{ route('job-details', ['id' => $job->id]) }}" class="btn btn-primary btn-lg w-100">Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-center">No jobs found.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr>

    <script>
        // Rotating dynamic text
        const texts = [
            "Find your dream job",
            "Explore top companies hiring now",
            "New opportunities every day",
            "Your future starts here"
        ];
        let currentTextIndex = 0;
        function updateText() {
            document.getElementById('dynamic-text').textContent = texts[currentTextIndex];
            currentTextIndex = (currentTextIndex + 1) % texts.length;
        }

        // Set current date
        function updateDate() {
            const now = new Date();
            document.getElementById('date').textContent = now.toLocaleDateString(undefined, {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        }

        setInterval(updateText, 4000);
        updateText();
        updateDate();
    </script>
</x-header-footer>
