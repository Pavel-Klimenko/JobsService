<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14/05/23
 * Time: 23:58
 */

namespace App\Domains\Personal\Actions;

use App\Constants;
use App\Domains\Candidates\Models\InterviewInvitations;
use App\Domains\Candidates\Models\User;
use App\Domains\Vacancies\Models\Vacancies;
use App\Helper;
use Illuminate\Database\Eloquent\Model;

//use App\Events\CandidateInvitation;

class createInterviewInvitation
{
    public function run($request) {
        $invitation = new InterviewInvitations();
        $user = User::find($request->user_id);

        if ($user->role_id == Constants::USER_ROLES_IDS['company']) {
            $invitation->COMPANY_ID = $request->user_id;
            $invitation->CANDIDATE_ID = $request->CANDIDATE_ID;
            $candidate = User::find($request->CANDIDATE_ID);
            $vacancy = Vacancies::find($request->VACANCY_ID);
            $invitation->CANDIDATE_NAME = $candidate->NAME;
            $invitation->VACANCY_ID = $request->VACANCY_ID;
            $invitation->VACANCY_NAME = $vacancy->NAME;
            $invitation->STATUS = $request->STATUS;
        } elseif ($user->role_id == Constants::USER_ROLES_IDS['candidate']) {
            $vacancy = Helper::getTableRow(Vacancies::class, 'ID', $request->VACANCY_ID);
            $invitation->COMPANY_ID = $request->COMPANY_ID;
            $invitation->CANDIDATE_ID = $user->id;
            $invitation->CANDIDATE_NAME = $user->NAME;
            $invitation->VACANCY_ID = $request->VACANCY_ID;
            $invitation->VACANCY_NAME = $vacancy->NAME;
            $invitation->CANDIDATE_COVERING_LETTER = $request->CANDIDATE_COVERING_LETTER;
            $invitation->STATUS = 'no_status';
        }

        //$candidate = User::find($request->CANDIDATE_ID);

        //sending notification to candidate email
//        $date = (object) [
//            'name' => Constants::SITE_NAME,
//            'email' => Constants::EMAIL,
//            'message' => 'You are invited for an interview!',
//            'candidate_email' => $candidate->EMAIL,
//            'company_name' => Auth::user()->NAME,
//            'company_email' => Auth::user()->EMAIL,
//            'company_phone' => Auth::user()->PHONE,
//            'company_website' => Auth::user()->WEB_SITE,
//            'vacancy_id' => $request->VACANCY_ID,
//            'vacancy_name' => $vacancy->NAME,
//        ];

        $result = $invitation->save();

        return $result;
    }
}
