<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id('ID')->autoIncrement();
            $table->string('NAME')->nullable();
            $table->string('ICON')->nullable();
            $table->string('IMAGE')->nullable();
            $table->string('COUNTRY')->nullable();
            $table->string('CITY')->nullable();
            $table->bigInteger('CATEGORY_ID')->nullable();
            $table->bigInteger('COMPANY_ID')->nullable();
            $table->float('SALARY_FROM')->nullable();
            $table->mediumText('DESCRIPTION')->nullable();
            $table->json('RESPONSIBILITY')->nullable();
            $table->json('QUALIFICATIONS')->nullable();
            $table->mediumText('BENEFITS')->nullable();
            $table->boolean('ACTIVE')->default(false);
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
        Schema::dropIfExists('vacancies');
    }
}
