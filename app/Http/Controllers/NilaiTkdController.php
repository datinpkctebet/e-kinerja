<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Repositories\EmployeeRepository;
use App\Repositories\ActivityRepository;

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
            'now' => $now,
        ];

        return view('pages.nilai-tkd.listNilaiTkd', $data);
    }
}
