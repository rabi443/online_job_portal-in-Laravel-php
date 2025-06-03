<x-admin-header-footer>
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-3">
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
                </div>

                <div class="col-lg-9">
                    <div class="card border-0 shadow p-4">
                        <h4 class="mb-4">
                            <b>{{ ucfirst($type) }} Jobs</b>
                        </h4>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Job ID</th>
                                        <th>Title</th>
                                        <th>Company</th>
                                        <th>Location</th>
                                        <th>Job Status</th>
                                        <th>Payment Status</th>
                                        <th>Posted Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($jobs as $job)
                                        <tr>
                                            <td>{{ $job->id }}</td>
                                            <td>{{ $job->jobTitle->job_title }}</td>
                                            <td>{{ $job->employer->company_name ?? '-' }}</td>
                                            <td>{{ $job->employer->city ?? '-' }}</td>
                                            <td>
                                                <span class="badge {{ $job->status === 'active' ? 'bg-success' : ($job->status === 'pending' ? 'bg-warning' : 'bg-secondary') }}">
                                                    {{ ucfirst($job->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($job->payment)
                                                @if ($job->payment->payment_status== 'success')
                                                    <span class="badge bg-success">{{$job->payment->payment_status}}</span>
                                                @else
                                                    <span class="badge bg-warning">{{$job->payment->payment_status}}</span>
                                                @endif
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($job->posted_date)->format('F d, Y') }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                        ⋮
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('admin.ViewJobs', $job->id) }}">View</a>
                                                        </li>
                                                        @if($type === 'pending')
                                                        @if($job->payment)
                                                            @if($job->payment->payment_status == 'success')
                                                                <li>
                                                                    <a class="dropdown-item" href="{{ route('admin.approve-jobs', ['job_id' => $job->payment->job_id]) }}">Approve</a>
                                                                </li>
                                                            @endif
                                                            @endif
                                                        @endif
                                                        <li>
                                                            <form action="{{ route('admin.DeleteJobs', $job->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job?');">
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
                                            <td colspan="7" class="text-center">No {{ $type }} jobs found.</td>
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

                            <div class="mt-4">
                                {{ $jobs->links() }}
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
