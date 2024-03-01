<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 02/12/23
 * Time: 22:40
 */

namespace App\Http\Controllers;

use App\Domains\Candidates\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserNotification;
use Mailgun\Mailgun;

use App\Services\RabbitMQService;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function test()
    {

        //TODO сделать методы для создания и хранения токенов!


        //создание токена passport
//        $userId = 2;
//        $user = User::find($userId);
//        $token = $user->createToken(sprintf("%s-%s", $user->EMAIL, now()), ['candidate'])->accessToken;
//        dd($token);


        //создание токена sanctum

        //Candidate

//        $userId = 2;
//        $user = User::find($userId);
//        $token = $user->createToken('token-name', ['candidate_rules'])->plainTextToken;
//        dd($token);

        //Company

//        $userId = 7;
//        $user = User::find($userId);
//        $token = $user->createToken('token-name', ['company_rules'])->plainTextToken;
//        dd($token);



    }
}
