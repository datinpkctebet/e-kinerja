<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFileToKarirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('karirs', function (Blueprint $table) {
            $table->text('image')->after('description')->nullable();
            $table->text('document')->after('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('karirs', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('document');
        });
    }
}
