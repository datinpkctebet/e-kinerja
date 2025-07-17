<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Http\Request;

use App\Repositories\SuratTugasRepository;
use App\Repositories\EmployeeRepository;

class SuratTugasController extends Controller
{
    public function __construct(
        SuratTugasRepository $surat_tugas,
        EmployeeRepository $employee
    )
    {
        $this->model = $surat_tugas;
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
            'list' => $this->model->get(),
        ];

        return view('pages.surat-tugas.listSuratTugas', $data);
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
                'nomor' => 'bail|required',
                'judul' => 'bail|required',
                'tanggal' => 'bail|required',
                'waktu' => 'bail|required',
                'tempat' => 'bail|required',
                'acara' => 'bail|required',
            ]);

            if ($validator->fails()) {
                $error_message = $validator->errors()->all()[0];
            } else {
                $data = [
                    'nomor' => $request->input('nomor'),
                    'judul' => $request->input('judul'),
                    'peserta' => empty($request->input('peserta')) ? $request->input('peserta') : implode(",", $request->input('peserta')),
                    'tanggal' => $request->input('tanggal'),
                    'waktu' => $request->input('waktu'),
                    'tempat' => $request->input('tempat'),
                    'acara' => $request->input('acara'),
                    'seragam' => $request->input('seragam'),
                    'penanggung_jawab_1' => $request->input('penanggung_jawab_1'),
                    'penanggung_jawab_2' => $request->input('penanggung_jawab_2'),
                ];

                if ($id) {
                    $insert = $this->model->update($id, $data);
                    $message = 'Surat Tugas berhasil diubah.';
                } else {
                    $insert = $this->model->create($data);
                    $message = 'Surat Tugas berhasil ditambahkan.';
                }

                return redirect('/surat-tugas')->with('success_message', $message);
            }
        }

        $cacheTime = 3600 * +env('CACHE_TIME', 24);
        $employee = \Cache::remember('employee-select', $cacheTime, function () {
            return $this->employee->getEmployeeSelect();
        });

        $data = [
            'list' => $list,
            'judul' => $this->model->judul(),
            'employee' => $employee,
            'error_message' => $error_message,
            'input' => $request->input(),
        ];

        return view('pages.surat-tugas.formSuratTugas', $data);
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

    /**
     * Export Surat Tugas.
     *
     * @return \Illuminate\Http\Response
     */
    public function export($id)
    {
        $data = [
            'list' => $this->model->find($id),
        ];

        $name = $data['list']['nomor'] .' '. $data['list']['acara'] .'.pdf';
        $pdf = \PDF::loadView('pages.surat-tugas.exportSuratTugas', $data);


        // return view('pages.surat-tugas.exportSuratTugas', $data);
        // return $pdf->stream();
        return $pdf->download($name);
    }
}
