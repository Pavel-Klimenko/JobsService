<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domains\Candidates\Models\InterviewInvitations;
use App\Domains\Vacancies\Models\Vacancies;
use App\Domains\Candidates\Models\Candidate;
use App\Domains\Candidates\Models\InvitationsStatus;
use App\Services\CandidateService;

class CreateInvitationsToInterviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {



        if (!Schema::hasTable(InterviewInvitations::TABLE_NAME)) {
            //$defaultStatus = app(CandidateService::class)->getInvitationStatusByCode('no_status');
            Schema::create(InterviewInvitations::TABLE_NAME, function (Blueprint $table) {
                $table->id();
                $table->foreignId('vacancy_id')
                    ->constrained(Vacancies::TABLE_NAME)
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
                $table->foreignId('candidate_id')
                    ->constrained(Candidate::TABLE_NAME)
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
                $table->mediumText('candidate_covering_letter')->nullable();
                $table->foreignId('status_id')
                    ->nullable()
                    //->default($defaultStatus->id)
                    ->constrained(InvitationsStatus::TABLE_NAME)
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(InterviewInvitations::TABLE_NAME);
    }
}
