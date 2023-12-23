<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            //common fields
            $table->string('NAME');
            $table->string('EMAIL')->unique();
            $table->string('PHONE')->nullable();
            $table->string('IMAGE')->nullable();
            $table->string('ICON')->nullable();

            $table->string('COUNTRY')->nullable();
            $table->string('CITY')->nullable();
            $table->integer('CATEGORY_ID')->nullable();

            //candidate
            $table->string('LEVEL')->nullable();
            $table->float('YEARS_EXPERIENCE')->nullable();
            $table->float('SALARY')->nullable();
            $table->mediumText('EXPERIENCE')->nullable();
            $table->mediumText('EDUCATION')->nullable();
            $table->json('SKILLS')->nullable();
            $table->json('LANGUAGES')->nullable();
            $table->mediumText('ABOUT_ME')->nullable();

            //company
            $table->integer('EMPLOYEE_CNT')->nullable();
            $table->string('WEB_SITE')->nullable();
            $table->mediumText('DESCRIPTION')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('ACTIVE')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
