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
            $table->id('id');
            $table->softDeletes();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('username');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedInteger('reg_std_id')->nullable();
            $table->foreign('reg_std_id')->references('id')->on('reg_stds')->onDelete('cascade');
            $table->unsignedInteger('reg_tea_id')->nullable();
            $table->foreign('reg_tea_id')->references('id')->on('reg_tea')->onDelete('cascade');
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
