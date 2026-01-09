<?php namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Repositories\Contracts\ActivityInterface;

use App\Models\Activity;
use App\Models\Employee;

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

    public function getScheduleActivity()
    {
        // $target = strtotime('+1 month');
        $month = date('m');
        $year = date('Y');

        $data = Activity::select('activities.id', 'activities.start as start_time', 'activities.end as end_time', 'employee_id', 'employees.name as employee_name', 'tupoksis.description as tupoksis_name', 'date')
                ->join('employees', 'activities.employee_id', '=', 'employees.id')
                ->join('tupoksis', 'activities.name', '=', 'tupoksis.id')
                ->where(function ($query) {
                    $query->where('activities.status', 1)
                          ->orWhere('activities.status', null);
                    })
                ->whereMonth('date', $month)
                ->whereYear('date', $year)
                ->groupBy('activities.id', 'activities.start', 'activities.end', 'employee_id', 'employees.name', 'tupoksis.description', 'date')
                ->orderBy('employee_name', 'ASC')
                ->get();
                
        return $data;
    }

    public function getScheduleActivityToday()
    {
        $today = date('Y-m-d');
        // $today = date('2025-07-15'); // for testing purpose

        $employee_list = Employee::select('id', 'name')
            ->where('active', 1)
            ->whereRaw("nip REGEXP '^[0-9]+$'")
            ->get();
        $employee_count = $employee_list->count();

        $activities = Activity::select('activities.id', 'activities.name as activity_name', 'employee_id', 'date')
                // ->join('tupoksis', 'activities.name', '=', 'tupoksis.id')
                ->where(function ($query) {
                    $query->where('activities.status', 1)
                        ->orWhere('activities.status', null);
                })
                ->where('date', $today)
                ->orderBy('date', 'ASC')
                ->get();
        $activity_count = $activities->count();

        return [
            'date' => $today,
            'employees' => $employee_list,
            'employee_count' => $employee_count,
            'activities' => $activities,
            'activity_count' => $activity_count,
        ];
    }

    public function getScheduleActivityTodayDetails()
    {
        $date = date('Y-m-d');
        // $date = date('2025-07-15');

        $employee_list = Employee::select('id', 'name')
            ->where('active', 1)
            ->whereRaw("nip REGEXP '^[0-9]+$'")
            ->get();
        $employee_map = $employee_list->keyBy('id');

        $activities = Activity::select(
                'activities.id',
                'activities.employee_id',
                'activities.name as activity_name',
                'activities.description as activity_description'
            )
            ->where(function ($query) {
                $query->where('activities.status', 1)
                    ->orWhereNull('activities.status');
            })
            ->where('date', $date)
            ->get();
                
        return [
            'employees' => $employee_list,
            'employees_map' => $employee_map,
            'activities' => $activities,
        ];
    }
}
