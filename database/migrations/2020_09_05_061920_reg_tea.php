<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RegTea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id('id');
            $table->string('Title_name_Instructor')->nullable();
            $table->string('name_Instructor')->nullable();
            $table->string('phone_Instructor')->nullable();
            $table->string('lineId_Instructor')->nullable();
            $table->string('email_Instructor')->nullable();
            $table->string('facebook_Instructor')->nullable();
            $table->unsignedInteger('user_id_Instructor');
            $table->foreign('user_id_Instructor')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('teachers');
    }
}
