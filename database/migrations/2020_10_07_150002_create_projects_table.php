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
            $table->string('name_th',500)->nullable();
            $table->string('name_en',500)->nullable();            
            $table->string('status')->nullable();
            
            $table->unsignedInteger('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->string('name_mentor')->nullable();
            $table->string('because_reject')->nullable();
            $table->string('keyword_th',300)->nullable();
            $table->string('keyword_eng',300)->nullable();
            $table->string('abstract_th',5000)->nullable();
            $table->string('abstract_eng',5000)->nullable();
            
            $table->string('number_project')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
