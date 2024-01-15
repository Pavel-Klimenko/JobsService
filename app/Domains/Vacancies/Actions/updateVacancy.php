<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14/05/23
 * Time: 23:58
 */

namespace App\Domains\Vacancies\Actions;

use App\Helper;
use App\Domains\Vacancies\Models\Vacancies;
use Illuminate\Support\Facades\Log;

class updateVacancy
{
    public function run($id, $request) {
        try {
            $arParams = [];
            $arRequest = $request->all();

            foreach ($arRequest as $name => $value) {
                $arParams[$name] = $value;
            }
            $result = Vacancies::where('ID', $id)->limit(1)->update($arParams);
            Log::info('updateVacancy()', ['request_data' => $arRequest, 'response_data' => $result]);
            return $result;
        } catch(\Exception $exception) {
            Log::error('updateVacancy()', ['error_message' => $exception->getMessage()]);
            return $exception->getMessage();
        }

        //$vacancy->NAME = 'PHP Developer';

        //$vacancy->NAME = $request->NAME;
/*        $vacancy->ICON = Auth::user()->ICON;
        $vacancy->IMAGE = Auth::user()->IMAGE;*/
/*        $vacancy->COUNTRY = $request->COUNTRY;
        $vacancy->CITY = $request->CITY;
        $vacancy->CATEGORY_ID = $request->CATEGORY_ID;
        $vacancy->COMPANY_ID = Auth::user()->id;
        $vacancy->SALARY_FROM = $request->SALARY_FROM;
        $vacancy->DESCRIPTION = $request->DESCRIPTION;
        $vacancy->RESPONSIBILITY = Helper::convertTextPointsToJson($request->RESPONSIBILITY);
        $vacancy->QUALIFICATIONS = Helper::convertTextPointsToJson($request->QUALIFICATIONS);
        $vacancy->BENEFITS = $request->BENEFITS;
        $vacancy->ACTIVE = 0;*/


        //return $vacancy->update($params);
    }

}
