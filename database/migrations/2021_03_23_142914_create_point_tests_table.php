<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // public function up()
    // {
    //     Schema::create('point_tests', function (Blueprint $table) {
    //         $table->id();
    //         $table->unsignedInteger('project_id_point_test');
    //         $table->foreign('project_id_point_test')->references('id')->on('projects')->onDelete('cascade');

    //         $table->unsignedInteger('id_instructor_point_test');
    //         $table->foreign('id_instructor_point_test')->references('id')->on('teachers')->onDelete('cascade');

    //         $table->Integer('point_test50')->default(0);
    //         $table->Integer('point_test100')->default(0);

    //         $table->unsignedInteger('reg_id_point_test');
    //         $table->foreign('reg_id_point_test')->references('id')->on('reg_stds')->onDelete('cascade');

    //         $table->timestamps();
    //         $table->softDeletes();
    //     });
    // }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('point_tests');
    }
}
