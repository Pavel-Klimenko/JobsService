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

class createVacancy
{
    public function run($arRequest) {
            try {
                /*        $arrVacancyFields = [
                'NAME' => $request->NAME,
                'ICON' => Auth::user()->ICON,
                'IMAGE' => Auth::user()->IMAGE,
                'COUNTRY' => $request->COUNTRY,
                'CITY' => $request->CITY,
                'CATEGORY_ID' => $request->CATEGORY_ID,
                'COMPANY_ID' => Auth::user()->id,
                'SALARY_FROM' => $request->SALARY_FROM,
                'DESCRIPTION' => $request->DESCRIPTION,
                'RESPONSIBILITY' => Helper::convertTextPointsToJson($request->RESPONSIBILITY),
                'QUALIFICATIONS' => Helper::convertTextPointsToJson($request->QUALIFICATIONS),
                'BENEFITS' => $request->BENEFITS
            ];*/

            $result = Vacancies::create($arRequest);

            Log::info('createVacancy()', ['request_data' => $arRequest, 'response_data' => $result]);
            return $result;
        } catch(\Exception $exception) {
            Log::error('createVacancy()', ['error_message' => $exception->getMessage()]);
            return $exception->getMessage();
        }
    }


}
