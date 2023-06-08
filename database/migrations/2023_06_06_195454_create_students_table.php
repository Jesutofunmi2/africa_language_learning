<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->string('student_id')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('school_id')->nullable();
            $table->string('phone_number');
            $table->enum('gendar', ['male', 'female']);
            $table->string('language');
            $table->integer('age');
            $table->enum('marital_status', ['single', 'divoiced', 'taken', 'married', 'complicated'])->nullable();
            $table->string('country');
            $table->enum('how_do_you_see_us', ['Facebook', 'Twiter', 'Others'])->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('students');
    }
}
