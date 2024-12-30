<?php

namespace App\Jobs;

use App\Domains\Candidates\Models\InterviewInvitations;
use App\Domains\Candidates\Models\InvitationsStatus;
use App\Domains\Companies\Http\Requests\answerToVacancyInvitationRequest;
use App\Mail\UserMailNotification;
use App\Services\VacancyService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use RuntimeException;
use App\Helper;

class AnswerToVacancyRequestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $vacancyRequest;
    private $currentUser;
    private $answerStatus;

    public $tries = 3;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(answerToVacancyInvitationRequest $request)
    {
        $this->vacancyRequest = Helper::checkElementExistense(InterviewInvitations::class, $request->vacancy_request_id);
        $this->currentUser = $request->user();
        $this->answerStatus = Helper::checkElementExistense(InvitationsStatus::class, $request->answer_status_id);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            DB::beginTransaction();
            if ($this->currentUser->company->id != $this->vacancyRequest->vacancy->company_id) {
                throw new RuntimeException("Vacancy doesn`t relate to this company");
            }
            app(VacancyService::class)->answerToVacancyRequest($this->vacancyRequest, $this->answerStatus);

            Mail::send(new UserMailNotification([
                'TYPE' => 'answer_to_invitation',
                'VACANCY_REQUEST' => $this->vacancyRequest,
            ]));

            DB::commit();
        } catch(\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
        }
    }
}
