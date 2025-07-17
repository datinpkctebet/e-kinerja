<?php namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Repositories\Contracts\PenilaianInterface;

use App\Models\Penilaian;
use App\Models\Employee;

class PenilaianRepository extends AbstractRepository implements PenilaianInterface
{
    public function __construct(Penilaian $penilaian)
    {
        $this->model = $penilaian;
    }
}
