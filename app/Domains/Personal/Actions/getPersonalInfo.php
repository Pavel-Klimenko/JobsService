<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14/05/23
 * Time: 23:58
 */

namespace App\Domains\Personal\Actions;

use App\Helper;
use App\Constants;
use App\Domains\Candidates\Models\JobCategories;
use App\Domains\Candidates\Models\Candidates;

class getPersonalInfo
{
    public function run($id) {
        $user = Candidates::find($id);

        $result = [];
        $result['title'] = 'Personal info';
        $result['user_id'] = $id;
        $result['user_role_id'] = $user->role_id;

        if ($user->role_id == Constants::USER_ROLES_IDS['admin']) {
            $result['user_role'] = 'admin';
        } elseif ($user->role_id == Constants::USER_ROLES_IDS['company']) {
            $result['user_role'] = 'company';
        } elseif ($user->role_id == Constants::USER_ROLES_IDS['candidate']) {
            $result['category'] = Helper::getTableRow(JobCategories::class, 'ID', $id);
            $result['jobCategories'] = JobCategories::all();
        }

        return $result;
    }
}
