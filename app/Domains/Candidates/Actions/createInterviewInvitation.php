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
            $inquries = new InterviewInvitations();
            $inquries->COMPANY_ID = $request->COMPANY_ID;
            $inquries->CANDIDATE_ID = $request->CANDIDATE_ID;
            $inquries->VACANCY_ID = $request->VACANCY_ID;
            $inquries->CANDIDATE_COVERING_LETTER = $request->COVERING_LETTER;
            $result = $inquries->save();
            Log::info('createInterviewInvitation()', ['request_data' => $request->all(), 'response_data' => $result]);
            return $result;

        } catch(\Exception $exception) {
            Log::error('createInterviewInvitation()', ['error_message' => $exception->getMessage()]);
            return $exception->getMessage();
        }




    }
}
