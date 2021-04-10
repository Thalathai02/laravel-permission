<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id('id');
            $table->string('Title_name_admin')->nullable();
            $table->string('name_admin')->nullable();
            $table->string('phone_admin')->nullable();
            $table->string('lineId_admin')->nullable();
            $table->string('email_admin')->nullable();
            $table->string('facebook_admin')->nullable();
            $table->unsignedInteger('user_id_admin');
            $table->foreign('user_id_admin')->references('id')->on('users')->onDelete('cascade');
            $table->string('avatar')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
