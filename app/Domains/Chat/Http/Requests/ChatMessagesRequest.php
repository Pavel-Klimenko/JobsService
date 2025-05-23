<?php

namespace App\Domains\Chat\Http\Requests;

use App\Http\Requests\BaseRequest;

class ChatMessagesRequest extends BaseRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'chat_id' => 'required|exists:chats,id',
        ];
    }
}
