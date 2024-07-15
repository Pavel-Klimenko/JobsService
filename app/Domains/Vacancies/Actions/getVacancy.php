<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14/05/23
 * Time: 23:58
 */

namespace App\Domains\Vacancies\Actions;

use App\Domains\Candidates\Models\Review;
use App\Domains\Candidates\Models\Candidate;
use App\Domains\Vacancies\Models\Vacancies;
use App\Helper;
use Illuminate\Support\Facades\Log;

class getVacancy
{
    public function run($id) {
        try {
            $vacancy = Vacancies::find($id);
            $vacancy->COMPANY = Helper::getTableRow(Candidate::class, 'ID', $vacancy->COMPANY_ID);
            return $vacancy;
        } catch(\Exception $exception) {
            Log::error('getVacancy()', ['error_message' => $exception->getMessage()]);
            return $exception->getMessage();
        }
    }
}
