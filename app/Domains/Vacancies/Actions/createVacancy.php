<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14/05/23
 * Time: 23:58
 */

namespace App\Containers\Vacancies\Actions;

use App\Ship\Helpers\Helper;
use App\Containers\Vacancies\Models\Vacancies;

class createVacancy
{
    public function run($request) {
        $arrVacancyFields = [
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
        ];

        return Vacancies::create($arrVacancyFields);
    }


}