<?php

namespace App\Http\Controllers;

use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Repositories\PenilaianRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\ActivityRepository;

class PenilaianController extends Controller
{
    public function __construct(
        PenilaianRepository $penilaian,
        QuestionRepository $question,
        EmployeeRepository $employee,
        ActivityRepository $activity
    )
    {
        $this->model = $penilaian;
        $this->question = $question;
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
            'privilege' => 'Pegawai',
            'unit_kerja' => session('employee')['unit_kerja'],
            'month' => $request->input('month') ?? $now->month,
            'year' => $request->input('year') ?? $now->year,
            'table' => 'penilaians',
            'field' => 'date',
        ];

        $data = [
            'list' => $this->employee->findWithPaginate($param),
            'month' => $this->activity->listMonth(),
            'year' => $this->activity->listYear(),
            'now' => $now,
            'input' => $request->input(),
        ];

        return view('pages.penilaian.listPenilaian', $data);
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
            $list = $this->model->find($id);
        }

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'employee_id' => 'bail|required',
                'score' => 'bail|required',
            ]);

            if ($validator->fails()) {
                $error_message = $validator->errors()->all()[0];
            } else {
                $data = [
                    'employee_id' => $request->input('employee_id'),
                    'date' => minusMonth(),
                    'score' => $request->input('score'),
                    'created_by' => session('employee')['id'],
                ];

                if ($id) {
                    $insert = $this->model->update($id, $data);
                    $message = 'Penilaian berhasil diubah.';
                } else {
                    $insert = $this->model->create($data);
                    $message = 'Penilaian berhasil ditambahkan.';
                }

                $request->session()->flash('success_message', $message);
            }
        }

        $now = Carbon::now();
        $param = [
            'month' => $request->input('month') ?? $now->month,
            'year' => $request->input('year') ?? $now->year,
        ];

        $cacheTime = 3600 * +env('CACHE_TIME', 24);
        $cacheName = 'employee-by-unit-'. session('employee')['unit_kerja'] .'-'. $param['month'] .'-'. $param['year'];
        $employee = \Cache::remember($cacheName, $cacheTime, function () use ($param) {
            return $this->employee->getEmployeeByUnit($param);
        });

        $data = [
            'list' => $list,
            'question' => $this->question->get(),
            'employee' => $employee,
            'error_message' => $error_message,
            'input' => $request->input(),
        ];

        return view('pages.penilaian.formPenilaian', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data['updated_by'] = session('employee')['id'];

        $this->model->update($id, $data);

        $this->model->destroy($id);

        return \Response::json();
    }
}
