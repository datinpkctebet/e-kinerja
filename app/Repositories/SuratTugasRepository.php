<?php namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Repositories\Contracts\SuratTugasInterface;

use App\Models\SuratTugas;

class SuratTugasRepository extends AbstractRepository implements SuratTugasInterface
{
    public function __construct(SuratTugas $surat_tugas)
    {
        $this->model = $surat_tugas;
    }

    /**
    * Create Judul list
    * @return Object
    */
    public function judul()
    {
        return [
            'Yang bertanda tangan dibawah ini Kepala Puskesmas Tebet dengan ini menugaskan :',
            'Yang bertanda tangan dibawah ini Ka.Sub.Bag.Tata Usaha Puskesmas Tebet dengan ini menugaskan :',
        ];
    }
}