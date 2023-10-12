<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTeacherIdToTeacherSurveiesTatble extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teacher_surveies', function (Blueprint $table) {
            $table->string('teacher_id');
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
        Schema::table('teacher_surveies', function (Blueprint $table) {
            $table->dropColumn('teacher_id');
            $table->dropColumn('school_id');
        });
    }
}
