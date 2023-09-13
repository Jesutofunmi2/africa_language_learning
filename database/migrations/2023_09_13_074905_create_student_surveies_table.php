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
            $table->enum('how_interested_are_you_in_learning_nigerian_languages', ['very interested', 'somewhat interested', 'not interested']);
            $table->enum('scale_of_1-5', ['1','2', '3', '4', '5']);
            $table->enum('have_you_previously_had_the_opportunity_to_learn_nigerian_languages_in_school', ['yes', 'no', 'yes but I was not interested']);
            $table->enum('how_confident_are_you_in_your_ability_to_learn_a_new_language', ['very confident', 'somewhat confident', 'not confident']);
            $table->enum('how_do_you_prefer_to_learn_new_things', ['reading and writing', 'waching vidoes and animations', 'listening and speaking']);
            $table->enum('are_you_excited_about_using_the_izesan!_for_schools_app_for_language_learning', ['very excited','somewhat excited','Not excited']);
            $table->string('what_motivates_you_the_most_to_learn_the_most_to_learn_a_language');
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
