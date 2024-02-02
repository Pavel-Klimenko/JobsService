<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitationsToInterviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations_to_interview', function (Blueprint $table) {
            $table->id('ID')->autoIncrement();
            $table->bigInteger('COMPANY_ID')->nullable();
            $table->bigInteger('CANDIDATE_ID')->nullable();
            $table->bigInteger('VACANCY_ID')->nullable();
            $table->mediumText('CANDIDATE_COVERING_LETTER')->nullable();
            $table->string('STATUS')->nullable();
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
        Schema::dropIfExists('invitations_to_interview');
    }
}
