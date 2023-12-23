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

class updateVacancy
{
    public function run($request) {
        $arParams = [];
        foreach ($request->all() as $name => $value) {
            if ($name == 'VACANCY_ID') continue;
            $arParams[$name] = $value;
        }

        return Vacancies::where('ID', $request->VACANCY_ID)->limit(1)->update($arParams);




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