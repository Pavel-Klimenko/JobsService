<?php

declare(strict_types = 1);

namespace App\Services;

use App\Domains\Chat\Models\Chat;
use App\User;

class ChatService
{
    public function isUserChatMember(Chat $chat, User $user):bool
    {
        $arChatMembers = [$chat->candidate->user->id, $chat->company->user->id];
        return in_array($user->id, $arChatMembers);
    }
}
