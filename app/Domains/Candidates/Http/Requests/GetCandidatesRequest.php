<?php

namespace App\Domains\Candidates\Http\Requests;

use App\Http\Requests\BaseRequest;

class GetCandidatesRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'job_category_id' => 'integer',
            'level_id' => 'integer',
        ];
    }
}
