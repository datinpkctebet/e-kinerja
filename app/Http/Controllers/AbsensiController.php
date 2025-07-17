<?php

namespace App\Http\Controllers;

use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Repositories\AbsensiRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\ActivityRepository;


class AbsensiController extends Controller
{
    public function __construct(
        AbsensiRepository $absensi,
        EmployeeRepository $employee,
        ActivityRepository $activity
    )
    {
        $this->model = $absensi;
        $this->employee = $employee;
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
            'perpage' => 15,
            'month' => $request->input('month') ?? $now->month,
            'year' => $request->input('year') ?? $now->year,
            'table' => 'absensis',
            'field' => 'date',
        ];

        $data = [
            'list' => $this->employee->findWithPaginate($param),
            'month' => $this->activity->listMonth(),
            'year' => $this->activity->listYear(),
            'now' => $now,
            'input' => $request->input(),
        ];

        return view('pages.absensi.listAbsensi', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id = false)
    {
        $error_message  = false;
        $list = null;

        if ($id) {
            $list = $this->model->find($id, 'id');
        }

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'employee_id' => 'bail|required',
            ]);

            if ($validator->fails()) {
                $error_message = $validator->errors()->all()[0];
            } else {
                $data = [
                    'employee_id' => $request->input('employee_id'),
                    'date' => minusMonth(),
                    'hari_kerja' => $request->input('hari_kerja'),
                    'telat' => $request->input('telat'),
                    'pulang_cepat' => $request->input('pulang_cepat'),
                    'sakit' => $request->input('sakit'),
                    'izin' => $request->input('izin'),
                    'alfa' => $request->input('alfa'),
                ];

                if ($id) {
                    $insert = $this->model->update($id, $data);
                    $message = 'Absensi berhasil diubah.';
                } else {
                    $insert = $this->model->create($data);
                    $message = 'Absensi berhasil ditambahkan.';
                }

                return redirect('/absensi')->with('success_message', $message);
            }
        }

        $now = Carbon::now();
        $param = [
            'month' => $request->input('month') ?? $now->month,
            'year' => $request->input('year') ?? $now->year,
        ];

        $cacheTime = 3600 * +env('CACHE_TIME', 24);
        $cacheName = 'employee-by-absensi-'. $param['month'] .'-'. $param['year'];
        $employee = \Cache::remember($cacheName, $cacheTime, function () use ($param) {
            return $this->employee->getEmployeeByAbsensi($param);
        });

        $data = [
            'list' => $list,
            'employee' => $employee,
            'error_message' => $error_message,
            'input' => $request->input(),
        ];

        return view('pages.absensi.formAbsensi', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->model->destroy($id);

        return \Response::json();
    }
}
