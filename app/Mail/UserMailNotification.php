<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserMailNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    private $vacancyRequest;
    private $answerStatus;
    private $emailTo;
    private $template;
    private $mailVariables;

    public function __construct($arParams)
    {
        if ($arParams['TYPE'] == 'interview_invitation') {
            $this->template = 'mail.interview_invitation';
            $this->vacancyRequest = $arParams['VACANCY_REQUEST'];
            $this->emailTo = $this->vacancyRequest->vacancy->company->user->email;

            $this->mailVariables = [
                'title' => 'New vacancy request from candidate!',
                'vacancy_title' => $this->vacancyRequest->vacancy->title,
                'candidate_name' => $this->vacancyRequest->candidate->user->name,
                'candidate_city' => $this->vacancyRequest->candidate->user->city,
                'candidate_level' => $this->vacancyRequest->candidate->level->code,
                'candidate_years_experience' => $this->vacancyRequest->candidate->years_experience,
                'covering_letter' => $this->vacancyRequest->candidate_covering_letter,
            ];

        }

        if ($arParams['TYPE'] == 'answer_to_invitation') {
            $this->template = 'mail.answer_to_invitation';
            $this->vacancyRequest = $arParams['VACANCY_REQUEST'];

            $this->emailTo = $this->vacancyRequest->candidate->user->email;

            $this->mailVariables = [
                'title' => 'The company has replied to you!',
                'answer_status' => $this->vacancyRequest->status->code,
                'company_name' => $this->vacancyRequest->vacancy->company->user->name,
                'company_email' => $this->vacancyRequest->vacancy->company->user->email,
                'company_phone' => $this->vacancyRequest->vacancy->company->user->phone,
                'vacancy_title' => $this->vacancyRequest->vacancy->title,
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
