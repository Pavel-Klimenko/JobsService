<?php

namespace App\Domains\Personal\Actions;

use App\Constants;
use App\Domains\Candidates\Models\InterviewInvitations;
use RuntimeException;
//use App\Models\User;

class changeInvitationStatus
{
    public function run($id, $status)
    {
        $invitation = InterviewInvitations::find($id);
        $invitation->STATUS = $status;
        $invitation->save();

        if (!in_array($status, ['accepted', 'rejected'])) throw new RuntimeException('Wrong invitation status');

        //sending notification to candidate email
        if ($status == 'rejected') {
            $message = 'Unfortunately company can\'t invite you to the interview';
        } elseif ($status == 'accepted') {
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
