<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Repositories\PenangguhanCutiRepository;
use App\Models\PenangguhanCuti;

class PenangguhanCutiController extends Controller
{
    public function __construct(PenangguhanCutiRepository $penangguhanCuti)
    {
        $this->model = $penangguhanCuti;
    }

    public function index()
    {
        // Get all penangguhan cuti
        $data = [
            'list' => $this->model->get(),
        ];

        return view('pages.penangguhan-cuti.listPenangguhanCuti', $data);
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
                'month' => 'bail|required|integer',
            ]);
            
            if ($validator->fails()) {
                $error_message = $validator->errors()->all()[0];
            } else {
                $is_active = $request->input('is_active') == NULL ? 0 : 1;
                $data = [
                    'month' => $request->input('month'),
                    'is_active' => $is_active,
                    'description' => $request->input('description'),
                ];

                if ($id) {
                    $insert = $this->model->update($id, $data);
                    $message = 'Penangguhan Cuti berhasil diubah.';
                } else {
                    $insert = $this->model->create($data);
                    $message = 'Penangguhan Cuti berhasil ditambahkan.';
                }

                return redirect('/penangguhan-cuti')->with('success_message', $message);
            }
        }

        $data = [
            'list' => $list,
            'error_message' => $error_message,
            'input' => $request->input(),
        ];

        return view('pages.penangguhan-cuti.formPenangguhanCuti', $data);
    }

    public function destroy($id)
    {
        $this->model->destroy($id);

        return \Response::json();
    }

    public function updateStatus(Request $request)
    {
        $id = $request->input('id');
        $is_active = $request->input('is_active');

        $data = $this->model->find($request->id);
        if ($data != NULL) {
            if ($is_active == 1) {
                // Set semua data lain jadi 0 (nonaktif)
                \App\Models\PenangguhanCuti::where('id', '!=', $id)->update(['is_active' => 0]);
            }
    
            // Update data terpilih
            $this->model->update($id, ['is_active' => $is_active]);
            return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui']);
        }

        return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
    }
}
