<?php

use App\Domains\Personal\Models\Company;
use App\Domains\Candidates\Models\Candidate;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domains\Chat\Models\Chat;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable(Chat::TABLE_NAME)) {
            Schema::create(Chat::TABLE_NAME, function (Blueprint $table) {
                $table->id();
                $table->foreignId('candidate_id')
                    ->constrained(Candidate::TABLE_NAME)
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
                $table->foreignId('company_id')
                    ->constrained(Company::TABLE_NAME)
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
        Schema::dropIfExists(Chat::TABLE_NAME);
    }
}
