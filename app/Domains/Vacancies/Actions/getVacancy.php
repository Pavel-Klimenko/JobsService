<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14/05/23
 * Time: 23:58
 */

namespace App\Domains\Vacancies\Actions;

use App\Domains\Candidates\Models\Candidate;
use App\Domains\Vacancies\Models\Vacancies;
use App\Helper;
use Illuminate\Support\Facades\Log;

class getVacancy
{
    public function run($id) {
        try {
            return Vacancies::with('job_category', 'company.user')->find($id);
        } catch(\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
