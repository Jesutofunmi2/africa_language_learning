<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_id')->nullable()->unique();
            $table->string('school_id', 255);
            $table->string('name', 255);
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('address');
            $table->string('image_url');
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
        Schema::dropIfExists('teachers');
    }
}
