<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\KarirRepository;

class KarirController extends Controller
{
    public function __construct(
        KarirRepository $karir
    )
    {
        $this->model = $karir;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $param = [
            'perpage' => 10,
        ];

        $data = [
            'list' => $this->model->findWithPaginate($param),
        ];

        return view('pages.karir.listKarir', $data);
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
                'position' => 'bail|required',
                'description' => 'bail|required',
            ]);

            if ($validator->fails()) {
                $error_message = $validator->errors()->all()[0];
            } else {
                $data = [
                    'position' => $request->input('position'),
                    'description' => $request->input('description'),
                ];

                // UPLOAD PHOTO PROFILE
                if ($request->hasFile('image')) {
                    $imagePath = public_path(env('PATH_KARIR_IMAGE'));
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


                // UPLOAD DOCUMENT
                if ($request->hasFile('document')) {
                    $documentPath = public_path(env('PATH_KARIR_DOCUMENT'));
                    $document = $request->file('document');
                    $documentName = $document->getClientOriginalName();

                    // checking there is old document or not
                    // if yes, delete it first
                    if(\File::isFile($documentPath.$documentName)){
                        \File::delete($documentPath.$documentName);
                    }

                    $document->move($documentPath, $documentName);
                    $data['document'] = $documentName;
                }

                if ($id) {
                    $data['updated_by'] = session('employee')['id'];
                    $insert = $this->model->update($id, $data);
                    $message = 'Karir berhasil diubah.';
                } else {
                    $data['slug'] = Str::slug($request->input('position'));
                    $data['created_by'] = session('employee')['id'];
                    $insert = $this->model->create($data);
                    $message = 'Karir berhasil ditambahkan.';
                }

                return redirect('/karir/')->with('success_message', $message);
            }
        }

        $data = [
            'list' => $list,
            'error_message' => $error_message,
            'input' => $request->input(),
        ];

        return view('pages.karir.formKarir', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->model->find($id);

        // DELETE IMAGE ON DIRECTORY
        if ($data->image) {
            $img_path = public_path(env('PATH_KARIR_IMAGE'));
            $img_old  = $data->image;

            if(!empty($img_old)){
                if(\File::isFile($img_path.'/'.$img_old)){
                    \File::delete($img_path.'/'.$img_old);
                }
            }
        }

        // DELETE DOCUMENT ON DIRECTORY
        if ($data->document) {
            $doc_path = public_path(env('PATH_KARIR_DOCUMENT'));
            $doc_old  = $data->document;

            if(!empty($doc_old)){
                if(\File::isFile($doc_path.'/'.$doc_old)){
                    \File::delete($doc_path.'/'.$doc_old);
                }
            }
        }

        // DELETE DATA
        $this->model->destroy($id);

        return \Response::json();
    }
}
