<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_instructors', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('Project_id');
            $table->foreign('Project_id')->references('id')->on('projects')->onDelete('cascade');

            $table->unsignedInteger('id_instructor');
            $table->foreign('id_instructor')->references('id')->on('teachers')->onDelete('cascade');

            $table->string('Is_director')->default(0);
            $table->string('Is_president')->default(0);
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
        Schema::dropIfExists('project_instructors');
    }
}
