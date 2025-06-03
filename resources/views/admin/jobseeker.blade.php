<x-admin-header-footer>
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card account-nav border-0 shadow mb-4 mb-lg-0">
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                @if(Auth::user()->role == 'super_admin')
                                    <li class="list-group-item p-3">
                                        <a href="{{route('admin.VerifiedJobSeekers')}}">Verified JobSeekers</a>
                                    </li>
                                     <li class="list-group-item p-3">
                                        <a href="{{route('admin.UnverifiedJobSeekers')}}">Unverified JobSeekers</a>
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
                        <h4 class="mb-4">
                            <b>
                                {{ $type === 'verified' ? 'Verified' : 'Unverified' }} JobSeekers
                            </b>
                        </h4>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Account Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($JobSeeker as $jobseeker)
                                        <tr>
                                            <td>{{ $jobseeker->id }}</td>
                                            <td>{{ $jobseeker->fname ?? '-' }}
                                                @if($jobseeker->mname)
                                                    {{ $jobseeker->mname ?? '-' }}
                                                @endif
                                                {{ $jobseeker->lname ?? '-' }}</td>
                                            <td>{{ $jobseeker->user->email ?? '-' }}</td>
                                            <td>{{ $jobseeker->user->contact_number ?? '-' }}</td>
                                            <td>
                                                <span class="badge {{ $jobseeker->user->account_status == 'verified' ? 'bg-success' : 'bg-warning' }}">
                                                    {{ ucfirst($jobseeker->user->account_status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                        ⋮
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('admin.ViewJobSeeker', $jobseeker->id) }}">View</a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('admin.DeleteJobSeeker', $jobseeker->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger">Delete</button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No {{ $type }} job seekers found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
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

