<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserRegStd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // public function up()
    // {
    //     Schema::create('user_regStd', function (Blueprint $table) {
    //         $table->increments('id')->unsigned();
    //         $table->unsignedBigInteger('user_id')->unsigned()->index();
    //         $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
    //         $table->unsignedBigInteger('reg_std_id')->unsigned()->index();
    //         $table->foreign('reg_std_id')->references('id')->on('reg_stds')->onDelete('cascade');
    //         $table->softDeletes();
    //     });
    // }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_regStd');
    }
}
