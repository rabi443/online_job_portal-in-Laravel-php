<x-header-footer>
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
    <h2>Forgot Password</h2>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <label>Email:</label>
        <input type="email" name="email" required>
        <button type="submit">Send Reset Link</button>
    </form>
</body>
</html> --}}

{{-- <section class="section-5">
    <div class="container my-5">
        <div class="py-lg-2">&nbsp;</div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h2 class="h3">Forgot password</h2><br>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('password.email') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="mb-2">Enter your email<span class="req">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="example@example.com" required>
                        </div>  
                        <div class="justify-content-center d-flex">
                            <button class="btn btn-primary mt-2">Send reset link</button>
                        </div>    
                        <div class="justify-content-center d-flex">
                            <a href="{{ route('login') }}" class="mt-3 text-warning">cancel</a>
                        </div>   
                    </form>                    
                </div>
            </div>
        </div>
        <div class="py-lg-5">&nbsp;</div>
    </div>
</section> --}}




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
