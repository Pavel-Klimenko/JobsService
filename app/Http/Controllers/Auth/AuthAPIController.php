<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
        $validator = Validator::make($request->all(), ['email' => 'required|email', 'password' => 'required']);

        $result = [];
        if ($validator->fails()) {
            $result = ['status' => 'error', 'message' => 'Invalid email or password'];
        } else {
            if (Auth::check()) AuthService::logOutCurrentUser();
            $user = AuthService::authenticateUser($request->email, $request->password);
            $token = AuthService::generateUserToken($user);
            list($id, $value) = explode('|', $token);
            $result = ['status' => 'success', 'token' => $value];
        }

        return $result;
    }

    public function logout() {
        $result = [];
        if (Auth::check()) {
            $user = AuthService::logOutCurrentUser();
            AuthService::deleteUserTokens($user);
            $result = ['status' => 'success', 'message' => 'User is logged out. Persona token deleted'];
        } else {
            $result = ['status' => 'error', 'message' => 'User isn`t logged'];
        }

        return $result;
    }




}
