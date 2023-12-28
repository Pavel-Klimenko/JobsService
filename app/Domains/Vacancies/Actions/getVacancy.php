<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14/05/23
 * Time: 23:58
 */

namespace App\Domains\Vacancies\Actions;

use App\Domains\Candidates\Models\User;
use App\Domains\Vacancies\Models\Vacancies;
use Illuminate\Support\Facades\Log;

class getVacancy
{
    public function run($id) {
        try {
            $result = Vacancies::find($id);
            Log::info('getVacancy()', ['request_data' => $id, 'response_data' => $result]);
            return $result;

        } catch(\Exception $exception) {
            Log::error('getVacancy()', ['error_message' => $exception->getMessage()]);
            return $exception->getMessage();
        }
    }
}
