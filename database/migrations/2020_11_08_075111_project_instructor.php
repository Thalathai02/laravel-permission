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

            $table->unsignedInteger('id_instructor')->nullable();
            $table->foreign('id_instructor')->references('id')->on('teachers')->onDelete('cascade');

            $table->text('Is_director')->default(0);
            $table->text('Is_president')->default(0);
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
        Schema::dropIfExists('Project_Instructor');
    }
}
