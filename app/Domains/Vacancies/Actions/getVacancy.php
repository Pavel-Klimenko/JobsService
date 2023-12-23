<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14/05/23
 * Time: 23:58
 */

namespace App\Domains\Vacancies\Actions;

use App\Domains\Vacancies\Models\Vacancies;

class getVacancy
{
    public function run($id) {
        return Vacancies::find($id);
    }
}