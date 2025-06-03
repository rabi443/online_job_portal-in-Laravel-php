
    <style>
        .resume {
            font-family: Arial, sans-serif;
            padding: 40px;
            max-width: 800px;
            margin: auto;
            background: white;
            color: black;
        }

        .resume h1 {
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .resume h2 {
            font-size: 18px;
            margin-top: 30px;
            text-decoration: underline;
        }

        .resume .section {
            margin-top: 20px;
        }

        .resume .info-table td {
            padding: 4px 10px;
            vertical-align: top;
        }

        .resume .photo {
            float: right;
            width: 130px;
            height: 160px;
            border: 1px solid #000;
            object-fit: cover;
        }
    </style>

    <div class="resume bg-white shadow border rounded p-4">
        <!-- Header -->
        <div class="clearfix">
            <div class="row">
                <div class="col-8">
                    <h1>{{ $name }}</h1>
                    <p>
                        <strong>Address:</strong>{{ $location }}<br>
                        <strong>Mobile Number:</strong>{{ $phone }}<br>
                        <strong>Email address:</strong> <a href="mailto:{{ $email }}">{{ $email }}</a>
                        @if(!empty($linkedin))<p><strong>LinkedIn:</strong> {{ $linkedin }}</p>@endif
                    </p>
                </div>
                <div class="col-4">
                    <img src="{{ asset('images/avatar7.png') }}" alt="Profile Photo" class="photo">
                    {{-- @if(!empty($profile_pic))
                        <img src="{{ public_path('storage/' . $profile_pic) }}" alt="Profile photo" class="photo">
                    @endif --}}
                </div>
            </div>
        </div>

        <!-- Career Objective -->
        <h2>CARRER OBJECTIVE</h2>
        <p>{{ $summary }}</p>

        <!-- Education -->
        <h2>EDUCATIONAL ATTAINMENT</h2>
        @foreach($education as $edu)
            <li>{{ $edu['degree'] }} - {{ $edu['institution'] }} ({{ $edu['year'] }})</li>
        @endforeach

        <!-- Work Experience -->
        <h2>WORK EXPERIENCE:</h2>
        @foreach($experience as $exp)
            <li><strong>{{ $exp['position'] }}</strong> at {{ $exp['company'] }} ({{ $exp['years'] }})</li>
        @endforeach

         <!-- Skills -->
        <h2>SKILLS:</h2>
        @if(is_array($skills) && count($skills) > 0)
            <p>{{ implode(', ', $skills) }}</p>
        @else
            <p>No skills listed.</p>
        @endif
    </div>

