<div style="font-family: Arial, sans-serif; padding: 20px;">
    @if(!empty($profile_pic))
        <img src="{{ asset('images/avatar7.png') }}" alt="Profile Picture" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
    @endif
    <h1>{{ $name }}</h1>
    <p><strong>Email:</strong> {{ $email }} | <strong>Phone:</strong> {{ $phone }} | <strong>Location:</strong> {{ $location }}</p>
    @if(!empty($linkedin))<p><strong>LinkedIn:</strong> {{ $linkedin }}</p>@endif
    <hr>
    <h3>Summary</h3>
    <p>{{ $summary }}</p>
    <h3>Experience</h3>
    <ul>
        @foreach($experience as $exp)
            <li><strong>{{ $exp['position'] }}</strong> at {{ $exp['company'] }} ({{ $exp['years'] }})</li>
        @endforeach
    </ul>
    <h3>Education</h3>
    <ul>
        @foreach($education as $edu)
            <li>{{ $edu['degree'] }} - {{ $edu['institution'] }} ({{ $edu['year'] }})</li>
        @endforeach
    </ul>
    <h3>Skills</h3>
    <p>{{ implode(', ', $skills) }}</p>
</div>