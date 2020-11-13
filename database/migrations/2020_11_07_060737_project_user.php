<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProjectUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
     {
            Schema::create('project_user', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('Project_id')->nullable();
                $table->foreign('Project_id')->references('id')->on('projects')->onDelete('cascade');

                $table->unsignedInteger('id_reg_Std')->nullable();
                $table->foreign('id_reg_Std')->references('id')->on('reg_stds')->onDelete('cascade');
    
                $table->text('isHead')->nullable();
                $table->text('name_mentor')->nullable();
                  
                
          });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('project_user');
    }
}
