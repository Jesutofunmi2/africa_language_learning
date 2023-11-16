<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentClassArmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_class_arms', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->integer('classes_id');
            $table->integer('classarms_id');
            $table->string('session')->nullable();
            $table->string('term')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_class_arms');
    }
}
