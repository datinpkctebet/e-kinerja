<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratPemberiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_pemberians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('surat');
            $table->string('nomor');
            $table->text('judul');
            $table->string('peserta')->nullable();
            $table->text('tempatkerja');
            $table->text('organisasi');
            $table->text('selama');
            $table->text('tahun');
            $table->text('status');
            $table->text('tanggal1');
            $table->text('tanggal2');
            $table->text('penanggung_jawab_1')->nullable();
            $table->text('penanggung_jawab_2')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_pemberians');
    }
}
