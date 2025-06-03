<div style="font-family: 'Courier New', Courier, monospace; padding: 25px; background: #f9f9f9;">
    @if(!empty($profile_pic))
        <img src="{{ public_path('storage/' . $profile_pic) }}" alt="Profile Picture" style="width: 90px; height: 90px; float: left; margin-right: 20px; border-radius: 50%;">
    @endif
    <h1>{{ $name }}</h1>
    <p>{{ $email }} | {{ $phone }} | {{ $location }}</p>
    @if(!empty($linkedin))<p>{{ $linkedin }}</p>@endif
    <hr>
    <h3>About Me</h3>
    <p>{{ $summary }}</p>
    <h3>Career History</h3>
    <ul>
        @foreach($experience as $exp)
            <li>{{ $exp['position'] }} - {{ $exp['company'] }} ({{ $exp['years'] }})</li>
        @endforeach
    </ul>
    <h3>Academic</h3>
    <ul>
        @foreach($education as $edu)
            <li>{{ $edu['degree'] }} at {{ $edu['institution'] }} ({{ $edu['year'] }})</li>
        @endforeach
    </ul>
    <h3>Skills</h3>
    <p>{{ implode(', ', $skills) }}</p>
</div>