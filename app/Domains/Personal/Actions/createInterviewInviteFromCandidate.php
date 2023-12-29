<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 14/05/23
 * Time: 23:58
 */

namespace App\Domains\Personal\Actions;

use App\Constants;
use App\Domains\Vacancies\Models\Vacancies;
use App\Domains\Candidates\Models\InterviewInvitations;
use App\Domains\Candidates\Models\User;
//use App\Events\CandidateInvitation;
//use App\Events\VacancyInterviewRequest;
use App\Helper;

class createInterviewInviteFromCandidate
{
    public function run($request) {
        $invitation = new InterviewInvitations();
        $candidate = User::find($request->user_id);

        if ($candidate->role_id != Constants::USER_ROLES_IDS['candidate']) return 'Error: user is not a candidate';

        $vacancy = Helper::getTableRow(Vacancies::class, 'ID', $request->VACANCY_ID);
        //$company = User::find($request->COMPANY_ID);

        $invitation->COMPANY_ID = $request->COMPANY_ID;
        $invitation->CANDIDATE_ID = $candidate->id;
        $invitation->CANDIDATE_NAME = $candidate->NAME;
        $invitation->VACANCY_ID = $request->VACANCY_ID;
        $invitation->VACANCY_NAME = $vacancy->NAME;
        $invitation->CANDIDATE_COVERING_LETTER = $request->CANDIDATE_COVERING_LETTER;
        $invitation->STATUS = 'no_status';


        //sending notification to candidate email
//        $date = (object)[
//            'name' => Constants::SITE_NAME,
//            'email' => Constants::EMAIL,
//            //'template' => '',
//            'message' => 'Candidate send ad interview request',
//            'company_email' => $company->EMAIL,
//            'candidate_id' => $candidate->id,
//            'candidate_name' => $candidate->NAME,
//            'candidate_email' => $candidate->EMAIL,
//            'candidate_phone' => $candidate->PHONE,
//            'covering_letter' => $request->CANDIDATE_COVERING_LETTER,
//            'vacancy_id' => $request->VACANCY_ID,
//            'vacancy_name' => $vacancy->NAME,
//        ];

        $result = $invitation->save();

        return $result;
    }
}
