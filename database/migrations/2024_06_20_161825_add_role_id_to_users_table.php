<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Domains\Personal\Models\Role;
use App\User;

class AddRoleIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable(User::TABLE_NAME)) {
            if (!Schema::hasColumn(User::TABLE_NAME, 'locale_id')) {
                Schema::table(User::TABLE_NAME, function (Blueprint $table) {
                    $table->foreignId('role_id')
                        ->constrained(Role::TABLE_NAME)
                        ->cascadeOnDelete()
                        ->cascadeOnUpdate();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable(User::TABLE_NAME) && Schema::hasColumn(User::TABLE_NAME, 'role_id')) {
            Schema::table(User::TABLE_NAME, function (Blueprint $table) {
                $table->dropForeign('roles_role_id_foreign');
                $table->dropColumn('role_id');
            });
        }
    }
}
