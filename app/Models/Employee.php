<?php

namespace App\Models;

use DB;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    /**
    * The collection associated with the model.
    *
    * @var string
    */
    protected $collection = 'employees';

    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = ['id'];

    /**
    * Attributes that are primary field.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
    * The attributes that hidden.
    *
    * @var array
    */
    protected $hidden = ['password'];

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['created_at', 'updated_at'];

    /**
    * The attributes that are appends.
    *
    * @var array
    */
    protected $appends = [
        'string_jenis_kelamin',
        'array_unit_kerja',
        'array_jabatan',
        'first_array_unit_kerja',
        'first_array_jabatan',
        'length_work',
        'privilege_show',
        'count_activity',
        'count_activity_validate',
        'nilai_kbk',
        'nilai_penilaian',
        'nilai_absensi',
        'nilai_total',
        'nilai_activity',
        'nilai_penyerapan',
        'int_jabatan',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        // 'activities',
        // 'penilaians',
        // 'absensis',
        // 'nilaikbks',
        // 'professions',
    ];

    /**
    * Get lenght of work attributes.
    *
    * @return string
    */
    public function getLengthWorkAttribute()
    {
        $diff_in_months = '-';

        if ($this->tmt_masuk) {
            $from = Carbon::now();
            $to = Carbon::parse($this->tmt_masuk);
            $diff_in_months = $to->diff($from)->format('%y tahun %m bulan %d hari');
        }

        return $diff_in_months;
    }

    /**
    * Get Jenis Kelamin.
    * Laki Laki | Perempuan.
    *
    * @return string
    */
    public function getStringJenisKelaminAttribute()
    {
        if ($this->jenis_kelamin === 'M') return 'Laki-Laki';

        if ($this->jenis_kelamin === 'F') return 'Perempuan';
    }

    /**
    * Get Unit Kerja from db units.
    *
    * @return string
    */
    public function getArrayUnitKerjaAttribute()
    {
        $array = [];
        $unit_kerja = explode(",", $this->unit_kerja);

        foreach ($unit_kerja as $value) {
            $data = DB::table('units')->where('id', '=', $value)
                ->first();

            if ($data) {
                array_push($array, $data->title);
            }
        }

        return $array;
    }

    /**
    * Get Unit Kerja from db units.
    *
    * @return string
    */
    public function getFirstArrayUnitKerjaAttribute()
    {
        $array = [];
        $unit_kerja = explode(",", $this->unit_kerja);

        $data = DB::table('units')
            ->where('id', '=', $unit_kerja[0])
            ->first();

        return $data;
    }

    /**
    * Get Unit Kerja from db professions.
    *
    * @return string
    */
    public function getArrayJabatanAttribute()
    {
        $array = [];
        $unit_kerja = explode(",", $this->jabatan);

        foreach ($unit_kerja as $value) {
            $data = DB::table('professions')->where('id', '=', $value)
                ->first();

            if ($data) {
                array_push($array, $data->name);
            }
        }

        return $array;
    }

    /**
    * Get First Unit Kerja from db professions.
    *
    * @return int
    */
    public function getIntJabatanAttribute()
    {
        $unit_kerja = explode(",", $this->jabatan);

        return $unit_kerja[0];
    }

    /**
    * Get Unit Kerja from db professions.
    *
    * @return string
    */
    public function getFirstArrayJabatanAttribute()
    {
        if (empty($this->jabatan)) return '-';

        $unit_kerja = explode(",", $this->jabatan);

        $data = DB::table('professions')->where('id', '=', $unit_kerja[0])->first();

        return $data->name;
    }

    /**
    * Set defaul value to Pegawai.
    *
    * @return string
    */
    public function getPrivilegeShowAttribute()
    {
        if ($this->attributes['privilege'] == "0") return 'Pegawai';

        return $this->attributes['privilege'];
    }

    /**
    * Count all activity by month and employee_id
    *
    * @param $month $employee_id
    * @return int
    */
    public function getCountActivityAttribute()
    {
        $data = $this->activities
                ->count();

        return $data;
    }

    /**
    * Count all activity by month and employee_id
    *
    * @param $month $employee_id
    * @return int
    */
    public function getCountActivityValidateAttribute()
    {
        $data = $this->activities
                ->where('status', true)
                ->count();

        return $data;
    }

    /**
    * Get Nilai Total
    *
    * @param $month $employee_id
    * @return int
    */
    public function getNilaiTotalAttribute()
    {
        return $this->nilaikbk + $this->nilai_penilaian + $this->nilai_absensi + $this->nilai_activity + $this->nilai_penyerapan;
    }

    /**
    * Get Nilai Total
    *
    * @param $month $employee_id
    * @return int
    */
    public function getNilaiPenyerapanAttribute()
    {
        return 20;
    }

    /**
    * Get Nilai KBK
    *
    * @return int
    */
    public function getNilaiKbkAttribute()
    {
        $nilai = $this->nilaikbks->last();

        // if (!isset($this->nilai->value)) return 0;

        $cal = (float) @$nilai->value / 10;

        // $cal = (int) $nilai->value;

        return ($cal >= 10) ? 10 : $cal;
    }

    /**
    * Get Penilaian
    *
    * @return int
    */
    public function getNilaiPenilaianAttribute()
    {
        $nilai = $this->penilaians->last();

        $cal = (float) @$nilai->score;

        return $cal;
    }

    /**
    * Get Nilai Absesnsis
    * 480 = 8jam x 60menit
    * {(Total hari kerja x 480) - (total telat+ pulang cepat+ sakit+ izin+ alfa } / (total hari kerja x480 ) x 30%
    *
    * @return int
    */
    public function getNilaiAbsensiAttribute()
    {
        $nilai = $this->absensis->last();
        if (empty($nilai)) return 0;

        $total_day = @$nilai->hari_kerja * 480;
        $total_minus = @$nilai->telat + @$nilai->pulang_cepat + @$nilai->sakit + @$nilai->izin + @$nilai->alfa;

        $subtotal = $total_day - $total_minus;
        if ($subtotal < 1 || $total_day < 1) return 0;

        $total = ($subtotal / $total_day) * 30;

        return round($total, 2);
    }

    /**
    * Get Nilai Activities
    *
    * @return int
    */
    public function getNilaiActivityAttribute()
    {
        if (!isset($this->professions->value)) return 0;

        $employee_vol = $this->activities->sum('vol');

        $profession_vol = (int) $this->professions->value;

        $total = ($employee_vol / $profession_vol) * 30;

        $total_round = round($total, 2);

        return ($total_round >= 30) ? 30 : $total_round;
    }

    /**
     * Get the comments for the blog post.
     */
    public function activities()
    {
        return $this->hasMany('App\Models\Activity', 'employee_id');
    }

    /**
     * Get the comments for the blog post.
     */
    public function penilaians()
    {
        return $this->hasMany('App\Models\Penilaian', 'employee_id');
    }

    /**
     * Get the comments for the blog post.
     */
    public function absensis()
    {
        return $this->hasMany('App\Models\Absensi', 'employee_id');
    }

    /**
     * Get the comments for the blog post.
     */
    public function nilaikbks()
    {
        return $this->hasMany('App\Models\NilaiKbk', 'unit', 'unit_kerja');
    }

    /**
     * Get the comments for the blog post.
     */
    public function professions()
    {
        return $this->hasOne('App\Models\Profession', 'id', 'int_jabatan');
    }

    /**
     * Get the diklats for the employee.
     */
    public function diklats()
    {
        return $this->hasMany(EmployeeDiklat::class);
    }
}
