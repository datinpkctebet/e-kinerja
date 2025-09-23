<?php

namespace App\Exports;

use App\Models\Employee;
use App\Repositories\EmployeeRepository;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeeDiklatExport implements FromCollection, WithHeadings, WithMapping
{
    protected $param;

    public function __construct(array $param)
    {
        $this->param = $param;
    }

    public function collection()
    {
        // gunakan repository method getListDiklat
        $data = app(EmployeeRepository::class)->getListDiklat($this->param);

        // return collection tanpa pagination agar export semua
        return collect($data->items());
    }

    public function map($employee): array
    {
        return [
            $employee->nip,
            $employee->name,
            $employee->first_array_jabatan,
            $employee->total,
        ];
    }

    public function headings(): array
    {
        return [
            'No Pegawai',
            'Nama Pegawai',
            'Jabatan',
            'Total JPL Diklat / Year',
        ];
    }
}
