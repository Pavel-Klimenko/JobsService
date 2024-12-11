<?php

namespace App\Domains\Vacancies\Http\Requests;

use App\Http\Requests\BaseRequest;

class GetVacanciesRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'job_category_id' => 'integer',
            'salary_from' => 'numeric',
        ];
    }
}
