<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Http\Request;

use App\Repositories\SetupRepository;
use App\Repositories\EmployeeRepository;

class SetupFormCutiController extends Controller
{
    public function __construct(
        SetupRepository $setup,
        EmployeeRepository $employee
    )
    {
        $this->setup = $setup;
        $this->employee = $employee;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'list' => $this->setup->formCuti(),
        ];

        return view('pages.setup-cuti.listSetupCuti', $data);
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
            $list = $this->setup->find($id, 'id');
        }

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'nama_pegawai' => 'bail|required',
                'type' => 'bail|required',
                'keterangan' => 'bail',
            ]);

            if ($validator->fails()) {
                $error_message = $validator->errors()->all()[0];
            } else {
                $data = [
                    'title' => $request->input('nama_pegawai'),
                    'type' => $request->input('type'),
                    'description' => $request->input('keterangan'),
                ];

                if ($id) {
                    $insert = $this->setup->update($id, $data);
                    $message = 'Setup Form Cuti berhasil diubah.';
                } else {
                    $insert = $this->setup->create($data);
                    $message = 'Setup Form Cuti berhasil ditambahkan.';
                }

                return redirect('/setup-form-cuti')->with('success_message', $message);
            }
        }

        $cacheTime = 3600 * +env('CACHE_TIME', 24);
        $employee = \Cache::remember('employee-select', $cacheTime, function () {
            return $this->employee->getEmployeeSelect();
        });

        $data = [
            'list' => $list,
            'employee' => $employee,
            'form_cuti_type' => $this->setup->formCutiType(),
            'error_message' => $error_message,
            'input' => $request->input(),
        ];

        return view('pages.setup-cuti.formSetupCuti', $data);
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
