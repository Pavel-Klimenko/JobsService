<?php

namespace App\Domains\Companies\Http\Requests;

use App\Http\Requests\BaseRequest;

class CreateVacancyRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title' => 'required|string',
            'job_category_id' => 'required|integer',
            'salary_from' => 'required|numeric',
            'description' => 'required|string',
        ];
    }
}
