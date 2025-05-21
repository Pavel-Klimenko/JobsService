<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\User;
use App\Domains\Chat\Models\Message;
use App\Domains\Chat\Models\Chat;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable(Message::TABLE_NAME)) {
            Schema::create(Message::TABLE_NAME, function (Blueprint $table) {
                $table->id();
                $table->foreignId('chat_id')
                    ->constrained(Chat::TABLE_NAME)
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
                $table->foreignId('user_id')
                    ->constrained(User::TABLE_NAME)
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
                $table->text('message');
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
        Schema::dropIfExists(Message::TABLE_NAME);
    }
}
