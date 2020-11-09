<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProjectInstructor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Project_Instructor', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('Project_id')->nullable();
            $table->foreign('Project_id')->references('id')->on('projects')->onDelete('cascade');

            $table->unsignedInteger('id_director1')->nullable();
            $table->foreign('id_director1')->references('id')->on('teachers')->onDelete('cascade');
            $table->unsignedInteger('id_director2')->nullable();
            $table->foreign('id_director2')->references('id')->on('teachers')->onDelete('cascade');
            $table->unsignedInteger('id_president')->nullable();
            $table->foreign('id_president')->references('id')->on('teachers')->onDelete('cascade');
            
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Project_Instructor');
    }
}
