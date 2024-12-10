<?php

namespace App\Domains\Companies\Http\Requests;

use App\Http\Requests\BaseRequest;

class UpdateVacancyRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'vacancy_id' => 'required|integer',
            'title' => 'required|string',
            'job_category_id' => 'required|integer',
            'salary_from' => 'required|numeric',
            'description' => 'required|string',
        ];
    }
}
