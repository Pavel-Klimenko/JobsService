<?php

namespace App\Domains\Candidates\Http\Requests;

use App\Http\Requests\BaseRequest;

class createVacancyInvitationRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'vacancy_id' => 'required|integer',
            'candidate_covering_letter' => 'string',
        ];
    }
}
