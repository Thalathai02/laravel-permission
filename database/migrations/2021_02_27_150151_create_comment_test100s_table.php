<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentTest100sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_test100s', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('project_id_comemt_test100');
            $table->foreign('project_id_comemt_test100')->references('id')->on('projects')->onDelete('cascade');

            $table->unsignedInteger('id_instructor_comemt_test100');
            $table->foreign('id_instructor_comemt_test100')->references('id')->on('teachers')->onDelete('cascade');

            $table->text('text_comemt_test100');
            $table->integer('action_comemt_test100');
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
        Schema::dropIfExists('comment_test100s');
    }
}
