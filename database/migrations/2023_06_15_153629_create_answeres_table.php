<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnsweresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answeres', function (Blueprint $table) {
            $table->id();
            $table->string('answered_title');
            $table->unsignedBigInteger('question_id');
            $table->string('media_type');
            $table->string('media_url');
            $table->boolean('is_correct');
            $table->timestamps();

            $table->foreign('question_id')->references('question_id')->on('questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answeres');
    }
}
