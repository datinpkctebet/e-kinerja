<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesNewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nip')->nullable();
            $table->string('nrk')->nullable();
            $table->string('name')->nullable();
            $table->string('no_seri_karpeg')->nullable();
            $table->string('alamat')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('status_perkawinan')->nullable();
            $table->string('agama')->nullable();
            $table->string('nama_pasangan')->nullable();
            $table->string('no_bpjs_kesehatan')->nullable();
            $table->integer('jumlah_anak')->nullable();
            $table->string('no_bpjs_ketenagakerjaan')->nullable();
            $table->string('no_npwp')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('no_rek')->nullable();
            $table->string('no_tlp')->nullable();
            $table->string('no_ktp')->nullable();
            $table->string('email')->nullable();
            $table->string('no_kk')->nullable();
            $table->string('status_pegawai')->nullable();
            $table->string('unit_kerja')->nullable();
            $table->string('jenis_jabatan')->nullable();
            $table->string('jabatan')->nullable();
            $table->date('kontrak_awal')->nullable();
            $table->date('kontrak_akhir')->nullable();
            $table->integer('gaji')->nullable();
            $table->date('tmt_masuk')->nullable();
            $table->integer('tunjangan')->nullable();
            $table->string('bidang')->nullable();
            $table->string('foto')->nullable();

            $table->json('pendidikans')->nullable();
            $table->json('keluargas')->nullable();
            $table->json('riwayat_jabatan')->nullable();
            $table->json('riwayat_mutasi')->nullable();
            $table->json('diklats')->nullable();
            $table->json('hukuman_disiplin')->nullable();
            $table->json('peningkatan_pendidikan')->nullable();

            $table->string('privilege')->nullable();
            $table->string('active')->nullable();
            $table->string('password')->nullable();

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
