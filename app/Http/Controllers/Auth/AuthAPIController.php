<?php

namespace App\Http\Controllers\Auth;

use App\Helper;
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

            if (!User::where('email', $request->email)->exists()) {
                return ['status' => 'error', 'message' => 'User with such email not found'];
            }

            $user = AuthService::authenticateUser($request->email, $request->password);

            $token = AuthService::generateUserToken($user);
            $userRoleName = $user->role->name;

            if ($userRoleName == 'company') {
                $userRelatedEntityId = $user->company->id;
            } else if ($userRoleName == 'candidate') {
                $userRelatedEntityId = $user->candidate->id;
            }

            return Helper::successResponse([
                'status' => 'success',
                'user_id' => $user->id,
                'token' => $token,
                'role_name' => $userRoleName,
                'related_entity_id' => $userRelatedEntityId,
                'message' => 'User successfully authorized'
            ], 'Created new vacancy');

        } catch (Exception $exception) {
            return Helper::failedResponse(
                $exception->getMessage(),
                $exception->getTrace()
            );
        }
    }

    public function logout(Request $request) {
        try {
            $user = $request->user();
            AuthService::deleteUserTokens($user);

            return Helper::successResponse([
                'status' => 'success',
                'user_id' => $user->id,
                'message' => 'User is logged out'
            ], 'Created new vacancy');

        } catch (Exception $exception) {
            return Helper::failedResponse(
                $exception->getMessage(),
                $exception->getTrace()
            );
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
