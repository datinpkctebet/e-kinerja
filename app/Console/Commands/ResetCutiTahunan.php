<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;

class ResetCutiTahunan extends Command
{
    protected $signature = 'cuti:reset-tahunan';
    protected $description = 'Reset total cuti setiap awal tahun dan simpan sisa ke total_penangguhan_cuti';

    public function handle()
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            if ($employee->total_cuti < 0) {
                // Jika cuti minus → tidak ada penangguhan
                $employee->total_penangguhan_cuti = 0;

                // Hitung cuti baru dikurangi saldo minus
                $employee->total_cuti = 12 + $employee->total_cuti; // karena total_cuti negatif
                if ($employee->total_cuti < 0) {
                    $employee->total_cuti = 0; // jaga-jaga biar tidak minus lagi
                }
            } else {
                // Jika cuti masih sisa → pindahkan ke penangguhan (maks 6)
                // $employee->total_penangguhan_cuti = min($employee->total_cuti, 6);
                $employee->total_penangguhan_cuti = $employee->total_cuti;

                // Reset cuti tahunan = 12
                $employee->total_cuti = 12;
            }

            $employee->save();
        }

        $this->info("Total cuti berhasil direset untuk semua karyawan.");
    }
}
