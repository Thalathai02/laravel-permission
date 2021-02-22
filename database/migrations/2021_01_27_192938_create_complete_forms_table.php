<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompleteFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complete_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('Project_id_CompleteForm');
            $table->foreign('Project_id_CompleteForm')->references('id')->on('projects')->onDelete('cascade');
            $table->text('status_CompleteForm');
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
        Schema::dropIfExists('complete_forms');
    }
}
