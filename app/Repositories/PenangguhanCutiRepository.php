<?php namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Models\PenangguhanCuti;
use Illuminate\Support\Facades\DB;

class PenangguhanCutiRepository extends AbstractRepository
{
    public function __construct(PenangguhanCuti $penangguhanCuti)
    {
        $this->model = $penangguhanCuti;
    }
}

