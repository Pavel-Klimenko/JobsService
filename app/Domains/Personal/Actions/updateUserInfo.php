<?php

namespace App\Domains\Personal\Actions;


use App\Helper;
use App\Domains\Candidates\Models\User;
use RuntimeException;
use App\Constants;

class updateUserInfo
{
    public function run($request) {
        try {
            if (!$request->user_id) throw new RuntimeException('User`id not sent');
            $user = User::find($request->user_id);

            if ($user->role_id == Constants::USER_ROLES_IDS['candidate']) {
                $arrUserFields = User::getCompanyFields();
            } elseif ($user->role_id == Constants::USER_ROLES_IDS['company']) {
                $arrUserFields = User::getCandidateFields();
            }

            foreach ($arrUserFields as $field) {
                if ($field == 'user_id') continue;
                $user->$field = $request->$field;
            }

            $user->ACTIVE = 1;
            return $user->save();

        } catch(\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
