<?php

namespace App\Domains\Chat\Http\Requests;

use App\Http\Requests\BaseRequest;

class MessageFormRequest extends BaseRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'message' => 'required|string',
        ];
    }
}
