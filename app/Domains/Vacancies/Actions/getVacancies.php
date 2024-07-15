<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14/05/23
 * Time: 23:58
 */

namespace App\Domains\Vacancies\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Domains\Vacancies\Models\Vacancies;
use App\Domains\Candidates\Models\Review;
use App\Helper;
use Illuminate\Support\Facades\Log;


class getVacancies
{
    public function run(Request $request) {
        try {
            $arrRequest = $request->all();
            $vacancies = new Vacancies();

            if ($request->has('CATEGORY_NAME')) {
                $model = Review::class;
                $category = Helper::getTableRow($model, 'NAME', $arrRequest['CATEGORY_NAME']);
                $arrRequest['CATEGORY_ID'] = $category->ID;
            }

            $filterParams = ['CATEGORY_ID', 'CITY', 'COMPANY_ID'];

            if (!empty($arrRequest)) {
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
                        $vacancies = $vacancies->where($key, $value);
                    }
                }

                //sorting results
                if ($request->has('SORT')) {
                    if ($arrRequest['SORT'] == 'highestSalary') {
                        $sortFiled = 'SALARY_FROM';
                    } elseif ($arrRequest['SORT'] == 'newest') {
                        $sortFiled = 'created_at';
                    }
                    $vacancies = $vacancies->orderBy($sortFiled, 'desc');
                }
            }

            $itemsOnPage = 20; //TODO сделать норм. паригацию
            $result = $vacancies->where('ACTIVE', 1)->paginate($itemsOnPage)->withQueryString();
            Log::info('getVacancies()', ['request_data' => $arrRequest, 'response_data' => $result]);
            return $result;
        } catch(\Exception $exception) {
            Log::error('getVacancies()', ['error_message' => $exception->getMessage()]);
            return $exception->getMessage();
        }
    }
}
