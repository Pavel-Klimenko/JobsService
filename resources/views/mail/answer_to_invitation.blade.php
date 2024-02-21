<h2>{{$title}}</h2>

<div>
    <p><b>Company:</b> {{$company->NAME}}</p>
    <p><b>Vacancy:</b> {{$vacancy->NAME}}</p>

    <h3>Answer from company:</h3>


    @if($status == 'accepted')
        <div>
            You have been invited for an interview! If you interested our offer please contact with us:
            <ul>
                <li><b>Email:</b> {{$company->EMAIL}}</li>
                @if($company->PHONE)
                    <li><b>Phone:</b> {{$company->PHONE}}</li>
                @endif()
            </ul>
        </div>
    @elseif($status == 'rejected')
        <div>Unfortunately company can't invite you to the interview.</div>
    @endif()
</div>

