<?php namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Repositories\Contracts\EmployeeInterface;

use DB;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Absensi;
use App\Models\Employee;

class EmployeeRepository extends AbstractRepository implements EmployeeInterface
{
    public function __construct(Employee $employee)
    {
        $this->model = $employee;
        $this->employee_limit = env('EMPLOYEE_LIMIT');
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
        $search = $param['search'] ?? '';
        $unit_kerja = $param['unit_kerja'] ?? '';
        $privilege = $param['privilege'] ?? '';
        $month = $param['month'] ?? '';
        $year = $param['year'] ?? '';
        $table = $param['table'] ?? '';
        $field = $param['field'] ?? '';

        $data = Employee::orderBy('name', 'ASC');

        if (!empty($search)) {
            $data->where('name', 'like', '%'. $search .'%');
            $data->orWhere('nip', 'like', '%'. $search .'%');
        }

        if (!empty($unit_kerja)) {
            $data->where('unit_kerja', $unit_kerja);
        }

        if (!empty($privilege)) {
            $data->where('privilege', $privilege);
        }

        if (!empty($month) && !empty($year)) {
            $data->whereHas($table, function($query) use ($month, $year, $field) {
                $query->whereMonth($field, $month)
                      ->whereYear($field, $year);
            });

            $data->with([$table => function ($query) use ($month, $year, $field) {
                $query->whereMonth($field, $month)
                      ->whereYear($field, $year);
            }]);
        }

        $data = $data->paginate($perpage);

        if (!empty($search)) {
            $data->appends([
                'search' => $search,
            ]);
        }

        if (!empty($month) && !empty($year)) {
            $data->appends([
                'month' => $month,
                'year' => $year,
            ]);
        }

        return $data;
    }

    /**
    * Get list all employee filter by kapuskes
    *
    * @param array $param
    * @return Object
    */
    public function getEmployeeByUnit(array $param)
    {
        $month = $param['month'] ?? '';
        $year = $param['year'] ?? '';

        $employee = $this->model
            ->where('privilege', 'Pegawai')
            ->where('unit_kerja', session('employee')['unit_kerja'])
            ->whereDoesntHave('penilaians', function ($query) use ($month, $year) {
                $query->whereMonth('date', $month)
                      ->whereYear('date', $year);
            })
            ->limit($this->employee_limit)
            ->get();

        return $employee;
    }

    /**
    * Get list all employee filter that doesnt have absen by month
    *
    * @param array $param
    * @return Object
    */
    public function getEmployeeByAbsensi(array $param)
    {
        $month = $param['month'] ?? '';
        $year = $param['year'] ?? '';

        $employee = $this->model
            ->select('id', 'name')
            ->where('privilege', 'Pegawai')
            ->whereDoesntHave('absensis', function ($query) use ($month, $year) {
                $query->whereMonth('date', $month)
                      ->whereYear('date', $year);
            })
            ->limit($this->employee_limit)
            ->get();

        return $employee;
    }


    /**
    * Get list employee to select option
    *
    * @return Object
    */
    public function getEmployeeSelect()
    {
        return \DB::table('employees')
            ->select('id', 'name')
            ->limit($this->employee_limit)
            ->get();
    }

    /**
    * Get list all employee filter that doesnt have absen by month
    *
    * @param array $param
    * @return Object
    */
    public function getNilaiByEmployee(array $param)
    {
        $perpage = $param['perpage'] ?? 10;
        $employee_id = $param['employee_id'] ?? '';
        $unit_kerja = $param['unit_kerja'] ?? '';
        $privilege = $param['privilege'] ?? '';
        $month = $param['month'] ?? '';
        $year = $param['year'] ?? '';

        $data = Employee::orderBy('name', 'ASC');

        if (!empty($employee_id)) {
            $data->where('id', $employee_id);
        }

        if (!empty($unit_kerja)) {
            $data->where('unit_kerja', $unit_kerja);
        }

        if (!empty($privilege)) {
            $data->where('privilege', $privilege);
        }

        if (!empty($month) && !empty($year)) {
            $data->with(['activities' => function ($query) use ($month, $year) {
                $query->whereMonth('date', $month)
                      ->whereYear('date', $year)
                      ->where('status', 1);
            }]);

            $data->with(['absensis' => function ($query) use ($month, $year) {
                $query->whereMonth('date', $month)
                      ->whereYear('date', $year);
            }]);

            $data->with(['nilaikbks' => function ($query) use ($month, $year) {
                $query->whereMonth('date', $month)
                      ->whereYear('date', $year);
            }]);

            $data->with(['penilaians' => function ($query) use ($month, $year) {
                $query->whereMonth('date', $month)
                      ->whereYear('date', $year);
            }]);
        }

        $data = $data->paginate($perpage);

        if (!empty($month) && !empty($year)) {
            $data->appends([
                'month' => $month,
                'year' => $year,
            ]);
        }

        return $data;
    }

    /**
    * Get list all employee filter that doesnt have absen by month
    *
    * @param array $param
    * @return Object
    */
    public function getTotalAbsensiEmployeeYear(array $param)
    {
        $employee_id = $param['employee_id'] ?? '';
        $year = $param['year'] ?? '';
        $field = $param['field'] ?? '';

        $data = Absensi::where('employee_id', $employee_id)
            ->whereYear('date', $year)
            ->sum($field);

        return $data;
    }

    /**
    * Create religion list
    *
    * @return Object
    */
    public function religion()
    {
        return [
            'Islam',
            'Kristen',
            'Katolik',
            'Hindu',
            'Budha',
            'Konghucu',
        ];
    }

    /**
    * Create education list
    *
    * @return Object
    */
    public function education()
    {
        return [
            'SD',
            'SMP',
            'SMA',
            'D-III',
            'D-IV',
            'S-1',
            'S-2',
            'S-3',
        ];
    }

    /**
    * Create privilege list
    *
    * @return Object
    */
    public function privilege()
    {
        return [
            'Pegawai',
            'Absensi',
            "Kapuskesmas",
            "Administrator",
            "Writer",
        ];
    }

    /**
    * Get list unit
    *
    * @return Object
    */
    public function unit()
    {
        return DB::table('units')->get();
    }

    /**
    * Get status pegawai
    *
    * @return Object
    */
    public function statusPegawai()
    {
        return [
            'Kontrak',
            'Non-PNS Tetap',
            "PNS",
            "PPPK",
        ];
    }

    /**
    * Get status perkawinan
    *
    * @return Object
    */
    public function statusPerkawinan()
    {
        return [
            'Menikah',
            'Lajang',
            'Janda',
            'Duda',
        ];
    }

    /**
    * Get jenis jabatan
    *
    * @return Object
    */
    public function jenisJabatan()
    {
        return [
            'Struktural',
            'JFU',
            'JFT',
        ];
    }

    /**
    * Get tingkat hukuman disiplin
    *
    * @return Object
    */
    public function tingkatHukdis()
    {
        return [
            'Ringan',
            'Sedang',
            'Berat',
        ];
    }

    /**
    * Get hubungan keluarga
    *
    * @return Object
    */
    public function hubungan()
    {
        return [
            'Suami',
            'Istri',
            'Anak',
            'Ayah',
            'Ibu',
        ];
    }

    /**
    * Create golongan list
    *
    * @return Object
    */
    public function golongan()
    {
        return [
            '-',
            'I/a',
            'I/b',
            'I/c',
            'I/d',
            'II/a',
            'II/b',
            'II/c',
            'II/d',
            'III/a',
            'III/b',
            'III/c',
            'III/d',
            'IV/a',
            'IV/b',
            'IV/c',
            'IV/d',
            'VII',
            'IX',
            'X',
        ];
    }

    /**
    * Create jenis diklat
    *
    * @return Object
    */
    public function jenisDiklat()
    {
        return [
            'Diklat Fungsional',
            'Diklat Struktural',
            'Seminar',
            'Sosialisasi',
            'Workshop',
            'Kursus',
            'Penataran',
            'Bimbingan Teknis',
            'Struktural',
            'Manajerial',
            'Teknis',
            'Fungsional',
            'Coaching',
            'Mentoring',
            'Jarak Jauh',
            'E-Learning',
            'Belajar Mandiri',
            'Komunistas Belajar',
            'Patok Banding',
            'Lain-lain',
        ];
    }

    /**
    * Get first employee
    *
    * @return Object
    */
    public function getFirst($nip)
    {
        $data = $this->model->where('nip', $nip)->first();

        return $data;
    }
}
