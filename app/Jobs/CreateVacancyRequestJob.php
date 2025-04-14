<?php

namespace App\Jobs;

use App\Domains\VacancyInvitations\Http\Requests\createVacancyInvitationRequest;
use App\Domains\Vacancies\Models\Vacancies;
use App\Helper;
use App\Mail\UserMailNotification;
use App\Services\CandidateService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class CreateVacancyRequestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;


    private $currentCandidate;
    private $vacancy;
    private $candidate_covering_letter;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(createVacancyInvitationRequest $request)
    {
        $this->currentCandidate = $request->user()->candidate;
        $this->vacancy = Helper::checkElementExistense(Vacancies::class, $request->vacancy_id);
        $this->candidate_covering_letter = $request->candidate_covering_letter;
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
            if ($createdVacancyRequest = app(CandidateService::class)->createVacancyRequest(
                $this->currentCandidate,
                $this->vacancy,
                $this->candidate_covering_letter
            )) {
                Mail::send(new UserMailNotification([
                    'TYPE' => 'interview_invitation',
                    'VACANCY_REQUEST' => $createdVacancyRequest,
                ]));
            }

            DB::commit();
        } catch(\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
        }
    }
}
