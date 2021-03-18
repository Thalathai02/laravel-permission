<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointTest100sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_test100s', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('project_id_point_test100');
            $table->foreign('project_id_point_test100')->references('id')->on('projects')->onDelete('cascade');

            $table->unsignedInteger('id_instructor_point_test100');
            $table->foreign('id_instructor_point_test100')->references('id')->on('teachers')->onDelete('cascade');

            $table->int('point_test100');

            $table->unsignedInteger('reg_id_point_test100');
            $table->foreign('reg_id_point_test100')->references('id')->on('reg_stds')->onDelete('cascade');

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
        Schema::dropIfExists('point_test100s');
    }
}
