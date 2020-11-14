<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project__files', function (Blueprint $table) {
            $table->id();
            $table->string('name_file')->nullable();
            $table->string('file_path')->nullable();
            $table->unsignedInteger('Project_id_File')->nullable();
            $table->foreign('Project_id_File')->references('id')->on('projects')->onDelete('cascade');
            $table->text('status_file_path')->nullable();
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
        Schema::dropIfExists('project__files');
    }
}
