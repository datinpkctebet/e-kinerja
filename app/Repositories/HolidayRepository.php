<?php namespace App\Repositories;

use App\Repositories\AbstractRepository;

use App\Models\Holiday;

class HolidayRepository extends AbstractRepository
{
    public function __construct(Holiday $holiday)
    {
        $this->model = $holiday;
    }

    public function findWithPaginate(array $param)
    {
        $perpage = $param['perpage'] ?? 10;

        $data = Holiday::orderBy('holidays.created_at', 'DESC');

        $data = $data->paginate($perpage);

        return $data;
    }

    public function sync()
    {
        return ['2025-01-01', '2025-05-01'];
    }
}

