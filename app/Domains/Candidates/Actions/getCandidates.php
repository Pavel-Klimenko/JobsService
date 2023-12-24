<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14/05/23
 * Time: 23:58
 */

namespace App\Domains\Candidates\Actions;

use App\Helper;
use App\Constants;
use App\Domains\Candidates\Models\JobCategories;
use App\Domains\Candidates\Models\User;

class getCandidates
{
    public function run($request) {
        $arrRequest = $request->all();


        $candidates = User::where([
            ['role_id', Constants::USER_ROLES_IDS['candidate']],
            ['ACTIVE', '=', '1'],
        ])->get();



        if ($request->has('CATEGORY_NAME')) {
            $model = JobCategories::class;
            $category = Helper::getTableRow($model, 'NAME', $arrRequest['CATEGORY_NAME']);
            $arrRequest['CATEGORY_ID'] = $category->ID;
        }


        if (!empty($arrRequest)) {
            $filterParams = ['LEVEL', 'CATEGORY_ID', 'CITY'];

            //assembling filter params
            $arrFilter = [];
            foreach ($arrRequest as $paramName => $paramValue) {
                if (in_array($paramName, $filterParams)) {
                    $arrFilter[$paramName] = $paramValue;
                }
            }

            //filtering collection
            if (!empty($arrFilter)) {
                foreach ($arrFilter as $key => $value) {
                    $candidates = $candidates->where($key, $value);
                }
            }

            //sorting results
            if ($request->has('SORT')) {
                if ($arrRequest['SORT'] == 'maxExperience') {
                    $sortFiled = 'YEARS_EXPERIENCE';
                } elseif ($arrRequest['SORT'] == 'newest') {
                    $sortFiled = 'created_at';
                }
                $candidates = $candidates->orderBy($sortFiled, 'desc');
            }
        }


        return $candidates;
    }
}