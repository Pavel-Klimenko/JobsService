<?php declare(strict_types = 1);

namespace App\Domains\Chat\Http\Controllers;

use App\Domains\Chat\Models\Chat;
use App\Domains\Chat\Models\Message;
use App\Events\MessageSent;
use App\Helper;
use App\Http\Controllers\Controller;
use App\Domains\Chat\Http\Requests\CreateChatRequest;
use App\Domains\Chat\Http\Requests\MessageFormRequest;
use App\Domains\Chat\Http\Requests\ChatMessagesRequest;
use App\Services\ChatService;

class ChatController extends Controller
{
    private $chatService;

    public function __construct(
        ChatService $chatService,
    ){
        $this->chatService = $chatService;
    }

    public function messages(ChatMessagesRequest $request)
    {
        try {
            $chat = Chat::findOrFail($request->chat_id);

            if (!$this->chatService->isUserChatMember($chat, $request->user())) {
                throw new \RuntimeException('Current user is not a chat member');
            }

            return Helper::successResponse(['messages' => $chat->messages], 'Chat messages');
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function createChat(CreateChatRequest $request)
    {
        try {
            $currentCompany = $request->user()->company;
            $newChat = Chat::create([
                'candidate_id' => $request->candidate_id,
                'company_id' => $currentCompany->id,
            ]);

            return Helper::successResponse([
                'created_chat' => $newChat,
            ], 'New chat created');

        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function sendMessage(MessageFormRequest $request)
    {
        try {
              $chat = Chat::findOrFail($request->chat_id);
              $currentUserId = $request->user()->id;

              $arChatMembers = [$chat->company->user->id, $chat->candidate->user->id];
              if (!in_array($currentUserId, $arChatMembers)) {
                  throw new \RuntimeException('Current user is not a chat member');
              }

              $newMessage = Message::create([
                  'chat_id' => $chat->id,
                  'user_id' => $currentUserId,
                  'message' => $request->message,
              ]);

            broadcast(new MessageSent($request->user(), $newMessage));

            return Helper::successResponse([
                'user_id' => $request->user()->id,
                'new_message' => $newMessage
            ], 'Message has already sent');

        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

}
