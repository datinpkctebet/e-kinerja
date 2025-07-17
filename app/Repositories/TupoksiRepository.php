<?php namespace App\Repositories;

use App\Repositories\AbstractRepository;

use App\Models\Tupoksi;

class TupoksiRepository extends AbstractRepository
{
    public function __construct(Tupoksi $tupoksi)
    {
        $this->model = $tupoksi;
    }

   /**
    * Get list tupoksi filter by employee jabatan
    *
    * @return Object
    */
    public function tupoksiList($profession_id)
    {
        $profession = (explode(",", $profession_id));

        $tupoksi = $this->model->orderBy('description', 'ASC');

        foreach ($profession as $id) {
            $tupoksi->orWhere('profession_id', $id);
        }

        return $tupoksi->get();
    }
}
