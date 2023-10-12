<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentSurveiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_surveies', function (Blueprint $table) {
            $table->id();
            $table->enum('interested', ['very interested', 'somewhat interested', 'not interested']);
            $table->enum('scale_of_1-5', ['1','2', '3', '4', '5']);
            $table->enum('opportunity', ['yes', 'no', 'yes but I was not interested']);
            $table->enum('ability', ['very confident', 'somewhat confident', 'not confident']);
            $table->enum('prefer', ['reading and writing', 'waching vidoes and animations', 'listening and speaking']);
            $table->enum('schools_app', ['very excited','somewhat excited','Not excited']);
            $table->string('motivates');
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
        Schema::dropIfExists('student_surveies');
    }
}
