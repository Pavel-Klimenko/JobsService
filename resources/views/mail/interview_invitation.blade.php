<h2>{{$title}}</h2>

<div>

    <p><b>Vacancy:</b> {{$vacancy->NAME}}</p>

    @if($covering_letter)
        <h3>Сovering letter:</h3>
        {{$covering_letter}}
    @endif
</div>
