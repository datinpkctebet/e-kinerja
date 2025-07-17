<?php namespace App\Repositories;

use App\Repositories\AbstractRepository;

use App\Models\Profession;

class ProfessionRepository extends AbstractRepository
{
    public function __construct(Profession $profession)
    {
        $this->model = $profession;
    }
}