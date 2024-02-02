<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14/05/23
 * Time: 23:58
 */

namespace App\Domains\Vacancies\Actions;

use App\Domains\Candidates\Models\JobCategories;
use App\Domains\Candidates\Models\User;
use App\Domains\Vacancies\Models\Vacancies;
use App\Helper;
use Illuminate\Support\Facades\Log;

class getVacancy
{
    public function run($id) {
        try {
            $vacancy = Vacancies::find($id);
            $vacancy->COMPANY = Helper::getTableRow(User::class, 'ID', $vacancy->COMPANY_ID);
            return $vacancy;
        } catch(\Exception $exception) {
            Log::error('getVacancy()', ['error_message' => $exception->getMessage()]);
            return $exception->getMessage();
        }
    }
}
