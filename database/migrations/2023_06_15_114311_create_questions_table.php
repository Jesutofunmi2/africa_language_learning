<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->uuid('question_id')->primary();
            $table->string('question_title');
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('course_id');
            $table->enum('answered_type', ['single', 'multiple', 'text', 'puzzle']);
            $table->integer('next_question_id');
            $table->string('media_type');
            $table->string('media_url');
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
