<?php

namespace App\Domains\Chat\Http\Requests;

use App\Http\Requests\BaseRequest;

class MessageFormRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'message' => 'required|string',
        ];
    }
}
