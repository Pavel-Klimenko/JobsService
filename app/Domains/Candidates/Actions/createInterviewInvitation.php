<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14/05/23
 * Time: 23:58
 */

namespace App\Domains\Candidates\Actions;

use App\Domains\Candidates\Models\InterviewInvitations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;


class createInterviewInvitation
{
    public function run($request) {
        try {
            return InterviewInvitations::create($request->all());
        } catch(\Exception $exception) {
            Log::error('createInterviewInvitation()', ['error_message' => $exception->getMessage()]);
            return $exception->getMessage();
        }
    }
}
