<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRejectTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reject_tests', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('project_id_reject_tests');
            $table->foreign('project_id_reject_tests')->references('id')->on('projects')->onDelete('cascade');
            
            $table->integer('test_id');

            $table->unsignedInteger('id_user_reject_tests');
            $table->foreign('id_user_reject_tests')->references('id')->on('users')->onDelete('cascade');

            $table->text('comment_reject_tests');
            
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
        Schema::dropIfExists('reject_tests');
    }
}
