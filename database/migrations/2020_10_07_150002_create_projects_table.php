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
            $table->unsignedInteger('id_regStd1')->nullable();
            $table->foreign('id_regStd1')->references('id')->on('reg_stds')->onDelete('cascade');
            $table->unsignedInteger('id_regStd2')->nullable();
            $table->foreign('id_regStd2')->references('id')->on('reg_stds')->onDelete('cascade');
            $table->unsignedInteger('id_regStd3')->nullable();
            $table->foreign('id_regStd3')->references('id')->on('reg_stds')->onDelete('cascade');
            $table->unsignedInteger('id_director1')->nullable();
            $table->foreign('id_director1')->references('id')->on('teachers')->onDelete('cascade');
            $table->unsignedInteger('id_director2')->nullable();
            $table->foreign('id_director2')->references('id')->on('teachers')->onDelete('cascade');
            $table->unsignedInteger('id_president')->nullable();
            $table->foreign('id_president')->references('id')->on('teachers')->onDelete('cascade');
            $table->text('name_mentor')->nullable();

            $table->unsignedInteger('subject_id')->nullable();
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
