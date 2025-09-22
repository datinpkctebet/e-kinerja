<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsensiExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Ambil data employee yang active = 1 dan privilege = 'Pegawai'
        return DB::table('employees')
            ->where('active', 1)
            ->where('privilege', 'Pegawai')
            ->select('id', 'name')
            ->get();
    }

    public function headings(): array
    {
        return [
            'employee_id',
            'nama_pegawai',
            'hari_kerja',
            'telat',
            'pulang_cepat',
            'sakit',
            'izin',
            'alfa'
        ];
    }
}
