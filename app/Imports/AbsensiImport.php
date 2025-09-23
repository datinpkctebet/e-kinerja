<?php

namespace App\Imports;

use App\Models\Absensi;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AbsensiImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // normalisasi employee_id
        $employee_id = isset($row['employee_id']) ? trim($row['employee_id']) : null;
        if (!$employee_id) {
            Log::warning('Import Absensi: baris dengan employee_id kosong dilewati.');
            return null;
        }

        // cari employee berdasarkan employee_id
        $employee = Employee::where('id', $employee_id)->first();
        $nip = $employee ? $employee->nip : 'N/A';

        if (!$employee) {
            Log::warning("Import Absensi: nip {$nip} tidak ditemukan di tabel employees.");
            return null; // skip baris ini
        }

        // tentukan nilai date
        if (function_exists('minusMonth')) {
            // gunakan helper jika ada
            $dateValue = minusMonth();
        } else {
            // fallback ke Carbon: gunakan tanggal 1 bulan lalu (ubah sesuai kebutuhan)
            $dateValue = Carbon::now()->subMonth()->startOfMonth();
        }

        // Data yang akan di-save / update
        $data = [
            'employee_id'  => $employee->id,
            'date'         => $dateValue->toDateString(),
            'hari_kerja'   => (int) $row['hari_kerja'] ?? 0,
            'telat'        => (int) $row['telat'] ?? 0,
            'pulang_cepat' => (int) $row['pulang_cepat'] ?? 0,
            'sakit'        => (int) $row['sakit'] ?? 0,
            'izin'         => (int) $row['izin'] ?? 0,
            'alfa'         => (int) $row['alfa'] ?? 0,
        ];

        // cari absensi berdasarkan employee_id + date
        $absensi = Absensi::where('employee_id', $employee->id)->where('date', 'like', $dateValue->format('Y-m') . '%')->first();

        if ($absensi) {
            // Kalau ada → update dan return null (agar importer TIDAK mencoba insert lagi)
            $absensi->update($data);
            return null;
        }

        // Kalau belum ada → return model baru, importer akan melakukan insert
        return new Absensi($data);
    }
}
