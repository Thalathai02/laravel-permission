<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangetopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('changetopics', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('Project_id_changetopics');
            $table->foreign('Project_id_changetopics')->references('id')->on('projects')->onDelete('cascade');
            $table->text('old_name_th');
            $table->text('old_name_en');
            $table->text('new_name_th');
            $table->text('new_name_en');     
            $table->text('note');    
            $table->text('status_changetopics');
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
        Schema::dropIfExists('changetopics');
    }
}
