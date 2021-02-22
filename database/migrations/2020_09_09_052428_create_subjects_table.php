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
            $table->text('name_subjects');
            $table->text('year');
            $table->text('term');
            $table->text('year_term');
            $table->text('DatePropose');
            $table->text('OutPropose');
            $table->text('Datedecide');
            $table->text('Outdecide');
            $table->text('DateComment');
            $table->text('OutComment');
            $table->text('DateSubmitProject');
            $table->text('OutSubmitProject');
            $table->text('DateDue50');
            $table->text('OutDue50');
            $table->text('DateDue100');
            $table->text('OutDue100');

            $table->text('DateComment50');
            $table->text('OutComment50');
            $table->text('DateComment100');
            $table->text('OutComment100');
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
