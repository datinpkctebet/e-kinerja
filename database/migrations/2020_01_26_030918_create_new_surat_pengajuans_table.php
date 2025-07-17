<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewSuratPengajuansTable extends Migration
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
            $table->string('header_place')->nullable();
            $table->date('header_date')->nullable();
            $table->string('header_title')->nullable();

            $table->integer('cuti')->nullable();
            $table->text('alasan')->nullable();

            $table->integer('penanggung_jawab')->nullable();
            $table->integer('atasan')->nullable();
            $table->integer('pejabat_berwenang')->nullable();

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
