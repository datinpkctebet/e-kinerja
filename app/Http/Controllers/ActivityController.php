<?php

namespace App\Http\Controllers;

use PDF;
use Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Repositories\ActivityRepository;
use App\Repositories\TupoksiRepository;


class ActivityController extends Controller
{
    public function __construct(
        ActivityRepository $activity,
        TupoksiRepository $tupoksi
    )
    {
        $this->model = $activity;
        $this->tupoksi = $tupoksi;
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
            'table' => 'activities',
            'field' => 'date',
        ];

        $data = [
            'input' => $request->input(),
            'list' => $this->model->findWithPaginate($param),
            'total' => $this->model->sumVolMonth($param),
            'month' => $this->model->listMonth(),
            'year' => $this->model->listYear(),
            'now' => $now,
            'month_now' => $param['month'],
            'year_now' => $param['year'],
        ];

        return view('pages.activity.listActivity', $data);
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
                'date' => 'bail|required',
                'name' => 'bail|required',
                'vol' => 'bail|required',
                'description' => 'bail|required',
            ]);

            if ($validator->fails()) {
                $error_message = $validator->errors()->all()[0];
            } else {
                $data = [
                    'date' => $request->input('date'),
                    'name' => $request->input('name'),
                    'time' => $request->input('time'),
                    'start' => $request->input('start'),
                    'end' => $request->input('end'),
                    'vol' => $request->input('vol'),
                    'description' => $request->input('description'),
                    'employee_id' => session('employee')['id'],
                ];

                // UPLOAD PHOTO PROFILE
                if ($request->hasFile('image')) {
                    $imagePath = public_path(env('PATH_ACTIVITY'));
                    $image = $request->file('image');
                    $imageName = $image->getClientOriginalName();

                    // checking there is old document or not
                    // if yes, delete it first
                    if(\File::isFile($imagePath.$imageName)){
                        \File::delete($imagePath.$imageName);
                    }

                    $image->move($imagePath, $imageName);
                    $data['image'] = $imageName;
                }

                if ($id) {
                    $insert = $this->model->update($id, $data);
                    $message = 'Aktifitas berhasil diubah.';
                } else {
                    $insert = $this->model->create($data);
                    $message = 'Aktifitas berhasil ditambahkan.';
                }

                $request->session()->flash('success_message', $message);
            }
        }

        $profession = session('employee')['profession'];
        $data = [
            'list' => $list,
            'tupoksi_list' => $this->tupoksi->tupoksiList($profession),
            'error_message' => $error_message,
            'input' => $request->input(),
        ];

        return view('pages.activity.formActivity', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // DELETE IMAGE ON DIRECTORY
        $data = $this->model->find($id);

        if ($data->image) {
            $img_path = public_path(env('PATH_ACTIVITY'));
            $img_old  = $data->image;

            if(!empty($img_old)){
                if(\File::isFile($img_path.'/'.$img_old)){
                    \File::delete($img_path.'/'.$img_old);
                }
            }
        }

        // DELETE DATA
        $this->model->destroy($id);

        return \Response::json();
    }

    /**
     * Check is valid data
     * with checking max vol is 8 in same date
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response Boolean
     */
    public function checkVol(Request $request)
    {
        $param = [
            'activity_id' => $request->input('activity_id'),
            'date' => $request->input('date'),
            'employee_id' => session('employee')['id'],
        ];

        $vol = (float) $this->model->sumVolToday($param);

        return (float) $vol;
    }

    /**
     * Export Data Diri.
     *
     * @return \Illuminate\Http\Response
     */
    public function export($year, $month)
    {
        $now = Carbon::now();
        $month = $month  ?? $now->month;
        $year = $year ?? $now->year;

        $param = [
            'month' => $month,
            'year' => $year,
        ];

        $data = [
            'list' => $this->model->export($param),
        ];

        $name = session('employee')['nip'] .' '. session('employee')['name'] .' '. $month .'-'. $year .'.pdf';
        $pdf = PDF::loadView('pages.activity.exportActivity', $data);

        // return view('pages.activity.exportActivity', $data);
        // return $pdf->stream();
        return $pdf->download($name);
    }
}
