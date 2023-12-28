<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14/05/23
 * Time: 23:58
 */

namespace App\Domains\Vacancies\Actions;

use App\Domains\Vacancies\Models\Vacancies;
use Illuminate\Support\Facades\Log;


class deleteVacancy
{
   public function run($vacancyId) {
       try {
           $result = Vacancies::find($vacancyId)->delete();
           Log::info('deleteVacancy()', ['request_data' => $vacancyId, 'response_data' => $result]);
           return $result;
       } catch(\Exception $exception) {
           Log::error('deleteVacancy()', ['error_message' => $exception->getMessage()]);
           return $exception->getMessage();
       }
    }
}
