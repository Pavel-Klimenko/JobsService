<?php

namespace App\Jobs;

use App\Domains\Candidates\Http\Requests\createVacancyInvitationRequest;
use App\Domains\Vacancies\Models\Vacancies;
use App\Helper;
use App\Services\CandidateService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateVacancyRequestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


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
            app(CandidateService::class)
                ->createVacancyRequest($this->currentCandidate, $this->vacancy, $this->candidate_covering_letter);
        } catch(\Exception $exception) {
            Log::error($exception->getMessage());
        }



    }
}
