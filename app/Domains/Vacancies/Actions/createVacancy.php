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
use Illuminate\Support\Facades\Log;

class createVacancy
{
    public function run($arRequest) {
            try {
            $result = Vacancies::create($arRequest);
            return $result;
        } catch(\Exception $exception) {
            Log::error('createVacancy()', ['error_message' => $exception->getMessage()]);
            return $exception->getMessage();
        }
    }


}
