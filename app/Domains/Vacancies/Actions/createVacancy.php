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

class createVacancy
{
    public function run($request) {
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


        $arrVacancyFields = [
            'NAME' => 'Test',
            //'ICON' => Auth::user()->ICON,
            //'IMAGE' => Auth::user()->IMAGE,
            'COUNTRY' => 'Test',
            'CITY' => 'Test',
            'CATEGORY_ID' => 1,
            //'COMPANY_ID' => Auth::user()->id, TODO передать с другого сервиса
            'SALARY_FROM' => 1000,
            'DESCRIPTION' => 2000,
            //'RESPONSIBILITY' => Helper::convertTextPointsToJson($request->RESPONSIBILITY),
            //'QUALIFICATIONS' => Helper::convertTextPointsToJson($request->QUALIFICATIONS),
            'BENEFITS' => 'Test'
        ];

        return Vacancies::create($arrVacancyFields);
    }


}