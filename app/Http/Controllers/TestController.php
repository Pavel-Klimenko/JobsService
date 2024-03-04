<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 02/12/23
 * Time: 22:40
 */

namespace App\Http\Controllers;

use App\Domains\Candidates\Models\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserNotification;
use Laravel\Sanctum\HasApiTokens;
use Mailgun\Mailgun;

use App\Services\RabbitMQService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Constants;
use App\Services\AuthService;


class TestController extends Controller
{
    use HasApiTokens, Notifiable;

    public function test()
    {

        //TODO сделать методы для создания и хранения токенов!

        $email = 'Pavel@test.com';
        $password = 'almaz';


//
//        Auth::logout();

//        Auth::login($user);
//
//        dd(Auth::check());


//        AuthService::deleteUserTokens($user);
//
//
//        exit();





//        AuthService::authenticateUser($email, $password);
//        if (Auth::check()) {
//            $token = AuthService::generateUserToken(Auth::user());
//        }


        AuthService::logOutCurrentUser();


        dd(Auth::check());



        if (AuthService::authenticateUser($email, $password)) {
            if (Auth::check()) {
                // The user is logged in...

                $token = AuthService::generateUserToken(Auth::user());
                //dd($token);


                //TODO метод удаления токена и логаут сделать!
            }
        }

        exit();

        if (Auth::attempt([
            'email' => $email,
            'password' => $password,
        ])) {
            dump('Authentication was successful');
            // Authentication was successful...







        } else {
            dd('Authentication was failed');
        }


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
