<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Domains\Personal\Models\Role;
use Illuminate\Http\Request;
use App\Services\AuthService;
use RuntimeException;
use Exception;

class AuthAPIController extends Controller
{

    //TODO перенести код таски - Тонкий контроллер

    public function login(Request $request) {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            if (!User::where('EMAIL', $request->email)->exists()) {
                return ['status' => 'error', 'message' => 'User with such email not found'];
            }

            $user = AuthService::authenticateUser($request->email, $request->password);
            $token = AuthService::generateUserToken($user);

            return [
                'status' => 'success',
                'user_id' => $user->id,
                'token' => $token,
                'message' => 'User successfully authorized'
            ];
        } catch (Exception $exception) {
            return ['status' => 'error', 'message' => $exception->getMessage()];
        }
    }

    public function logout(Request $request) {
        try {
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
            'user_id' => $request->user_id,
            'message' => 'User is logged out'
        ];

        } catch (Exception $exception) {
            return ['status' => 'error', 'message' => $exception->getMessage()];
        }
    }
    public function register(Request $request) {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required',
                'country' => 'required|string',
                'city' => 'required|string',
                'user_role' => 'required|string',
                'password' => 'required',
            ]);

            $arRequest = $request->all();

            $arRequest['role_id'] = Role::where('name', $arRequest['user_role'])->firstOrFail()->id;
            unset($arRequest['user_role']);
            $arRequest['password'] = bcrypt($arRequest['password']);

            if (User::where('email', $arRequest['email'])->exists()) {
                throw new RuntimeException('User witch such email already exists');
            }

            $newUser = User::create($arRequest);

            return [
                'status' => 'success',
                'message' => 'User successfully registered',
                'new_user' => $newUser
            ];

        } catch (Exception $exception) {
            return ['status' => 'error', 'message' => $exception->getMessage()];
        }
    }

}
