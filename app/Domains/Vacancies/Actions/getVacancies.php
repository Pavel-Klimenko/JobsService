<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14/05/23
 * Time: 23:58
 */

namespace App\Domains\Vacancies\Actions;

use App\Domains\Candidates\Models\Candidate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Domains\Vacancies\Models\Vacancies;


class getVacancies
{
    public function run(int $page, int $pageLimit) {
        try {
            $vacancies = Vacancies::with('job_category', 'company.user')
                ->paginate($pageLimit, ['*'], 'page', $page);

            return $vacancies;


            //TODO сделать фильтрацию!!!



//            $arrRequest = $request->all();
//            $vacancies = new Vacancies();
//
//            if ($request->has('CATEGORY_NAME')) {
//                $model = Review::class;
//                $category = Helper::getTableRow($model, 'NAME', $arrRequest['CATEGORY_NAME']);
//                $arrRequest['CATEGORY_ID'] = $category->ID;
//            }
//
//            $filterParams = ['CATEGORY_ID', 'CITY', 'COMPANY_ID'];
//
//            if (!empty($arrRequest)) {
//                //assembling filter params
//                $arrFilter = [];
//                foreach ($arrRequest as $paramName => $paramValue) {
//                    if (in_array($paramName, $filterParams)) {
//                        $arrFilter[$paramName] = $paramValue;
//                    }
//                }
//
//                //filtering collection
//                if (!empty($arrFilter)) {
//                    foreach ($arrFilter as $key => $value) {
//                        $vacancies = $vacancies->where($key, $value);
//                    }
//                }
//
//                //sorting results
//                if ($request->has('SORT')) {
//                    if ($arrRequest['SORT'] == 'highestSalary') {
//                        $sortFiled = 'SALARY_FROM';
//                    } elseif ($arrRequest['SORT'] == 'newest') {
//                        $sortFiled = 'created_at';
//                    }
//                    $vacancies = $vacancies->orderBy($sortFiled, 'desc');
//                }
//            }
//
//            $itemsOnPage = 20; //TODO сделать норм. паригацию
//            $result = $vacancies->where('ACTIVE', 1)->paginate($itemsOnPage)->withQueryString();

            return $result;
        } catch(\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
