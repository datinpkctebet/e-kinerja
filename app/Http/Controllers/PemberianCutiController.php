<?php

namespace App\Http\Controllers;

use PDF;
use Validator;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Repositories\SuratPengajuanRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\SetupRepository;

class PemberianCutiController extends Controller
{
    public function __construct(
        SuratPengajuanRepository $surat_pengajuan,
        EmployeeRepository $employee,
        SetupRepository $setup
    )
    {
        $this->surat_pengajuan = $surat_pengajuan;
        $this->employee = $employee;
        $this->setup = $setup;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $param['perpage'] = 15;

        // 1 TERIMA
        // 2 TOLAK
        // 3 DISETUJUI
        if (session('employee')['privilege'] === 'Administrator') {
            $param ['status'] = '3,4';
        }

        if (session('employee')['privilege'] === 'Pustu') {
            $param = [
                'status' => '4',
                'unit_kerja' => session('employee')['unit_kerja']
            ];
        }

        $data = [
            'list' => $this->surat_pengajuan->findWithPaginate($param),
        ];

        return view('pages.pemberian-cuti.listPemberianCuti', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id = false)
    {
        $list = null;
        $error_message = false;

        if ($id) {
            $list = $this->surat_pengajuan->find($id);
        }

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'header_place' => 'bail|required',
                'header_date' => 'bail|required',
                'header_title' => 'bail|required',
                'penanggung_jawab' => 'bail|required',
                'atasan' => 'bail|required',
                'atasan1' => 'bail|required',
                'pejabat_berwenang' => 'bail|required',
            ]);


            if ($validator->fails()) {
                $error_message = $validator->errors()->all()[0];
            } else {
                // Set admin to acc surat pemberian cuti
                $data = $request->all();
                $data['status'] = 3;

                $insert = $this->surat_pengajuan->update($id, $data);
                $message = 'Pemberian Cuti berhasil diubah.';

                return redirect('/pemberian-cuti')->with('success_message', $message);
            }
        }

        $cacheTime = 3600 * +env('CACHE_TIME', 24);
        $employee = \Cache::remember('employee-select', $cacheTime, function () {
            return $this->employee->getEmployeeSelect();
        });

        $data = [
            'list' => $list,
            'employee' => $this->employee->find($list->employee_id),
            'employees' => $employee,
            'atasan' => $this->setup->getByType('Atasan'),
            'atasan1' => $this->setup->getByType('Atasan1'),
            'pejabat_berwenang' => $this->setup->getByType('Pejabat Berwenang'),
            'input' => $request->input(),
            'error_message' => $error_message,

        ];

        return view('pages.pemberian-cuti.formPemberianCuti', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function lock($id)
    {
        $surat_pengajuan = $this->surat_pengajuan->find($id);

        $employee = $this->employee->find($surat_pengajuan->employee_id);

        $total_cuti = (int) $employee->total_cuti - (int) $surat_pengajuan->cuti;

        if ($total_cuti < 0) {
            $message = 'Maaf sisa cuti anda tidak mencukupi';

            return \Response::json(array(
                'code'      =>  401,
                'message'   =>  $message
            ), 401);
        }

        // UPDATE PENGAJUAN CUTI DATA
        $pengajuan = [
            'status' => 4,
        ];
        $this->surat_pengajuan->update($id, $pengajuan);

        // UPADTE EMPLOYEE DATA
        $data = [
            'total_cuti' => $total_cuti,
        ];
        $this->employee->update($employee->id, $data);

        return \Response::json();
    }

    /**
     * Export Surat Pemberian Cuti.
     *
     * @return \Illuminate\Http\Response
     */
    public function export($id)
    {
        $list = $this->surat_pengajuan->find($id);

        $data = [
            'list' => $list,
            'employee' => $this->employee->find($list->employee_id),
        ];

        $name = $data['employee']['nip'] .' '. $data['employee']['name'] .' '. $data['list']['jenis'] .'.pdf';
        $pdf = PDF::loadView('pages.pemberian-cuti.exportPemberianCuti', $data);

        // return view('pages.pemberian-cuti.exportPemberianCuti', $data);
        return $pdf->stream($name);
        // return $pdf->download($name);
    }
}
