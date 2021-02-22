<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTest50sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test50s', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('Project_id_test50')->nullable();
            $table->foreign('Project_id_test50')->references('id')->on('projects')->onDelete('cascade');
            $table->DateTime('date_test50');
            $table->DateTime('end_date_test50');
            $table->text('room_test50');
            $table->string('file_test50');
            $table->text('status_test50');
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
        Schema::dropIfExists('test50s');
    }
}
