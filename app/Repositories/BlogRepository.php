<?php namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Repositories\Contracts\BlogInterface;

use App\Models\Blog;

class BlogRepository extends AbstractRepository implements BlogInterface
{
    public function __construct(Blog $blog)
    {
        $this->model = $blog;
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

        $data = $this->model->orderBy('updated_at', 'DESC');

        $data = $data->paginate($perpage);

        return $data;
    }
}
