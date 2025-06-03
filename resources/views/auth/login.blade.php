
<x-header-footer>

    @if(session('success'))
        <div id="success-message" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

<!-- Add this CSS for positioning the alert in the top-right corner -->
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
        setTimeout(function() {
            let successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.opacity = "0";
                setTimeout(() => successMessage.remove(), 500);
            }
        }, 500);
    </script>


<section class="section-5">
    <div class="container my-5">
        <div class="py-lg-2">&nbsp;</div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h1 class="h3">Login</h1>
                  

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

                    <form action="{{route('login')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="mb-2">Email<span class="req">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="example@example.com">
                        </div> 
                        <div class="mb-3">
                            <label for="password" class="mb-2">Password<span class="req">*</span></label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
                        </div> 
                        <div class="mb-3">
                            <input type="checkbox" name="remember"> Remember Me
                        </div> 
                        <div class="justify-content-between d-flex">
                            <button class="col-md-5 btn btn-primary mt-2">Login</button>
                            <a href="{{ route('password.request') }}" class="mt-3 text-warning">Forgot Password?</a>
                        </div>
                    </form>                    
                </div>
                <div class="mt-4 text-center">
                    <p>Do not have an account? <br><i>Click on Register to create new account.</i></a></p>
                </div>
            </div>
        </div>
        <div class="py-lg-5">&nbsp;</div>
    </div>
</section>
</x-header-footer>