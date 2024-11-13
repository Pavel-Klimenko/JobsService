<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domains\Candidates\Models\JobCategories;
use App\Domains\Vacancies\Models\Vacancies;
use App\Domains\Personal\Models\Company;

class CreateVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable(Vacancies::TABLE_NAME)) {
            Schema::create(Vacancies::TABLE_NAME, function (Blueprint $table) {
                $table->id();
                $table->string('title')->nullable();
                $table->foreignId('job_category_id')
                    ->constrained(JobCategories::TABLE_NAME)
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();

                $table->foreignId('company_id')
                    ->constrained(Company::TABLE_NAME)
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();

                $table->float('salary_from')->nullable();
                $table->mediumText('description')->nullable();
                $table->boolean('active')->default(true);
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
        Schema::dropIfExists(Vacancies::TABLE_NAME);
    }
}
