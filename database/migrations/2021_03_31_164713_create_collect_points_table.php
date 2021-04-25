<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collect_points', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('reg_id_collect_points');
            $table->foreign('reg_id_collect_points')->references('id')->on('reg_stds')->onDelete('cascade');

            $table->unsignedInteger('project_id_collect_points');
            $table->foreign('project_id_collect_points')->references('id')->on('projects')->onDelete('cascade');

            $table->float('Total_point');
            $table->float('Test_in_time');
            $table->float('presentations');
            $table->string('grade');
            
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
        Schema::dropIfExists('collect_points');
    }
}
