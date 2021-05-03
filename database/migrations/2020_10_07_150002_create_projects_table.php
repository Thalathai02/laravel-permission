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
            $table->text('name_th')->nullable();
            $table->text('name_en')->nullable();            
            $table->text('status')->nullable();
            
            $table->unsignedInteger('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->text('name_mentor')->nullable();
            $table->text('because_reject')->nullable();
            $table->text('keyword_th')->nullable();
            $table->text('keyword_eng')->nullable();
            $table->text('abstract_th')->nullable();
            $table->text('abstract_eng')->nullable();
            
            $table->text('number_project')->nullable();
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
