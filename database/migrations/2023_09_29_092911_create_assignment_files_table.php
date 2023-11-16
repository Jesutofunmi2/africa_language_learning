<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('teacher_id');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('school_id');
            $table->string('media_url');
            $table->string('deadline');
            $table->integer('mark');
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
        Schema::dropIfExists('assignment_files');
    }
}
