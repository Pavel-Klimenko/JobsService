<?php

namespace App\Jobs;

use App\Domains\Candidates\Models\InterviewInvitations;
use App\Domains\Candidates\Models\InvitationsStatus;
use App\Domains\Companies\Http\Requests\answerToVacancyInvitationRequest;
use App\Services\VacancyService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use RuntimeException;
use App\Helper;

class AnswerToVacancyRequestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $vacancyRequest;
    private $currentUser;
    private $answerStatus;

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
            if ($this->currentUser->company->id != $this->vacancyRequest->vacancy->company_id) {
                throw new RuntimeException("Vacancy doesn`t relate to this company");
            }
            app(VacancyService::class)->answerToVacancyRequest($this->vacancyRequest, $this->answerStatus);

        } catch(\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
