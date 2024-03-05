<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

use App\Domains\Candidates\Models\Candidates;
use App\Domains\Vacancies\Models\Vacancies;

class UserNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */


    private $emailTo;
    private $template;
    private $mailVariables;

    public function __construct($arParams)
    {
        if ($arParams['TYPE'] == 'interview_invitation') {
            //TODO передать ссылку на CV откликнувшегося пользователя
            $this->company = Candidates::find($arParams['COMPANY_ID']);
            $this->vacancy = Vacancies::find($arParams['VACANCY_ID']);

            $this->template = 'mail.interview_invitation';
            $this->emailTo = $this->company->EMAIL;

            $this->mailVariables = [
                'title' => 'New job application!',
                'covering_letter' => $arParams['CANDIDATE_COVERING_LETTER'],
                'company' => $this->company->EMAIL,
                'vacancy' => $this->vacancy,
            ];
        }

        if ($arParams['TYPE'] == 'answer_to_invitation') {
            $this->template = 'mail.answer_to_invitation';
            $this->emailTo = $arParams['CANDIDATE']['EMAIL'];

            $this->mailVariables = [
                'title' => 'The company has replied to you!',
                'status' => $arParams['INVITATION']['STATUS'],
                'company' => $arParams['COMPANY'],
                'vacancy' => $arParams['VACANCY'],
            ];
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->emailTo)
            ->view($this->template)
            ->with($this->mailVariables);
    }
}
