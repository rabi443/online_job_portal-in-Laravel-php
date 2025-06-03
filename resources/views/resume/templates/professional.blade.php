<div style="font-family: 'Roboto', sans-serif; padding: 20px; border: 1px solid #ccc;">
    @if(!empty($profile_pic))
        <img src="{{ public_path('storage/' . $profile_pic) }}" alt="Profile Picture" style="width: 100px; height: 100px; border-radius: 5px; float: right;">
    @endif
    <h1>{{ $name }}</h1>
    <p><strong>Email:</strong> {{ $email }} | <strong>Phone:</strong> {{ $phone }} | <strong>Location:</strong> {{ $location }}</p>
    @if(!empty($linkedin))<p><strong>LinkedIn:</strong> {{ $linkedin }}</p>@endif
    <h2>Summary</h2>
    <p>{{ $summary }}</p>
    <h2>Work Experience</h2>
    @foreach($experience as $exp)
        <p><strong>{{ $exp['position'] }}</strong>, {{ $exp['company'] }} - {{ $exp['years'] }}</p>
    @endforeach
    <h2>Education</h2>
    @foreach($education as $edu)
        <p>{{ $edu['degree'] }} - {{ $edu['institution'] }} ({{ $edu['year'] }})</p>
    @endforeach
    <h2>Skills</h2>
    <p>{{ implode(', ', $skills) }}</p>
</div>
