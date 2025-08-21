<?php

namespace App\Http\Controllers;

use Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Repositories\HolidayRepository;

class HolidayController extends Controller
{
    public function __construct(HolidayRepository $holiday)
    {
        $this->model = $holiday;
    }

    public function index()
    {
        // Get all holidays
        $data = [
            'list' => $this->model->get(),
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
        $this->model->sync();

        return redirect('/holiday')->with('success_message', 'Liburan berhasil disinkronisasi.');
    }
}
