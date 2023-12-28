<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14/05/23
 * Time: 23:58
 */

namespace App\Domains\Candidates\Actions;

use App\Domains\Candidates\Models\User;
use Illuminate\Support\Facades\Log;

class getCandidate
{
    public function run($id) {
        try {
            $result = User::find($id);
            Log::info('getCandidate()', ['request_data' => $id, 'response_data' => $result]);
            return $result;

        } catch(\Exception $exception) {
            Log::error('getCandidate()', ['error_message' => $exception->getMessage()]);
            return $exception->getMessage();
        }
    }
}
