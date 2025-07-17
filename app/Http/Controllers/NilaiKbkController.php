<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Repositories\NilaiKbkRepository;
use App\Repositories\ActivityRepository;


class NilaiKbkController extends Controller
{
    public function __construct(
        NilaiKbkRepository $tupoksi,
        ActivityRepository $activity
    )
    {
        $this->model = $tupoksi;
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
            'employee_id' => session('employee')['id'],
            'month' => $request->input('month') ?? $now->month,
            'year' => $request->input('year') ?? $now->year,
            'unit' => session('employee')['unit_kerja'],
        ];

        $data = [
            'input' => $request->input(),
            'list' => $this->model->findWithPaginate($param),
            'month' => $this->activity->listMonth(),
            'year' => $this->activity->listYear(),
            'now' => $now,
        ];

        return view('pages.nilai-kbk.listNilaiKbk', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'date' => minusMonth(),
            'value' => $request->input('value'),
            'unit' => session('employee')['unit_kerja'],
        ];

        $insert = $this->model->create($data);

        return \Response::json();
    }
}
