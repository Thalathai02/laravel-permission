<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressReportTest50sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress_report_test50s', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('Project_id_report_test50');
            $table->foreign('Project_id_report_test50')->references('id')->on('projects')->onDelete('cascade');
            $table->string('status_progress_report_test50');
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
        Schema::dropIfExists('progress_report_test50s');
    }
}
