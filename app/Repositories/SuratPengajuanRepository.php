<?php namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Repositories\Contracts\SuratPengajuanInterface;

use App\Models\SuratPengajuan;

class SuratPengajuanRepository extends AbstractRepository implements SuratPengajuanInterface
{
    public function __construct(SuratPengajuan $surat_pengajuan)
    {
        $this->model = $surat_pengajuan;
    }

    /**
    * Get list surat pengajuan with filter and paginate
    *
    * @param array $param
    * @return Object
    */
    public function findWithPaginate(array $param)
    {
        $perpage = $param['perpage'] ?? 10;
        $employee_id = $param['employee_id'] ?? '';
        $status = $param['status'] ?? '';
        $unit_kerja = $param['unit_kerja'] ?? '';

        if (!empty($unit_kerja)) {
            $data = SuratPengajuan::join('employees', 'surat_pengajuans.employee_id', '=', 'employees.id')
                ->orderBy('surat_pengajuans.created_at', 'DESC')
                ->select('surat_pengajuans.*', 'employees.unit_kerja');

                
            if ($unit_kerja) {
                $data->where('employees.unit_kerja', $unit_kerja);
            }
        } else {
            $data = SuratPengajuan::orderBy('surat_pengajuans.created_at', 'DESC');
        }
            
        if ($employee_id) {
            $data->where('surat_pengajuans.employee_id', $employee_id);
        }
        
        if ($status) {
            $data->whereIn('surat_pengajuans.status', explode(',', $status));
        }

        $data = $data->paginate($perpage);

        return $data;
    }

    /**
    * Create education list
    *
    * @return Object
    */
    public function jenisCuti()
    {
        return [
            'Cuti Tahunan',
            'Cuti Besar',
            'Cuti Sakit',
            'Cuti Melahirkan',
            'Cuti Karena Alasan Penting',
            'Cuti di Luar Tanggungan Negara',
        ];
    }
}

