<x-header-footer>

    @if(session('status'))
        <div id="success-message" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
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
    </style>

    <script>
        setTimeout(function () {
            let successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.opacity = "0";
                setTimeout(() => successMessage.remove(), 500);
            }
        }, 700);
    </script>

    <section class="section-5">
        <div class="container my-5">
            <div class="py-lg-2">&nbsp;</div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow border-0 p-5">
                        <h1 class="h3 mb-4">Reset Password</h1>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="mb-3">
                                <label for="email" class="form-label">Email<span class="req">*</span></label>
                                <input type="email" id="email" name="email" class="form-control" required placeholder="example@example.com">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">New Password<span class="req">*</span></label>
                                <input type="password" id="password" name="password" class="form-control" required placeholder="Enter new password">
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password<span class="req">*</span></label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required placeholder="Confirm password">
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-100 mt-2">Reset Password</button>
                            </div>
                        </form>
                    </div>
                    <div class="mt-4 text-center">
                        <p>Already have an account? <br><a href="{{ route('login') }}"><i>Click here to login</i></a></p>
                    </div>
                    <div class="mt-4 text-center">
                        <p><br><a href="{{ route('login') }}"><i>Cancel</i></a></p>
                    </div>
                </div>
            </div>
            <div class="py-lg-5">&nbsp;</div>
        </div>
    </section>

</x-header-footer>
