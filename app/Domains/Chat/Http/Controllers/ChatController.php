<?php declare(strict_types = 1);

namespace App\Domains\Chat\Http\Controllers;

use App\Events\MessageSent;
use App\Helper;
use App\Http\Controllers\Controller;
use App\Domains\Chat\Http\Requests\MessageFormRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request)
    {

        dd($request->user()->id);
        //TODO авторизация пользователя! через Request

        //auth()->loginUsingId(1);
        //return view('chat');

        dd('chat');
    }

    public function messages()
    {
        try {
            $chatMessages = \App\Domains\Chat\Models\Message::all();
            return Helper::successResponse(['messages' => $chatMessages], 'Chat messages');
        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

    public function send(MessageFormRequest $request)
    {
        try {
            $message = $request->user()
                ->messages()
                ->create($request->validated());

            broadcast(new MessageSent($request->user(), $message));

            return Helper::successResponse([
                'user_id' => $request->user()->id,
                'message' => $message
            ], 'Message has already sent');

        } catch(\Exception $exception) {
            return Helper::failedResponse($exception->getMessage());
        }
    }

}
