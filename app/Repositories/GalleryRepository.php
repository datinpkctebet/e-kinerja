<?php namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Repositories\Contracts\GalleryInterface;

use App\Models\Gallery;

class GalleryRepository extends AbstractRepository implements GalleryInterface
{
    public function __construct(Gallery $gallery)
    {
        $this->model = $gallery;
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

        $data = $this->model->orderBy('updated_at', 'DESC');

        $data = $data->paginate($perpage);

        return $data;
    }
}
