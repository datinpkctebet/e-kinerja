<?php

namespace App\Exports;

use App\Models\Employee;
use App\Repositories\EmployeeRepository;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class NilaiTkdExport implements FromCollection, WithHeadings, WithMapping
{
    protected $param;

    public function __construct(array $param)
    {
        $this->param = $param;
    }

    public function collection()
    {
        // gunakan repository method getNilaiByEmployee
        $data = app(EmployeeRepository::class)->getNilaiByEmployee($this->param);

        // return collection tanpa pagination agar export semua
        return collect($data->items());
    }

    public function map($employee): array
    {
        return [
            $employee->name,
            $employee->nilai_absensi,
            $employee->nilai_activity,
            $employee->nilai_kbk,
            $employee->nilai_penilaian,
            $employee->nilai_penyerapan,
            $employee->nilai_total,
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Pegawai',
            'Absensi (30%)',
            'Aktifitas (30%)',
            'KBK (10%)',
            'Penilaian (10%)',
            'Penyerapan (20%)',
            'Total (100%)',
        ];
    }
}
