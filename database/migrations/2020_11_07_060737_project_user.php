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

                $table->unsignedInteger('id_regStd1')->nullable();
                $table->foreign('id_regStd1')->references('id')->on('reg_stds')->onDelete('cascade');

                $table->unsignedInteger('id_regStd2')->nullable();
                $table->foreign('id_regStd2')->references('id')->on('reg_stds')->onDelete('cascade');

                $table->unsignedInteger('id_regStd3')->nullable();
                $table->foreign('id_regStd3')->references('id')->on('reg_stds')->onDelete('cascade');

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
