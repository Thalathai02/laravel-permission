<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressReportTest100sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress_report_test100s', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('Project_id_report_test100');
            $table->foreign('Project_id_report_test100')->references('id')->on('projects')->onDelete('cascade');
            $table->text('status_progress_report_test100');
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
        Schema::dropIfExists('progress_report_test100s');
    }
}
