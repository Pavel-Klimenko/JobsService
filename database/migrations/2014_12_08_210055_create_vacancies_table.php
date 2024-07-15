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
        if (!Schema::hasTable('vacancies')) {
            Schema::create('vacancies', function (Blueprint $table) {
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
                $table->boolean('active')->default(false);
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
        Schema::dropIfExists('vacancies');
    }
}
