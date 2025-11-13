<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKodePegawaiToEmployeesTable extends Migration
{
    /**
     * Jalankan migrasi: tambah kolom kode_pegawai ke tabel employees.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            // Tambahkan kolom kode_pegawai setelah kolom id
            $table->string('kode_pegawai', 20)->unique()->after('id');
        });
    }

    /**
     * Rollback migrasi: hapus kolom kode_pegawai.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropUnique(['kode_pegawai']);
            $table->dropColumn('kode_pegawai');
        });
    }
}
