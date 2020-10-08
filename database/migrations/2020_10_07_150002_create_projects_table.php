<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->text('name_th');
            $table->text('name_en');
            $table->unsignedInteger('id_regStd1');
            $table->unsignedInteger('id_regStd2');
            $table->unsignedInteger('id_regStd3');
            $table->unsignedInteger('id_director1');
            $table->unsignedInteger('id_director2');
            $table->unsignedInteger('id_president');
            $table->text('name_mentor');

            $table->unsignedInteger('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
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
        Schema::dropIfExists('projects');
    }
}
