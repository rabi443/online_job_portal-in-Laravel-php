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
                    <h3 class="fs-4 mb-1">Employer Registration Form</h3><hr>
                    <input type="hidden" name="role" value="employer" class="form-control">
                    
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
                            <label for="companyName" class="mb-2">Company Name<span class="req">*</span></label>
                            <input type="text" name="companyName" id="companyName" class="form-control" placeholder="Company Name" required value="{{ old('companyName', $employer->company_name ?? '') }}">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="country" class="mb-2">Country<span class="req">*</span></label>
                            <input type="text" name="country" id="country" class="form-control" placeholder="Country" required value="{{ old('country', $employer->country ?? '') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="province" class="mb-2">Province<span class="req">*</span></label>
                            <select name="province" class="form-select">
                                <option value="">Select Province</option>
                                @for ($i = 1; $i <= 7; $i++)
                                    <option value="{{ $i }}" {{ isset($employer) && $employer->province == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="city" class="mb-2">City<span class="req">*</span></label>
                            <input type="text" name="city" id="city" class="form-control" placeholder="City" required value="{{ old('city', $employer->city ?? '') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="organizationType" class="mb-2">Organization Type<span class="req">*</span></label>
                            <input type="text" name="organizationType" id="organizationType" class="form-control" placeholder="Organization Type" required value="{{ old('organizationType', $employer->organization_type ?? '') }}">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="website" class="mb-2">Website</label>
                            <input type="url" class="form-control" id="website" name="website" value="{{ old('website', $employer->website ?? '') }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="aboutCompany" class="mb-2">About Company</label>
                        <input type="text" placeholder="About company" id="aboutCompany" name="aboutCompany" class="form-control" value="{{ old('aboutCompany', $employer->about_company ?? '') }}">
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