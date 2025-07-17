<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Repositories\EmployeeRepository;
use App\Repositories\ActivityRepository;


class ValidationActivityController extends Controller
{
    public function __construct(
        EmployeeRepository $employee,
        ActivityRepository $activity
    )
    {
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
            'table' => 'activities',
            'field' => 'date',
        ];

        $data = [
            'list' => $this->employee->findWithPaginate($param),
            'month' => $this->activity->listMonth(),
            'year' => $this->activity->listYear(),
            'now' => $now,
            'input' => $request->input(),
        ];

        return view('pages.validation.listValidation', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $now = Carbon::now();

        $param = [
            'perpage' => 15,
            'employee_id' => $id,
            'month' => $request->input('month') ?? $now->month,
            'year' => $request->input('year') ?? $now->year,
        ];

        $data = [
            'list' => $this->activity->findWithPaginate($param),
            'isKapuskes' => true,
            'now' => $now,
            'month' => $this->activity->listMonth(),
            'year' => $this->activity->listYear(),
            'input' => $request->input(),
            'employee_id' => $id,
        ];

        return view('pages.activity.listActivity', $data);
    }

    /**
     * Accept activity.
     *
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accept($id)
    {
        $data = [
            'status' => 1,
        ];

        $insert = $this->activity->update($id, $data);

        return redirect(url()->previous())->with('success_message', 'Kegiatan diterima.');
    }

    /**
     * reject activity.
     *
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reject($id)
    {
        $data = [
            'status' => 2,
        ];

        $insert = $this->activity->update($id, $data);

        return redirect(url()->previous())->with('success_message', 'Kegiatan ditolak.');
    }

    public function accept_all($employee_id, Request $request)
    {
        $now = Carbon::now();
        $month = $request->input('month') ?? $now->month;
        $year = $request->input('year') ?? $now->year;

        // Validate employee_id
        if (!$employee_id) {
            return redirect(url()->previous())->with('error_message', 'Employee ID is required.');
        }

        // Validate month and year
        if (!$month || !$year) {
            return redirect(url()->previous())->with('error_message', 'Month and Year are required.');
        }

        // Update all activities for the employee
        $data = $this->activity->findWithPaginate([
            'employee_id' => $employee_id,
            'month' => $month,
            'year' => $year,
            'status' => NULL,
        ]);

        // Check if data is empty
        if (!$data || $data->isEmpty()) {
            return redirect(url()->previous())->with('error_message', 'No activities found for the specified employee and date.');
        }

        // Update status for all activities
        foreach ($data as $activity) {
            // Update the status of the activity
            $this->activity->update($activity->id, ['status' => 1]);
        }

        return redirect(url()->previous())->with('success_message', 'Semua Kegiatan diterima.');
    }
}
