<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Http\Request;

use App\Repositories\SuratPemberianRepository;
use App\Repositories\EmployeeRepository;

class SuratPemberianController extends Controller
{
    public function __construct(
        SuratPemberianRepository $surat_pemberians,
        EmployeeRepository $employee
    )
    {
        $this->model = $surat_pemberians;
        $this->employee = $employee;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $params = [
            'perpage' => 20,
        ];

        $data = [
            'list' => $this->model->findWithPaginate($params),
        ];

        return view('pages.pemberian-cuti2.listPemberianCuti2', $data);
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
                'surat' => 'bail|required',
                'status' => 'bail|required',
                'tahun' => 'bail|required',
                'tempatkerja' => 'bail|required',
                'organisasi' => 'bail|required',
                'selama' => 'bail|required',
                'tanggal1' => 'bail|required',
                'tanggal2' => 'bail|required',
            ]);

            if ($validator->fails()) {
                $error_message = $validator->errors()->all()[0];
            } else {
                $data = [
                    'nomor' => $request->input('nomor'),
                    'judul' => $request->input('judul'),
                    'surat' => $request->input('surat'),
                    'status' => $request->input('status'),
                    'tahun' => $request->input('tahun'),
                    'selama' => $request->input('selama'),
                    'tanggal1' => $request->input('tanggal1'),
                    'tanggal2' => $request->input('tanggal2'),
                    'peserta' => empty($request->input('peserta')) ? $request->input('peserta') : implode(",", $request->input('peserta')),
                    'tempatkerja' => $request->input('tempatkerja'),
                    'organisasi' => $request->input('organisasi'),
                    'penanggung_jawab_1' => $request->input('penanggung_jawab_1'),
                    'penanggung_jawab_2' => $request->input('penanggung_jawab_2'),
                ];

                if ($id) {
                    $insert = $this->model->update($id, $data);
                    $message = 'Surat Pemberian berhasil diubah.';
                } else {
                    $insert = $this->model->create($data);
                    $message = 'Surat Pemberian berhasil ditambahkan.';
                }

                return redirect('/pemberian-cuti2')->with('success_message', $message);
            }
        }

        $cacheTime = 3600 * +env('CACHE_TIME', 24);
        $employee = \Cache::remember('employee-select', $cacheTime, function () {
            return $this->employee->getEmployeeSelect();
        });

        $data = [
            'list' => $list,
            'judul' => $this->model->judul(),
            'surat' => $this->model->surat(),
            'status' => $this->model->status(),
            'tahun' => $this->model->tahun(),
            'employee' => $employee,
            'error_message' => $error_message,
            'input' => $request->input(),
        ];

        return view('pages.pemberian-cuti2.formPemberianCuti2', $data);
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
        $pdf = \PDF::loadView('pages.pemberian-cuti2.exportPemberianCuti2', $data);

        // return view('pages.pemberian-cuti2.exportPemberianCuti2', $data);
        // return $pdf->stream();
        return $pdf->download($name);
    }
}
