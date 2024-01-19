<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14/05/23
 * Time: 23:58
 */

namespace App\Domains\Personal\Actions;

use App\Constants;
use App\Domains\Candidates\Models\JobCategories;
use App\Domains\Candidates\Models\User;
use RuntimeException;

class getCompanyVacancies
{
    public function run($id) {
//        if (Helper::isAdmin()) {
//            return redirect()->route('admin-main');
//        }
        $company = User::find($id);
        if ($company->role_id != Constants::USER_ROLES_IDS['company']) {
            throw new RuntimeException('Error: user is not a company');
        }

        $result['title'] = 'Company vacancies';
        $result['vacancies'] = $company->vacancies()->where('ACTIVE', 1)->paginate(4)->withQueryString();
        $result['jobCategories'] = JobCategories::all();
        return $result;
    }
}
