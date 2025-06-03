<x-admin-header-footer>
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card account-nav border-0 shadow mb-4 mb-lg-0">
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item p-3">
                                    <a href="{{ route('admin.VerifiedEmployers') }}">Verified Employers</a>
                                </li>
                                <li class="list-group-item p-3">
                                    <a href="{{ route('admin.UnverifiedEmployers') }}">Unverified Employers</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card border-0 shadow p-4">
                        <h4 class="mb-4"><b>{{ ucfirst($type) }} Employers</b></h4>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Company</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($employers as $employer)
                                        <tr>
                                            <td>{{ $employer->id }}</td>
                                            <td>{{ $employer->company_name ?? '-' }}</td>
                                            <td>{{ $employer->user->email ?? '-' }}</td>
                                            <td>{{ $employer->user->contact_number ?? '-' }}</td>
                                            <td>
                                                <span class="badge {{ $employer->user->account_status == 'verified' ? 'bg-success' : 'bg-warning' }}">
                                                    {{ ucfirst($employer->user->account_status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">⋮</button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="{{ route('admin.ViewEmployer', $employer->id) }}">View</a></li>
                                                        <li>
                                                            <form action="{{ route('admin.DeleteEmployer', $employer->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
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
                                            <td colspan="6" class="text-center">No {{ $type }} employers found.</td>
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

                        <div class="mt-3">
                            {{ $employers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-admin-header-footer>
