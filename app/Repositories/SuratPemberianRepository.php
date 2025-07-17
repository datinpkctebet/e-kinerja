<?php namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Repositories\Contracts\SuratPemberianInterface;

use App\Models\SuratPemberian;

class SuratPemberianRepository extends AbstractRepository implements SuratPemberianInterface
{
    public function __construct(SuratPemberian $surat_pemberians)
    {
        $this->model = $surat_pemberians;
    }

    /**
    * Get list pemberian cuti with filter and paginate
    *
    * @param array $param
    * @return Object
    */
    public function findWithPaginate(array $param)
    {
        $perpage = $param['perpage'] ?? 10;
        // $search = $param['search'] ?? '';

        $data = $this->model->orderBy('created_at', 'DESC');

        // if (!empty($search)) {
        //     $data->where('name', 'like', '%'. $search .'%');
        // }

        $data = $data->paginate($perpage);

        // if (!empty($search)) {
        //     $data->appends([
        //         'search' => $search,
        //     ]);
        // }

        return $data;
    }

    /**
    * Create Judul list
    * @return Object
    */
    public function surat()
    {
        return [
            'SURAT CUTI TAHUNAN',
            'SURAT CUTI MELAHIRKAN',
            'SURAT CUTI BESAR',
            'SURAT CUTI SAKIT',
            'SURAT CUTI KARENA ALASAN PENTING',
            'SURAT CUTI DI LUAR TANGGUNGAN NEGARA',
        ];
    }

    public function judul()
    {
        return [
            'Cuti Tahunan',
            'Cuti Melahirkan',
            'Cuti Besar',
            'Cuti Sakit',
            'Cuti Karena Alasan Penting',
            'Cuti di luar Tanggungan Negara',
        ];
    }

    public function tahun()
    {
        return [
            '2020',
            '2021',
            '2022',
            '2023',
            '2024',
            '2025',
        ];
    }


    public function status()
    {
        return [
            'PNS',
            'Non PNS',
            'Kontrak',
            'PJLP',
            'Non-PNS Tetap'
        ];
    }


}
