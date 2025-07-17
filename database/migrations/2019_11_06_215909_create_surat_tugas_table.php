<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratTugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_tugas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nomor');
            $table->string('peserta')->nullable();
            $table->string('tanggal');
            $table->string('waktu');
            $table->text('tempat');
            $table->text('acara');
            $table->string('seragam')->nullable();
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
        Schema::dropIfExists('surat_tugas');
    }
}
