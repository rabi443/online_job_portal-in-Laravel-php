<x-header-footer>
    
<section class="section-5">
    <div class="container my-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h2 class="h3">Forgot password</h2><br>
                    
                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
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

                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email">Enter your email <span class="req">*</span></label>
                            <input type="email" name="email" id="email" class="form-control mt-2" placeholder="example@example.com" required>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary">Send reset link</button>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('login') }}" class="mt-3 text-warning">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

</x-header-footer>
