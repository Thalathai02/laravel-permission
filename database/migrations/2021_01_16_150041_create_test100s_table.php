<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTest100sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test100s', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('Project_id_test100')->nullable();
            $table->foreign('Project_id_test100')->references('id')->on('projects')->onDelete('cascade');
            $table->DateTime('date_test100');
            $table->DateTime('end_date_test100');
            $table->string('room_test100');
            $table->string('file_test100');
            $table->string('status_test100');
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
        Schema::dropIfExists('test100s');
    }
}
