<?php namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Repositories\Contracts\NilaiKbkInterface;

use App\Models\NilaiKbk;

class NilaiKbkRepository extends AbstractRepository implements NilaiKbkInterface
{
    public function __construct(NilaiKbk $nilaiKbk)
    {
        $this->model = $nilaiKbk;
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
        $month = $param['month'];
        $year = $param['year'];
        $unit = $param['unit'] ?? '';

        $data = NilaiKbk::orderBy('date', 'DESC')
                ->whereMonth('date', $month)
                ->whereYear('date', $year)
                ->where('unit', $unit);

        $data = $data->paginate($perpage);

        $data->appends([
            'month' => $month,
            'year' => $year,
        ]);

        return $data;
    }
}
