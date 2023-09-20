<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignedModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assigned_modules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('class_id');
            $table->string('teacher_id');
            $table->integer('school_id');
            $table->uuid('module');
            $table->date('deadline');
            $table->integer('time');
            $table->integer('no_attempt');
            $table->boolean('notification')->default(false);
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
        Schema::dropIfExists('assigned_modules');
    }
}
