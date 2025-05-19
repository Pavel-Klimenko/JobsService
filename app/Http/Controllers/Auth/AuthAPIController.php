<?php

namespace App\Http\Controllers\Auth;

use App\Domains\Candidates\Models\Candidate;
use App\Domains\Personal\Models\Company;
use App\Http\Requests\RegisterNewUserRequest;
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
    public function login(Request $request) {
        try {
            $request->validate([
                'email' => 'required|email|exists:users,email',
                'password' => 'required|string'
            ]);


            $user = AuthService::authenticateUser($request->email, $request->password);
            $token = AuthService::generateUserToken($user);
            $userRoleName = $user->role->name;

            $arResponse = [
                'user_id' => $user->id,
                'token' => $token,
                'role_name' => $userRoleName,
            ];

            if ($userRoleName == 'company') {
                $arResponse['related_entity_id'] = (isset($user->company->id)) ? $user->company->id : '';
            } else if ($userRoleName == 'candidate') {
                $arResponse['related_entity_id'] = (isset($user->candidate->id)) ? $user->candidate->id : '';
            }

            return Helper::successResponse($arResponse, 'User successfully authorized');

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
            ], 'User is logged out');

        } catch (Exception $exception) {
            return Helper::failedResponse(
                $exception->getMessage(),
                $exception->getTrace()
            );
        }
    }

    public function register(RegisterNewUserRequest $request) {
        try {
            $arRequest = $request->all();
            $userRole = Helper::checkElementExistense(Role::class, $request->role_id);

            $arRequest['password'] = bcrypt($arRequest['password']);
            if (User::where('email', $arRequest['email'])->exists()) {
                throw new RuntimeException('User witch such email already exists');
            }

            $relatedEntityName = $userRole->name;

            if ($newUser = User::create($arRequest)) {
                if ($relatedEntityName == 'candidate') {
                    $relatedEntity = Candidate::create(['user_id' => $newUser->id]);
                } else if ($relatedEntityName == 'company') {
                    $relatedEntity = Company::create(['user_id' => $newUser->id]);
                }
            }
            return Helper::successResponse([
                'created_user' => $newUser,
                'related_entity' => [
                    'name' => $relatedEntityName,
                    'data' => $relatedEntity
                ],
            ], 'User successfully registered');

        } catch (Exception $exception) {
            return ['status' => 'error', 'message' => $exception->getMessage()];
        }
    }
}
