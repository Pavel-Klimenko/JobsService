<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class RegisterNewUserRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'country' => 'required|string',
            'city' => 'required|string',
            'role_id' => 'required|integer',
            'password' => 'required',
        ];
    }
}
