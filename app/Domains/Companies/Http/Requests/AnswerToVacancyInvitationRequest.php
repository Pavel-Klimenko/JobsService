<?php

namespace App\Domains\Companies\Http\Requests;

use App\Http\Requests\BaseRequest;

class AnswerToVacancyInvitationRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'vacancy_request_id' => 'required|integer',
            'answer_status_id' => 'required|integer',
        ];
    }
}
