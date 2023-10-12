<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->uuid('section_id')->nullable();
            $table->enum('media_type', ['image', 'video', 'audio','doc'])->nullable();
            $table->enum('type', ['sectional', 'standalone'])->default('standalone')->nullable();
            $table->mediumText('objective')->nullable();
            $table->mediumText('content')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->dropColumn('section_id');
            $table->dropColumn('media_type');
            $table->dropColumn('type');
            $table->dropColumn('objective');
            $table->dropColumn('content');
        });
    }
}
