<?php

namespace App\Http\Controllers;

use Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Models\Holiday;
use App\Repositories\HolidayRepository;

class HolidayController extends Controller
{
    public function __construct(HolidayRepository $holiday)
    {
        $this->model = $holiday;
    }

    public function index(Request $request)
    {
        $now = Carbon::now();
        $current_year = $now->year;
        $year = $request->input('year') ?? $current_year;

        $holidays = Holiday::select('holidays.id', 'holidays.date', 'holidays.description')
            ->orderBy('holidays.date', 'ASC');

        if (!empty($year)) {
            $holidays->whereYear('holidays.date', $year);
        }

        // Get all holidays
        $data = [
            'list' => $holidays->get(),
            'input' => $request->input(),
            'years' => getListYears(),
            'current_year' => $current_year,
        ];

        return view('pages.holiday.listHoliday', $data);
    }

    public function store(Request $request, $id = false)
    {
        $error_message  = false;
        $list = null;

        if ($id) {
            $list = $this->model->find($id, 'id');
        }

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'date' => 'bail|required',
                'description' => 'bail|required',
            ]);

            if ($validator->fails()) {
                $error_message = $validator->errors()->all()[0];
            } else {
                $formatDate = \Carbon\Carbon::parse($request->input('date'))->format('Y-m-d');
                $data = [
                    'date' => $formatDate,
                    'description' => $request->input('description'),
                ];

                if ($id) {
                    $insert = $this->model->update($id, $data);
                    $message = 'Liburan berhasil diubah.';
                } else {
                    $insert = $this->model->create($data);
                    $message = 'Liburan berhasil ditambahkan.';
                }

                return redirect('/holiday')->with('success_message', $message);
            }
        }

        $data = [
            'list' => $list,
            'error_message' => $error_message,
            'input' => $request->input(),
        ];

        return view('pages.holiday.formHoliday', $data);
    }

    public function destroy($id)
    {
        $this->model->destroy($id);

        return \Response::json();
    }

    public function sync()
    {
        try {
            $this->model->sync();
            return redirect('/holiday')->with('success_message', 'Sinkronisasi telah berhasil');
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'line'  => $e->getLine(),
                'file'  => $e->getFile(),
            ], 500);
            // return redirect('/holiday')->with('error_message', $e->getMessage());
        }
    }
}
