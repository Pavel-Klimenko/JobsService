<?php

namespace App\Domains\Personal\Actions;

use App\Domains\Candidates\Models\InterviewInvitations;
use App\Domains\Candidates\Models\Candidates;
use App\Domains\Vacancies\Models\Vacancies;
use RuntimeException;

class changeInvitationStatus
{
    public function run($id, $status)
    {
        $invitation = InterviewInvitations::find($id);
        $invitation->STATUS = $status;
        $invitation->save();

        //TODO убать у таблицы invitations_to_interview поля CANDIDATE_NAME и VACANCY_NAME
        $candidate = Candidates::find($invitation->CANDIDATE_ID);
        $company = Candidates::find($invitation->COMPANY_ID);
        $vacancy = Vacancies::find($invitation->VACANCY_ID);

        if (!in_array($status, ['accepted', 'rejected'])) throw new RuntimeException('Wrong invitation status');

        return [
            'status' => $status,
            'invitation' => $invitation,
            'vacancy' => $vacancy,
            'candidate' => $candidate,
            'company' => $company,
        ];
    }
}
