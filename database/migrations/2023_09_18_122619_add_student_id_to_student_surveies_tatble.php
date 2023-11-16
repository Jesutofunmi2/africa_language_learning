<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStudentIdToStudentSurveiesTatble extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_surveies', function (Blueprint $table) {
            $table->string('student_id');
            $table->string('school_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_surveies', function (Blueprint $table) {
            $table->dropColumn('student_id');
            $table->dropColumn('school_id');
        });
    }
}
