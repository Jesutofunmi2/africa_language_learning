<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherSurveiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_surveies', function (Blueprint $table) {
            $table->id();
            $table->string('years');
            $table->string('hours');
            $table->string('challenges');
            $table->string('opinion');
            $table->string('resources');
            $table->string('confident');
            $table->string('method');
            $table->string('tools');
            $table->string('strategies');
            $table->string('familiar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.a
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_surveies');
    }
}
