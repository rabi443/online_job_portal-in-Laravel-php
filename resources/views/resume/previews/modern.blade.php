<div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; padding: 30px; color: #333;">
    @if(!empty($profile_pic))
        <img src="{{ public_path('storage/' . $profile_pic) }}" alt="Profile Picture" style="float: right; width: 100px; height: 100px; object-fit: cover; border-radius: 10px;">
    @endif
    <h1 style="border-bottom: 2px solid #ccc;">{{ $name }}</h1>
    <p>{{ $email }} | {{ $phone }} | {{ $location }}</p>
    @if(!empty($linkedin))<p>{{ $linkedin }}</p>@endif
    <section>
        <h2>Professional Summary</h2>
        <p>{{ $summary }}</p>
    </section>
    <section>
        <h2>Experience</h2>
        @foreach($experience as $exp)
            <p><strong>{{ $exp['position'] }}</strong> at {{ $exp['company'] }} ({{ $exp['years'] }})</p>
        @endforeach
    </section>
    <section>
        <h2>Education</h2>
        @foreach($education as $edu)
            <p>{{ $edu['degree'] }}, {{ $edu['institution'] }} ({{ $edu['year'] }})</p>
        @endforeach
    </section>
    <section>
        <h2>Skills</h2>
        <p>{{ implode(', ', $skills) }}</p>
    </section>
</div>