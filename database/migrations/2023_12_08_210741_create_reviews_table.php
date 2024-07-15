<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domains\Home\Models\Review;
use App\User;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable(Review::TABLE_NAME)) {
            Schema::create(Review::TABLE_NAME, function (Blueprint $table) {
                $table->id();
                $table->string('title')->nullable();
                $table->mediumText('review')->nullable();
                $table->foreignId('user_id')
                    ->constrained(User::TABLE_NAME)
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
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
        Schema::dropIfExists(Review::TABLE_NAME);
    }
}
