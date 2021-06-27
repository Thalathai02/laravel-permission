<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name_subjects');
            $table->string('year');
            $table->string('term');
            $table->string('year_term');

            $table->integer('test50');
            $table->integer('test100');
            $table->integer('presentations');
            $table->integer('Test_in_time');
            $table->integer('Internship_score');

            // $table->text('DatePropose');
            // $table->text('OutPropose');
            // $table->text('Datedecide');
            // $table->text('Outdecide');
            // $table->text('DateComment');
            // $table->text('OutComment');
            // $table->text('DateSubmitProject');
            // $table->text('OutSubmitProject');
            // $table->text('DateDue50');
            // $table->text('OutDue50');
            // $table->text('DateDue100');
            // $table->text('OutDue100');

            // $table->text('DateComment50');
            // $table->text('OutComment50');
            // $table->text('DateComment100');
            // $table->text('OutComment100');
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
        Schema::dropIfExists('subjects');
    }
}
