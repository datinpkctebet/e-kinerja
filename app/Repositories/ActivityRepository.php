<?php namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Repositories\Contracts\ActivityInterface;

use App\Models\Activity;

class ActivityRepository extends AbstractRepository implements ActivityInterface
{
    public function __construct(Activity $activity)
    {
        $this->model = $activity;
    }

    /**
    * Get total vol today
    *
    * @param array $param
    * @return int
    */
    public function sumVolToday(array $param)
    {
        $date = $param['date'];
        $employee_id = $param['employee_id'];
        $activity_id = $param['activity_id'] ?? '';

        $data = Activity::where(function ($query)  use ($employee_id, $date)  {
                $query->where('employee_id', $employee_id)
                      ->where('date', $date);
                });

        if (!empty($activity_id)) {
            $data = $data->where('id', '<>', $activity_id);
        }

        $data = $data->sum('vol');

        return $data;
    }

    /**
    * Get total vol this month
    *
    * @param array $param
    * @return int
    */
    public function sumVolMonth(array $param)
    {
        $month = $param['month'];
        $year = $param['year'];
        $employee_id = $param['employee_id'];

        $data = Activity::orderBy('date', 'DESC')
                ->where(function ($query) {
                    $query->where('status', 1)
                          ->orWhere('status', null);
                    })
                ->where('employee_id', $employee_id)
                ->whereMonth('date', $month)
                ->whereYear('date', $year)
                ->sum('vol');

        return $data;
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
        $employee_id = $param['employee_id'];

        $data = Activity::orderBy('date', 'DESC')
                ->where('employee_id', $employee_id)
                ->whereMonth('date', $month)
                ->whereYear('date', $year);

        $data = $data->paginate($perpage);

        $data->appends([
            'month' => $month,
            'year' => $year,
        ]);
        

        return $data;
    }

    /**
    * export activity with filter month and year
    *
    * @param array $param
    * @return Object
    */
    public function export(array $param)
    {
        $month = $param['month'];
        $year = $param['year'];
        $employee_id = session('employee')['id'];

        $data = Activity::orderBy('date', 'ASC')
                ->where('employee_id', $employee_id)
                ->whereMonth('date', $month)
                ->whereYear('date', $year)
                ->where('status', 1)
                ->get();

        return $data;
    }

    /**
    * Get list month
    *
    * @return array
    */
    public function listMonth()
    {
        return [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
    }

    /**
    * Get list year
    *
    * @return array
    */
    public function listYear()
    {
        return [
            '2018',
            '2019',
            '2020',
            '2021',
            '2022',
            '2023',
            '2024',
            '2025',
            '2026',
            '2027',
            '2028',
            '2029',
            '2030',
        ];
    }
}
