<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointTest50sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_test50s', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('project_id_point_test50');
            $table->foreign('project_id_point_test50')->references('id')->on('projects')->onDelete('cascade');

            $table->unsignedInteger('id_instructor_point_test50');
            $table->foreign('id_instructor_point_test50')->references('id')->on('teachers')->onDelete('cascade');

            $table->Integer('point_test50');

            $table->unsignedInteger('reg_id_point_test50');
            $table->foreign('reg_id_point_test50')->references('id')->on('reg_stds')->onDelete('cascade');

            $table->string('status_point_test50');
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
        Schema::dropIfExists('point_test50s');
    }
}
