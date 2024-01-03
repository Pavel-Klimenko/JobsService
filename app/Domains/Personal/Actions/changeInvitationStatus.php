<?php

namespace App\Domains\Personal\Actions;

use App\Constants;
use App\Domains\Candidates\Models\InterviewInvitations;
//use App\Models\User;

class changeInvitationStatus
{
    public function run($request)
    {
        $invitation = InterviewInvitations::find($request->id);
        $invitation->STATUS = $request->status;
        $invitation->save();

        //sending notification to candidate email
        if ($request->status == 'rejected') {
            $message = 'Unfortunately company can\'t invite you to the interview';
        } elseif ($request->status == 'accepted') {
            $message = 'You have been invited for an interview';
        }

        return [
            'message' => $message
        ];



//        $date = (object)[
//            'name' => Constants::SITE_NAME,
//            'email' => Constants::EMAIL,
//            'message' => $message,
//            'candidate_email' => $candidate->EMAIL,
//            'company_name' => $company->NAME,
//            'company_email' => $company->EMAIL,
//            'company_phone' => $company->PHONE,
//            'company_website' => $company->WEB_SITE,
//            'vacancy_id' => $invitation->VACANCY_ID,
//            'vacancy_name' => $invitation->VACANCY_NAME,
//        ];

        //return $date;
    }
}
