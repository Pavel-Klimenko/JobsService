<?php

namespace App\Domains\Chat\Http\Requests;

use App\Http\Requests\BaseRequest;

class CreateChatRequest extends BaseRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'candidate_id' => 'required|exists:candidates,id',
        ];
    }
}
