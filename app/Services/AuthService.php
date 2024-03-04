<?php
namespace App\Services;

use App\Constants;
use App\User;
use App\Http\Middleware\Authenticate;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use RuntimeException;
use Exception;

use Laravel\Sanctum\PersonalAccessToken;

class AuthService
{
    use HasApiTokens, Notifiable;

    public static function authenticateUser(string $email, string $password)
    {
        try {
            $user = User::where('EMAIL', $email)->first();
            if (!Hash::check($password, $user->password)) throw new RuntimeException('Incorrect user`s password');
            Auth::login($user, true);
            Auth::attempt(['email' => $email, 'password' => $password]);
            return $user;
        } catch (Exception $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }

    public static function generateUserToken(\App\User $user):string
    {
        try {
            $userRole = Constants::USER_ROLE_NAMES[$user->role_id];
            return $user->createToken(sprintf("%s-%s", $user->id, now(), [$userRole]), [$userRole.'_rules'])->plainTextToken;
        } catch (Exception $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }


    public static function logOutCurrentUser() {
        try {
            $user = Auth::user();
            Auth::logout();
            return $user;
        } catch (Exception $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }

    public static function deleteUserTokens(\App\User $user) {
        try {
            return $user->tokens()->where('tokenable_id', $user->id)->delete();
        } catch (Exception $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }

}
