<x-header-footer>
<br><br>
<section class="section-5 m-5">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{route('register')}}" method="POST">
        @csrf
        <div class="card border-0 shadow mb-4">
            <div class="card-body card-form p-4">
                <h3 class="fs-4 mb-1">JobSeeker Registration Form</h3><hr>
                <input type="hidden" name="role" value="jobseeker" class="form-control">
                
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="email" class="mb-2">Email<span class="req">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="example@gmail.com" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="contact_number" class="mb-2">Contact Number<span class="req">*</span></label>
                        <input type="number" name="contact_number" id="number" class="form-control" placeholder="9810******" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="password" class="mb-2">Password<span class="req">*</span></label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="password" class="mb-2">Confirm Password<span class="req">*</span></label>
                        <input type="password" name="password_confirmation" id="password" class="form-control" required>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="fName" class="mb-2">First Name<span class="req">*</span></label>
                        <input type="text" name="fName" id="fName" class="form-control" placeholder="First Name" required value="{{ old('fName', $jobSeeker->fname ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="lName" class="mb-2">Last Name<span class="req">*</span></label>
                        <input type="text" name="lName" id="lName" class="form-control" placeholder="Last Name" required value="{{ old('lName', $jobSeeker->lname ?? '') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="mName" class="mb-2">Middle Name</label>
                        <input type="text" name="mName" id="mName" class="form-control" placeholder="Middle Name" value="{{ old('mName', $jobSeeker->mname ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="dob" class="mb-2">Date of birth<span class="req">*</span></label>
                        <input type="date" name="dob" id="dob" class="form-control" placeholder="date of birth" required value="{{ old('dob' , $jobSeeker->dob ?? '') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="mb-2">Gender<span class="req">*</span></label>
                        <div class="form-check">
                            <input type="radio" name="gender" id="male" class="form-check-input" 
                                    value="male" required
                                    {{ old('gender', $jobSeeker->gender ?? '') == 'male' ? 'checked' : '' }}>
                            <label for="male" class="form-check-label">Male</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="gender" id="female" class="form-check-input" 
                                    value="female" required
                                    {{ old('gender', $jobSeeker->gender ?? '') == 'female' ? 'checked' : '' }}>
                            <label for="female" class="form-check-label">Female</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="gender" id="other" class="form-check-input" 
                                    value="other" required
                                    {{ old('gender', $jobSeeker->gender ?? '') == 'other' ? 'checked' : '' }}>
                            <label for="other" class="form-check-label">Other</label>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="mb-2">Marital Status<span class="req">*</span></label>
                        <div class="form-check">
                            <input type="radio" name="maritalStatus" id="single" class="form-check-input" 
                                    value="single" required
                                    {{ old('maritalStatus', $jobSeeker->marital_status ?? '') == 'single' ? 'checked' : '' }}>
                            <label for="single" class="form-check-label">Single</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="maritalStatus" id="married" class="form-check-input" 
                                    value="married" required
                                    {{ old('maritalStatus', $jobSeeker->marital_status ?? '') == 'married' ? 'checked' : '' }}>
                            <label for="married" class="form-check-label">Married</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="country" class="mb-2">Country<span class="req">*</span></label>
                        <input type="text" name="country" id="country" class="form-control" placeholder="Country" required value="{{ old('country', $jobSeeker->country ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="province" class="mb-2">Province<span class="req">*</span></label>
                        <select name="province" class="form-select">
                            <option value="">Select Province</option>
                            @for ($i = 1; $i <= 7; $i++)
                                <option value="{{ $i }}" {{ isset($jobSeeker) && $jobSeeker->province == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="city" class="mb-2">City<span class="req">*</span></label>
                        <input type="text" name="city" id="city" class="form-control" placeholder="City" required value="{{ old('city', $jobSeeker->city ?? '') }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary w-50">Submit</button>
        </div>
    </form>

    <div class="d-flex justify-content-center">
        <p>Have an account? <a  href="{{route('login')}}">Login</a></p>
    </div>
</section>
</x-header-footer>