<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;


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
use RuntimeException;
use Illuminate\Support\Facades\Validator;

class AuthAPIController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = AuthService::authenticateUser($request->email, $request->password);
        $token = AuthService::generateUserToken($user);
        list($id, $value) = explode('|', $token);
        return [
            'status' => 'success',
            'token' => $value
        ];
    }

    public function logout(Request $request) {
        $request->validate([
            'user_id' => 'required|integer',
        ]);

        $user = User::find($request->user_id);
        if (!$user) throw new RuntimeException('User not found');
        if (!AuthService::isUserAuthorised($user)) throw new RuntimeException('User isn`t authorised');

        AuthService::logOutCurrentUser();
        AuthService::deleteUserTokens($user);
        return [
            'status' => 'success',
            'message' => 'User is logged out'
        ];
    }




}
