<h2>{{$title}}</h2>

<div>
    <p><b>Company:</b> {{$company_name}}</p>
    <p><b>Vacancy:</b> {{$vacancy_title}}</p>

{{--    <h3>Answer from company:</h3>--}}

{{--    @if($answer_status == 'accepted')--}}
{{--        <div>--}}
{{--            You have been invited for an interview! If you interested our offer please contact with us:--}}
{{--            <ul>--}}
{{--                <li><b>Email:</b> {{$company_email}}</li>--}}
{{--                @if($company_phone)--}}
{{--                    <li><b>Phone:</b> {{$company_phone}}</li>--}}
{{--                @endif()--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    @elseif($answer_status == 'rejected')--}}
{{--        <div>Unfortunately company can't invite you to the interview.</div>--}}
{{--    @endif()--}}

</div>

