<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Repositories\EmployeeRepository;
use App\Repositories\ActivityRepository;

// export
use App\Exports\NilaiTkdExport;
use Maatwebsite\Excel\Facades\Excel;

class NilaiTkdController extends Controller
{
    public function __construct(
        EmployeeRepository $employee,
        ActivityRepository $activity
    )
    {
        $this->model = $employee;
        $this->activity = $activity;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $now = Carbon::now();

        $param = [
            'privilege' => 'Pegawai',
            'unit_kerja' => session('employee')['unit_kerja'],
            'month' => $request->input('month') ?? $now->month,
            'year' => $request->input('year') ?? $now->year,
            'perpage' => 15,
        ];

        $data = [
            'employee' => $this->model->getNilaiByEmployee($param),
            'input' => $request->input(),
            'month' => $this->activity->listMonth(),
            'year' => $this->activity->listYear(),
            'month_now' => $param['month'],
            'year_now' => $param['year'],
            'now' => $now,
        ];

        return view('pages.nilai-tkd.listNilaiTkd', $data);
    }

    public function export($year, $month)
    {
        // validasi year dan month
        if(!is_numeric($year) || !is_numeric($month) || $month < 1 || $month > 12) {
            return redirect('/nilai-tkd')->with('error', 'Data tidak valid');
        }

        $now = Carbon::now();

        $param = [
            'privilege' => 'Pegawai',
            'unit_kerja' => session('employee')['unit_kerja'],
            'month' => $month ?? $now->month,
            'year' => $year ?? $now->year,
            'perpage' => 99999, // ambil semua data tanpa pagination
        ];

        // ambil nama unit kerja dari tabel
        $unitKerjaName = DB::table('units')->where('id', session('employee')['unit_kerja'])->value('title'); // sesuaikan kolom, bisa 'nama_unit'
        
        // export to excel
        // buat nama file sesuai unit kerja, bulan, tahun
        // contoh: "Puskesmas Tebet | Klaster 1-Nilai-TKD-08-2025.xlsx"
        $fileName = $unitKerjaName . '-Nilai-TKD-' . $month . '-' . $year . '.xlsx';
        return Excel::download(new NilaiTkdExport($param), $fileName);
    }
}
