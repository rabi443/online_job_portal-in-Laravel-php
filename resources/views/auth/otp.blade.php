{{-- <x-header-footer>
    <div class="container">
        <h2>Enter OTP</h2>
        <p>We have sent a 6-digit OTP to your email. Please enter it below to verify your account.</p>
    
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    
        <form action="{{ route('verifyOtp') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user_id }}">
    
            <label for="otp">OTP:</label>
            <input type="text" name="otp" required maxlength="6">

             <!-- Display error message for OTP field -->
            @error('otp')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <button type="submit">Verify</button>
        </form>
    
        <form action="{{ route('cancelOtp') }}" method="POST">
            @csrf
            <button type="submit" style="background-color: red;">Cancel Registration</button>
        </form>
    </div>
</x-header-footer> --}}




<x-header-footer>
    <section class="section-5">
        <div class="container my-5">
            <div class="py-lg-2">&nbsp;</div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow border-0 p-5">
                        <h5 class="text-center">verify your acount</h5>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('verifyOtp') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <input type="hidden" name="user_id" id="user_id" class="form-control" value="{{ $user_id }}">
                            </div> 
                            <div class="mb-3 text-center">
                                <label for="otp" class="mb-2 text-warning"><small><i>OTP has been sent to your email account.</i></small></label>
                                <input type="password" name="otp" id="otp" class="form-control text-center" maxlength="6" placeholder="enter 6 digit OTP" required>
                            </div> 
                            
                            <!-- Display error message for OTP field -->
                            @error('otp')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="text-center">
                                <button class="col-md-4 btn btn-primary mt-2">Submit</button>
                            </div>
                        </form>         
                    </div>
                    <div class="mt-4 text-center">
                        <form action="{{ route('cancelOtp') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-warning bg-transparent border-none p-0 m-0" style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                Cancel Registration
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="py-lg-5">&nbsp;</div>
        </div>
    </section>
    </x-header-footer>