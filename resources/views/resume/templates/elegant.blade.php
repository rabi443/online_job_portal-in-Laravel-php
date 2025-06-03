<div style="font-family: 'Georgia', serif; padding: 40px; color: #222;">
    @if(!empty($profile_pic))
        <img src="{{ public_path('storage/' . $profile_pic) }}" alt="Profile Picture" style="width: 120px; height: 120px; border-radius: 50%; float: right;">
    @endif
    <h1 style="border-bottom: 1px solid #999;">{{ $name }}</h1>
    <p>{{ $email }} | {{ $phone }} | {{ $location }}</p>
    @if(!empty($linkedin))<p>{{ $linkedin }}</p>@endif
    <h2>Summary</h2>
    <p>{{ $summary }}</p>
    <h2>Experience</h2>
    @foreach($experience as $exp)
        <p><strong>{{ $exp['position'] }}</strong> - {{ $exp['company'] }} <em>({{ $exp['years'] }})</em></p>
    @endforeach
    <h2>Education</h2>
    @foreach($education as $edu)
        <p>{{ $edu['degree'] }} from {{ $edu['institution'] }} ({{ $edu['year'] }})</p>
    @endforeach
    <h2>Skills</h2>
    <p>{{ implode(', ', $skills) }}</p>
</div>