<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecondarySchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secondary_schools', function (Blueprint $table) {
            $table->id();
            $table->string('school_id', 255);
            $table->string('name', 255);
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('type', ['unity-school', 'non-unity-school']);
            $table->string('state');
            $table->string('lga');
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
        Schema::dropIfExists('secondary_schools');
    }
}
