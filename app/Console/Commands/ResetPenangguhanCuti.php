<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use App\Models\PenangguhanCuti;
use Carbon\Carbon;

class ResetPenangguhanCuti extends Command
{
    protected $signature = 'cuti:reset-penangguhan';
    protected $description = 'Reset saldo penangguhan cuti sesuai aturan bulan dari tabel penangguhan_cuti';

    public function handle()
    {
        $rule = PenangguhanCuti::where('is_active', 1)->first();

        if (!$rule) {
            $this->info("Tidak ada aturan penangguhan cuti yang aktif.");
            return;
        }
        
        $limitMonth = (int) $rule->month;   // batas bulan dari DB
        $currentDate = Carbon::now();       // waktu sekarang
        
        // Tanggal reset = 1 bulan setelah batas bulan
        $resetDate = Carbon::create($currentDate->year, $limitMonth, 1, 0, 0, 0)->addMonth();

        if ($currentDate->greaterThanOrEqualTo($resetDate)) {
            // Reset semua saldo penangguhan cuti
            Employee::query()->update(['total_penangguhan_cuti' => 0]);

            $this->info("Saldo penangguhan cuti berhasil direset pada {$resetDate->format('d-m-Y H:i:s')}.");
        } else {
            $this->info("Belum waktunya reset. Reset akan dilakukan pada {$resetDate->format('d-m-Y H:i:s')}.");
        }
    }
}
