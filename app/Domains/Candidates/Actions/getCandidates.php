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
use App\Domains\Candidates\Models\Candidates;
use Illuminate\Support\Facades\Log;

class getCandidates
{
    public function run($request) {
        try {
            $arrRequest = $request->all();

            $candidates = Candidates::where([
                ['role_id', Constants::USER_ROLES_IDS['candidate']],
                ['ACTIVE', '=', '1'],
            ])->get();

//            if ($request->has('CATEGORY_NAME')) {
//                $model = JobCategories::class;
//                $category = Helper::getTableRow($model, 'NAME', $arrRequest['CATEGORY_NAME']);
//                $arrRequest['CATEGORY_ID'] = $category->ID;
//            }


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
//                    if ($arrRequest['SORT'] == 'maxExperience') {
//                        $sortFiled = 'YEARS_EXPERIENCE';
//                    } elseif ($arrRequest['SORT'] == 'newest') {
//                        $sortFiled = 'created_at';
//                    }

                    $candidates = $candidates->orderBy($arrRequest['SORT'], 'desc');
                }
            }

            foreach ($candidates as $user) {
                $category = Helper::getTableRow(JobCategories::class, 'ID', $user->CATEGORY_ID);
                $user->CATEGORY_NAME = $category->NAME;
            }

            return $candidates;

        } catch(\Exception $exception) {
            Log::error('getCandidates()', ['error_message' => $exception->getMessage()]);
            return $exception->getMessage();
        }


    }
}
