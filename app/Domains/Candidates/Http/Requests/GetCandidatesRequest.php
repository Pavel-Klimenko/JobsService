<?php

namespace App\Domains\Candidates\Http\Requests;

use App\Http\Requests\BaseRequest;

class GetCandidatesRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'job_category_id' => 'integer|exists:job_categories,id',
            'level_id' => 'integer|exists:candidate_levels,id',
        ];
    }
}
