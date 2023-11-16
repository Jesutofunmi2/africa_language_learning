<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddScaleOf15ToStudentSurveies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_surveies', function (Blueprint $table) {
            $table->enum('scale_of_1_5', ['1','2', '3', '4', '5']);
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
            $table->dropColumn('scale_of_1-5');
        });
    }
}
