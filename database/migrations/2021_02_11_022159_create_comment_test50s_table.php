<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentTest50sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_test50s', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('project_id_comemt_test50')->nullable();
            $table->foreign('project_id_comemt_test50')->references('id')->on('projects')->onDelete('cascade');

            $table->unsignedInteger('id_instructor_comemt_test50')->nullable();
            $table->foreign('id_instructor_comemt_test50')->references('id')->on('teachers')->onDelete('cascade');

            $table->text('text_comemt_test50');
            $table->integer('action_comemt_test50');
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
        Schema::dropIfExists('comment_test50s');
    }
}
