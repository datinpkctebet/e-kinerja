<?php namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Repositories\Contracts\AbsensiInterface;

use App\Models\Absensi;

class AbsensiRepository extends AbstractRepository implements AbsensiInterface
{
    public function __construct(Absensi $abnsesi)
    {
        $this->model = $abnsesi;
    }
}
