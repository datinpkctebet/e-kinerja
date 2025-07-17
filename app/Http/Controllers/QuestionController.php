<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Http\Request;

use App\Repositories\QuestionRepository;

class QuestionController extends Controller
{
    public function __construct(
        QuestionRepository $question
    )
    {
        $this->model = $question;
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

        return view('pages.question.listQuestion', $data);
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
                'name' => 'bail|required',
                'category' => 'bail|required',
            ]);

            if ($validator->fails()) {
                $error_message = $validator->errors()->all()[0];
            } else {
                $data = [
                    'name' => $request->input('name'),
                    'category' => $request->input('category'),
                ];

                if ($id) {
                    $insert = $this->model->update($id, $data);
                    $message = 'Pertanyaan berhasil diubah.';
                } else {
                    $insert = $this->model->create($data);
                    $message = 'Pertanyaan berhasil ditambahkan.';
                }

                return redirect('/question/')->with('success_message', $message);
            }
        }

        $data = [
            'list' => $list,
            'category' => $this->model->category(),
            'error_message' => $error_message,
            'input' => $request->input(),
        ];

        return view('pages.question.formQuestion', $data);
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
