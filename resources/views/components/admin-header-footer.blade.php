<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HDC Job Portals</title>

    <!-- Bootstrap & Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            padding-top: 80px;
        }

        a {
            text-decoration: none;
        }


        header,
        .navbar {
            background-color: #002147 !important; /* MeroShare-style deep blue */
        }

        .navbar .nav-link,
        .navbar .navbar-brand,
        .navbar .dropdown-toggle,
        .navbar .dropdown-item {
            color: #fff !important;
        }

        .navbar .dropdown-menu {
            background-color: #002147;
        }

        .navbar .dropdown-item:hover {
            background-color: #001730;
        }

        footer {
            background-color: #002147;
            color: #fff;
            padding: 20px 0;
        }

        /* White Navbar Toggler Icon */
        .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.5);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%28255,255,255,1%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light shadow py-3 fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ asset('/') }}">HDC Job Portal</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-3">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.VerifiedEmployers') }}">Employers</a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.VerifiedJobSeekers')}}">JobSeekers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.ActiveJobs')}}">Jobs</a>
                        </li>
                         {{-- <li class="nav-item">
                            <a class="nav-link" href="#">Pending Jobs</a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ url('/admin.categories') }}">Job Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Job Titles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Payments</a>
                        </li> --}}

                        @auth
                            <li class="nav-item">
                                @if(Auth::user()->role == 'employer')
                                    <a class="nav-link" href="{{ route('companyInformation') }}">Profile</a>
                                @elseif(Auth::user()->role == 'jobseeker')
                                    <a class="nav-link" href="{{ route('jobSeekerInformation') }}">Profile</a>
                                @endif
                            </li>
                        @endauth
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @auth
                            @if(Auth::user()->role == 'employer' || Auth::user()->role == 'jobseeker')
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-outline-primary me-2" type="submit">Logout</button>
                                </form>
                            @elseif(Auth::user()->role == 'super_admin')
                                <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-outline-primary me-2 text-white" type="submit">Logout</button>
                                </form>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a class="btn btn-outline-primary me-2 dropdown-toggle" href="#" role="button"
                                   data-bs-toggle="dropdown" aria-expanded="false">
                                    Login
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('login') }}">User</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.login') }}">Admin</a></li>
                                </ul>
                            </li>

                            {{--
                            <li class="nav-item dropdown">
                                <a class="btn btn-outline-primary me-2 dropdown-toggle" href="#" role="button"
                                   data-bs-toggle="dropdown" aria-expanded="false">
                                    Register
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('registerJobSeeker') }}">Job Seeker</a></li>
                                    <li><a class="dropdown-item" href="{{ route('registerEmployer') }}">Employer</a></li>
                                </ul>
                            </li>
                            --}}
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container my-5">
        {{ $slot }}
    </main>

    <footer>
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 HDC BIM sixth, all rights reserved</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
