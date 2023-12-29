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

class getCompanyVacancies
{
    public function run($request) {
//        if (Helper::isAdmin()) {
//            return redirect()->route('admin-main');
//        }
        $user = User::find($request->user_id);

        if ($user->role_id != Constants::USER_ROLES_IDS['company']) return 'Error: user is not a company';

        $result['title'] = 'Company vacancies';
        $result['vacancies'] = $user->vacancies()->where('ACTIVE', 1)->paginate(4)->withQueryString();
        $result['jobCategories'] = JobCategories::all();
        return $result;

        //return view('personal.vacancies', compact('vacancies', 'jobCategories', 'title'));
    }
}
