<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAtasan1ToSuratPengajuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surat_pengajuans', function (Blueprint $table) {
            $table->text('alasan1')->after('alasan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surat-pengajuans', function (Blueprint $table) {
            $table->dropColumn('alasan1');
        });
    }
}
