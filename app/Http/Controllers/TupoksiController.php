<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Http\Request;

use App\Repositories\TupoksiRepository;

class TupoksiController extends Controller
{
    public function __construct(
        TupoksiRepository $tupoksi
    )
    {
        $this->model = $tupoksi;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($profession_id)
    {
        $data = [
            'list' => $this->model->where('profession_id', $profession_id),
            'profession_id' => $profession_id,
        ];

        return view('pages.tupoksi.listTupoksi', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $profession_id, $id = false)
    {
        $error_message  = false;
        $list = null;
        $time = [1, 2, 3, 5, 10, 15, 20, 30, 45, 60, 90, 120, 180, 240, 300];

        if ($id) {
            $list = $this->model->find($id, 'id');
        }

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'description' => 'bail|required',
                'time' => 'bail|required',
                'status' => 'bail|required',
            ]);

            if ($validator->fails()) {
                $error_message = $validator->errors()->all()[0];
            } else {
                $data = [
                    'description' => $request->input('description'),
                    'time' => $request->input('time'),
                    'status' => $request->input('status'),
                    'profession_id' => $profession_id,
                ];

                if ($id) {
                    $insert = $this->model->update($id, $data);
                    $message = 'Tupoksi berhasil diubah.';
                } else {
                    $insert = $this->model->create($data);
                    $message = 'Tupoksi berhasil ditambahkan.';
                }

                return redirect('/profession/'. $profession_id)->with('success_message', $message);
            }
        }

        $data = [
            'list' => $list,
            'time' => $time,
            'profession_id' => $profession_id,
            'error_message' => $error_message,
            'input' => $request->input(),
        ];

        return view('pages.tupoksi.formTupoksi', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($profession_id, $tupoksi_id)
    {
        $this->model->destroy($tupoksi_id);

        return \Response::json();
    }
}
