<?php

namespace App\Domains\Companies\Http\Requests;

use App\Http\Requests\BaseRequest;

class UpdatePersonalInfoRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'employee_cnt' => 'required|integer',
            'web_site' => 'required|string',
            'description' => 'required|string',
            'name' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'phone' =>  'required|string',
        ];
    }
}
