<?php

namespace App\Http\Controllers\Auth;

use App\Domains\Candidates\Models\Candidate;
use App\Domains\Personal\Models\Company;
use App\Domains\Vacancies\Models\Vacancies;
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
                'role_id' => 'required|integer',
                'password' => 'required',
            ]);

            $arRequest = $request->all();

            $userRole = Helper::checkElementExistense(Role::class, $request->role_id);

            $arRequest['password'] = bcrypt($arRequest['password']);
            if (User::where('email', $arRequest['email'])->exists()) {
                throw new RuntimeException('User witch such email already exists');
            }

            $relatedEntityName = $userRole->name;

            //TODO внедрить DTO Spatie
            if ($newUser = User::create($arRequest)) {
                if ($relatedEntityName == 'candidate') {
                    $relatedEntity = Candidate::create(['user_id' => $newUser->id]);
                } else if ($relatedEntityName == 'company') {
                    $relatedEntity = Company::create(['user_id' => $newUser->id]);
                }
            }

            return [
                'status' => 'success',
                'message' => 'User successfully registered',
                'created_user' => $newUser,
                'related_entity' => [
                    'name' => $relatedEntityName,
                    'data' => $relatedEntity
                ],
            ];
        } catch (Exception $exception) {
            return ['status' => 'error', 'message' => $exception->getMessage()];
        }
    }

}
