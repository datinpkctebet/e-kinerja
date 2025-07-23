<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Http\Request;

use App\Repositories\SuratPengajuanRepository;
use App\Repositories\EmployeeRepository;

class SuratPengajuanController extends Controller
{
    public function __construct(
        SuratPengajuanRepository $surat_pengajuan,
        EmployeeRepository $employee
    )
    {
        $this->model = $surat_pengajuan;
        $this->employee = $employee;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $param['perpage'] = 15;

        if (session('employee')['privilege'] === 'Pegawai') {
            $param['employee_id'] = session('employee')['id'];
        }

        // 1 TERIMA
        // 2 TOLAK
        // 3 DISETUJUI
        if (session('employee')['privilege'] === 'Administrator') {
            $param ['status'] = '';
        }

        if (session('employee')['privilege'] === 'Pustu') {
            $param = [
                'unit_kerja' => session('employee')['unit_kerja']
            ];
        }

        $data = [
            'list' => $this->model->findWithPaginate($param),
        ];

        return view('pages.surat-pengajuan.listSuratPengajuan', $data);
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

        if ($id) {
            $list = $this->model->find($id);
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            if ($id) {
                $insert = $this->model->update($id, $data);
                $message = 'Surat Pengajuan Cuti berhasil diubah.';
            } else {
                $insert = $this->model->create($data);
                $message = 'Surat Pengajuan Cuti berhasil ditambahkan.';
            }

            $request->session()->flash('success_message', $message);
        }

        $data = [
            'list' => $list,
            'jenis_cuti' => $this->model->jenisCuti(),
            'employee' => $this->employee->find(session('employee')['id']),
            'input' => $request->input(),
        ];

        return view('pages.surat-pengajuan.formSuratPengajuan', $data);
    }

    /**
     * Activate employee.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accept($id)
    {
        $data = [
            'status' => 1,
        ];

        $insert = $this->model->update($id, $data);

        return redirect(url()->previous())->with('success_message', 'Surat pengajuan cuti diterima.');
    }

    /**
     * Deactivate employee.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function decline($id)
    {
        $data = [
            'status' => 2,
        ];

        $insert = $this->model->update($id, $data);

        return redirect(url()->previous())->with('success_message', 'Surat pengajuan cuti ditolak.');
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
