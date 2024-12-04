<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domains\Candidates\Models\Candidate;
use App\Domains\Candidates\Models\JobCategories;
use App\Domains\Candidates\Models\CandidateLevels;
use App\User;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Candidate::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained(User::TABLE_NAME)
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('job_category_id')
                ->nullable()
                ->constrained(JobCategories::TABLE_NAME)
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('level_id')
                ->nullable()
                ->constrained(CandidateLevels::TABLE_NAME)
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->float('years_experience')->nullable();
            $table->float('salary')->nullable();
            $table->mediumText('experience')->nullable();
            $table->mediumText('education')->nullable();
            $table->mediumText('about_me')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Candidate::TABLE_NAME);
    }
}
