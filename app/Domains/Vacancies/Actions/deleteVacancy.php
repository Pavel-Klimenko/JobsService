<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14/05/23
 * Time: 23:58
 */

namespace App\Domains\Vacancies\Actions;

use App\Domains\Vacancies\Models\Vacancies;


class deleteVacancy
{
   public function run($vacancyId) {
        return Vacancies::find($vacancyId)->delete();
    }
}