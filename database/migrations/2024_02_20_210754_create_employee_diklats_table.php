<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeDiklatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_diklats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employee_id');
            $table->string('nama_pelatihan');
            $table->string('nama_institusi');
            $table->string('lokasi_kota');
            $table->enum('akreditasi', ['A', 'B', 'C', 'D', 'E'])->nullable();            ;
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('jenis_diklat');
            $table->string('no_sertifikat')->nullable();
            $table->integer('jpl_diklat'); 
            $table->string('file')->nullable(); 
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
        Schema::dropIfExists('employee_diklats');
    }
}
