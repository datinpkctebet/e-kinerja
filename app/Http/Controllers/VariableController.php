<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Http\Request;

use App\Repositories\VariableRepository;

class VariableController extends Controller
{
    public function __construct(
        VariableRepository $variable
    )
    {
        $this->model = $variable;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'list' => $this->model->get(),
        ];

        return view('pages.variable.listVariable', $data);
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
                'name' => 'bail|required',
                'value' => 'bail|required',
            ]);

            if ($validator->fails()) {
                $error_message = $validator->errors()->all()[0];
            } else {
                $data = [
                    'name' => $request->input('name'),
                    'value' => $request->input('value'),
                ];

                if ($id) {
                    $insert = $this->model->update($id, $data);
                    $message = 'Variable berhasil diubah.';
                } else {
                    $insert = $this->model->create($data);
                    $message = 'Variable berhasil ditambahkan.';
                }

                return redirect('/variable/')->with('success_message', $message);
            }
        }

        $data = [
            'list' => $list,
            'error_message' => $error_message,
            'input' => $request->input(),
        ];

        return view('pages.variable.formVariable', $data);
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
