<?php namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Repositories\Contracts\KarirInterface;

use App\Models\Karir;

class KarirRepository extends AbstractRepository implements KarirInterface
{
    public function __construct(Karir $karir)
    {
        $this->model = $karir;
    }

    /**
    * Get list employee with filter and paginate
    *
    * @param array $param
    * @return Object
    */
    public function findWithPaginate(array $param)
    {
        $perpage = $param['perpage'] ?? 10;
        $slug = $param['slug'] ?? '';

        if ($slug) {
            $data = $this->model->where('slug', $slug)->first();

            return $data;
        }

        $data = $this->model->orderBy('created_at', 'DESC');

        $data = $data->paginate($perpage);

        return $data;
    }
}
