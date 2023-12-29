<?php
///**
// * Created by PhpStorm.
// * User: pavel
// * Date: 14/05/23
// * Time: 23:58
// */
//
//namespace App\Containers\Personal\Actions;
//
//use App\Constants;
//use App\Containers\Vacancies\Models\InterviewInvitations;
//use App\Models\User;
//
//class changeAdviceStatus
//{
//    public function run($INVITE_ID, $STATUS) {
//        $invitation = InterviewInvitations::find($INVITE_ID);
//        $candidate = User::find($invitation->CANDIDATE_ID);
//        $company = User::find($invitation->COMPANY_ID);
//
//        $invitation->STATUS = $STATUS;
//        $invitation->save();
//
//
//        //sending notification to candidate email
//        if ($STATUS == 'rejected') {
//            $message = 'Unfortunately company can\'t invite you to the interview';
//        } elseif ($STATUS == 'accepted') {
//            $message = 'You have been invited for an interview';
//        }
//
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
//
//        return $date;
//    }
//}
