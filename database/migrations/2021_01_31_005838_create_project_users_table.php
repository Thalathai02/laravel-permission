<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_users', function (Blueprint $table) {
            $table->id();
                $table->unsignedInteger('Project_id');
                $table->foreign('Project_id')->references('id')->on('projects')->onDelete('cascade');

                $table->unsignedInteger('id_reg_Std');
                $table->foreign('id_reg_Std')->references('id')->on('reg_stds')->onDelete('cascade');
    
                $table->string('isHead')->default('-');
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
        Schema::dropIfExists('project_users');
    }
}
