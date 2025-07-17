<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Repositories\GalleryRepository;


class GalleryController extends Controller
{
    public function __construct(
        GalleryRepository $gallery
    )
    {
        $this->model = $gallery;
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

        return view('pages.gallery.listGallery', $data);
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
                'title' => 'bail|required',
                'description' => 'bail|required',
            ]);

            if ($validator->fails()) {
                $error_message = $validator->errors()->all()[0];
            } else {
                $data = [
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                ];

                // UPLOAD GALLERY
                if ($request->input('primary_image')) {
                    // insert name to db
                    $data['primary_image'] = $request->input('primary_image');
                    $data['image'] = $request->input('image');

                    // move image from temp to gallery
                    $temp = public_path(env('PATH_TEMP')) .'/';
                    $gallery = public_path(env('PATH_GALLERY')) .'/';
                    $images = explode(',', $request->input('image'));

                    for ($i = 0; $i < count($images); $i++)
                    {
                        if(\File::isFile($temp . $images[$i]))
                        {
                            \File::move($temp . $images[$i], $gallery . $images[$i]);
                        }
                    }
                }

                if ($id) {
                    $data['updated_by'] = session('employee')['id'];
                    $insert = $this->model->update($id, $data);
                    $message = 'Gallery berhasil diubah.';
                } else {
                    $data['created_by'] = session('employee')['id'];
                    $insert = $this->model->create($data);
                    $message = 'Gallery berhasil ditambahkan.';
                }

                return redirect('/gallery/')->with('success_message', $message);
            }
        }

        $data = [
            'list' => $list,
            'error_message' => $error_message,
            'input' => $request->input(),
        ];

        return view('pages.gallery.formGallery', $data);
    }

    /**
     * Image Upload
     *
     * @return void
     */
    public function addImage(Request $request)
    {
        $image = $request->file('file');
        $imagaPath = public_path(env('PATH_TEMP'));
        $randName  = date('dmy.His') .'.'. uniqid();
        $imageName = strtoupper($randName) .'.'. $image->extension();

        $image->move($imagaPath, $imageName);

        return \Response::json($imageName);
    }

    /**
     * Image Remove
     *
     * @return void
     */
    public function removeImage($imageName)
    {
        $pathTemp = public_path(env('PATH_TEMP'));
        $pathGallery = public_path(env('PATH_GALLERY'));

        if(\File::isFile($pathTemp .'/'. $imageName)){
            \File::delete($pathTemp .'/'. $imageName);
        }

        if(\File::isFile($pathGallery .'/'. $imageName)){
            \File::delete($pathGallery .'/'. $imageName);
        }
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
            $img_path = public_path(env('PATH_GALLERY'));
            $img_old  = $data->image;
            $img_old = explode(",", $img_old);

            if(!empty($img_old)) {
                for ($i = 0; $i < count($img_old); $i++) {
                    if(\File::isFile($img_path.'/'.$img_old[$i])){
                        \File::delete($img_path.'/'.$img_old[$i]);
                    }
                }
            }
        }

        // DELETE DATA
        $this->model->destroy($id);

        return \Response::json();
    }
}
