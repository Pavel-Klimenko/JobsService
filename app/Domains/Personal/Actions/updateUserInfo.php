<?php

namespace App\Domains\Personal\Actions;


use App\Helper;
use App\Domains\Candidates\Models\User;

use App\Constants;

class updateUserInfo
{
    public function run($request) {
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
        $user->save();

//        //sending notification to admin
/*        $date = (object) [
            'entity' => 'user',
            'message' =>  'User updated personal info',
            'entity_id' => $user->id,
        ];*/

        //return $date;
    }
}
