<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratPengajuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_pengajuans', function (Blueprint $table) {
            $table->bigIncrements('id');

            // SURAT PENGAJUAN
            $table->string('employee_id');
            $table->string('jenis');
            $table->string('tempat');
            $table->string('satuan_organisasi');
            $table->date('mulai');
            $table->date('selesai');

            // SURAT ACC
            $table->string('unit_kerja')->nullable();
            $table->text('alasan')->nullable();
            $table->json('cuti_tahunan')->nullable();
            $table->string('nama_pegawai')->nullable();
            $table->string('alamat_pegawai')->nullable();
            $table->string('telepon_pegawai')->nullable();
            $table->text('atasan')->nullable();
            $table->text('pejabat_berwenang')->nullable();
            $table->text('header')->nullable();

            $table->string('status')->nullable();
            $table->string('approved')->nullable();
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
        Schema::dropIfExists('surat_pengajuans');
    }
}
