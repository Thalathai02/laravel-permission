<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangeBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('change_boards', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('Project_id_ChangeBoard');
            $table->foreign('Project_id_ChangeBoard')->references('id')->on('projects')->onDelete('cascade');
            $table->string('old_name_president',200);          
            $table->string('old_name_director1',200);           
            $table->string('old_name_director2',200);          
            $table->unsignedInteger('new_name_president');
            $table->foreign('new_name_president')->references('id')->on('teachers')->onDelete('cascade');
            $table->unsignedInteger('new_name_director1'); 
            $table->foreign('new_name_director1')->references('id')->on('teachers')->onDelete('cascade');
            $table->unsignedInteger('new_name_director2');      
            $table->foreign('new_name_director2')->references('id')->on('teachers')->onDelete('cascade');
            $table->string('note',500);    
            $table->string('status_ChangeBoard');
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
        Schema::dropIfExists('change_boards');
    }
}
