<h2>{{$title}}</h2>

<div>
    <p><b>Vacancy:</b> {{$vacancy_title}}</p>

    <h3>Candidate`s info</h3>

    <p><b>Name:</b> {{$candidate_name}}</p>
    <p><b>City:</b> {{$candidate_city}}</p>
    <p><b>Level:</b> {{$candidate_level}}</p>
    <p><b>Years experience:</b> {{$candidate_years_experience}}</p>

    @if($covering_letter)
        <h3>Сovering letter:</h3>
        {{$covering_letter}}
    @endif
</div>

