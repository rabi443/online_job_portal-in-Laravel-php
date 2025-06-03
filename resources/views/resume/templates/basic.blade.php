<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Resume - {{ $resume->resume}}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #000;
            padding: 4px;
        }
        h1, h4, h6 {
            margin: 0;
        }
        .header, .section {
            margin-bottom: 20px;
        }
        .section h6 {
            text-decoration: underline;
            margin-bottom: 5px;
        }
        .profile-pic {
            float: right;
            width: 120px;
            height: 140px;
            object-fit: cover;
            border: 1px solid #000;
        }
    </style>
</head>
<body>

    <div class="header" style=" background-color: #f8f9fa; padding: 20px; border-radius: 5px;">
        <div style="text-align: center; margin-bottom: 20px;">
            <h2 style="text-decoration: underline; display: inline-block;">Resume</h2>
        </div>
        @if(!empty($resume->profile_pic))
            <img src="{{ public_path('storage/' . $resume->profile_pic) }}" class="profile-pic" alt="Profile Picture">
        @endif

        <h1 style="font-size: 22px; text-transform: uppercase;">{{ strtoupper($resume->name) }}</h1>
        <p><strong>Address:</strong> {{ $resume->location }}</p>
        <p><strong>Phone:</strong> {{ $resume->phone }}</p>
        <p><strong>Email:</strong> {{ $resume->email }}</p>
        @if(!empty($resume->linkedin))
            <p><strong>LinkedIn:</strong> {{ $resume->linkedin }}</p>
        @endif
    </div><hr>

    <div style=" background-color: #f8f9fa; padding: 20px; border-radius: 5px;">
    <div class="section">
        <h3><u>DESCRIPTION</u></h3>
        <p>{{ $resume->summary }}</p>
    </div>

    <div class="section">
        <h3><u>WORK EXPERIENCE</u></h3>
        
        @foreach($resume->experience as $exp)
                <strong>{{ $exp['position'] }}</strong> at {{ $exp['company'] }} , since ({{ $exp['years'] }}) <br>
        @endforeach
        
    </div>

    <div class="section">
        <h3><u>EDUCATIONAL ATTAINMENT</u></h3>
        
        @foreach($resume->education as $edu)
            
            <strong>{{ $edu['degree'] }}</strong> at {{ $edu['institution'] }} ({{ $edu['year'] }})
            
        @endforeach
        
    </div>

    <div class="section">
        <h3><u>SKILLS</u></h3>
        @if(is_array($resume->skills) && count($resume->skills) > 0)
            <p>{{ implode(', ', $resume->skills) }}</p>
        @else
            <p>No skills listed.</p>
        @endif
    </div>
    </div>

</body>
</html>
