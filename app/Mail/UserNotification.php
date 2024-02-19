<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

use App\Domains\Candidates\Models\User;
use App\Domains\Vacancies\Models\Vacancies;

class UserNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */


    private $title;

    public function __construct($arMessage)
    {
        $company = User::find($arMessage['COMPANY_ID']);
        $vacancy = Vacancies::find($arMessage['VACANCY_ID']);

        Log::debug($company);
        Log::debug($vacancy);

        $this->title = 'test title';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //TODO разные шаблоны для сообщений!
        return $this->to('pavel.klimenko.1989@gmail.com')
            ->view('mail.user_notification')
            ->with([
                'title' => $this->title,
                //'orderPrice' => $this->order->price,
            ]);
    }
}
