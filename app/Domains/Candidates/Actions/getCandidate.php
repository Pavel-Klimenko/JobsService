<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14/05/23
 * Time: 23:58
 */

namespace App\Domains\Candidates\Actions;

use App\Domains\Candidates\Models\User;
use App\Domains\Candidates\Models\JobCategories;
use Illuminate\Support\Facades\Log;
use App\Helper;

class getCandidate
{
    public function run($id) {
        try {
            $result = User::find($id);
            $result->CATEGORY_NAME = JobCategories::find($result->CATEGORY_ID)->NAME;
            return $result;
        } catch(\Exception $exception) {
            Log::error('getCandidate()', ['error_message' => $exception->getMessage()]);
            return $exception->getMessage();
        }
    }
}
