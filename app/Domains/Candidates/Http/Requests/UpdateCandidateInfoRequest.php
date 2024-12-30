<?php

namespace App\Domains\Candidates\Http\Requests;

use App\Http\Requests\BaseRequest;

class UpdateCandidateInfoRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'phone' =>  'required|string',

            'job_category_id' =>  'required|integer',
            'level_id' =>  'required|integer',
            'years_experience' =>  'required|integer',
            'salary' =>  'required|numeric',
            'experience' =>  'required|string',
            'education' =>  'required|string',
            'about_me' =>  'required|string',
        ];
    }
}
