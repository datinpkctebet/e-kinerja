<?php

namespace App\Http\Controllers;

use PDF;
use Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Repositories\EmployeeRepository;
use App\Repositories\ProfessionRepository;
use App\Repositories\ActivityRepository;

class EmployeeController extends Controller
{
    public function __construct(
        EmployeeRepository $employee,
        ProfessionRepository $profession,
        ActivityRepository $activity
    )
    {
        $this->model = $employee;
        $this->profession = $profession;
        $this->activity = $activity;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter['perpage'] = 15;

        if ($request->get('search')) {
            $filter['search'] = $request->get('search');
        }

        $data = [
            'input' => $request->input(),
            'list' => $this->model->findWithPaginate($filter),
        ];

        return view('pages.employee.listEmployee', $data);
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
                'nip' => [
                    'required',
                    Rule::unique('employees', 'nip')->ignore(@$list->nip, 'nip'),
                ],
                'name' => 'bail|required',
                'password' => 'bail',
                'retype_password' => 'required_with:password|same:password',
                'privilege' => 'bail|required',
            ]);

            if ($validator->fails()) {
                $error_message = $validator->errors()->all()[0];
            } else {
                $data = [
                    'nip' => $request->input('nip'),
                    'name' => $request->input('name'),
                    'privilege' => $request->input('privilege'),
                ];

                if ($request->has('password')) {
                    $data['password'] = encryptor($request->input('password'));
                }

                if ($id) {
                    $insert = $this->model->update($id, $data);
                    $message = 'Data Pegawai berhasil diubah.';
                } else {
                    $insert = $this->model->create($data);
                    $message = 'Data Pegawai berhasil ditambahkan.';
                }

                return redirect('/employee/')->with('success_message', 'Aktifitas berhasil ditambahkan.');
            }
        }

        $data = [
            'list' => $list,
            'privilege' => $this->model->privilege(),
            'error_message' => $error_message,
            'input' => $request->input(),
        ];

        return view('pages.employee.addEmployee', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = false)
    {
        if (!$id) {
            $id = session('employee')['id'];
        }

        $employee = $this->model->find($id);

        return view('pages.employee.showEmployee', ['data' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = $this->model->find($id);

        if ($request->isMethod('post')) {
            $data = $this->updateData($request);

            $insert = $this->model->update($id, $data);

            $request->session()->flash('success_message', 'Profil berhasil diubah.');
        }

        $data = [
            'status_pegawai' => $this->model->statusPegawai(),
            'status_perkawinan' => $this->model->statusPerkawinan(),
            'jenis_jabatan' => $this->model->jenisJabatan(),
            'tingkat_hukdis' => $this->model->tingkatHukdis(),
            'hubungan' => $this->model->hubungan(),
            'religion' => $this->model->religion(),
            'education' => $this->model->education(),
            'profession' => $this->profession->get(),
            'unit' => $this->model->unit(),
            'golongan' => $this->model->golongan(),
            'privilege' => $this->model->privilege(),
            'jenis_diklat' => $this->model->jenisDiklat(),
            'list' => $employee,
        ];

        return view('pages.employee.updateEmployee', $data);
    }

    /**
     * Data employee.
     *
     * @return Array
     */
    private function updateData($request)
    {
        return [
            'id' => $request->input('id'),
            'nip' => $request->input('nip'),
            'nrk' => $request->input('nrk'),
            'name' => $request->input('name'),
            'no_seri_karpeg' => $request->input('no_seri_karpeg'),
            'alamat' => $request->input('alamat'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tgl_lahir' => $request->input('tgl_lahir'),
            'status_perkawinan' => $request->input('status_perkawinan'),
            'agama' => $request->input('agama'),
            'nama_pasangan' => $request->input('nama_pasangan'),
            'no_bpjs_kesehatan' => $request->input('no_bpjs_kesehatan'),
            'jumlah_anak' => $request->input('jumlah_anak'),
            'no_bpjs_ketenagakerjaan' => $request->input('no_bpjs_ketenagakerjaan'),
            'no_npwp' => $request->input('no_npwp'),
            'nama_ibu' => $request->input('nama_ibu'),
            'no_rek' => $request->input('no_rek'),
            'no_tlp' => $request->input('no_tlp'),
            'no_ktp' => $request->input('no_ktp'),
            'email' => $request->input('email'),
            'no_kk' => $request->input('no_kk'),
            'total_cuti' => $request->input('total_cuti'),
            'status_pegawai' => $request->input('status_pegawai'),
            'unit_kerja' => $request->input('unit_kerja'),
            'jenis_jabatan' => $request->input('jenis_jabatan'),
            'jabatan' => $request->input('jabatan'),
            'kontrak_awal' => $request->input('kontrak_awal'),
            'kontrak_akhir' => $request->input('kontrak_akhir'),
            'gaji' => $request->input('gaji'),
            'tmt_masuk' => $request->input('tmt_masuk'),
            'tunjangan' => $request->input('tunjangan'),
            'bidang' => $request->input('bidang'),
            'golongan' => $request->input('golongan'),
            'privilege' => $request->input('privilege'),
            'foto' => $request->input('foto'),

            'pendidikans' => $request->input('pendidikans'),
            'keluargas' => $request->input('keluargas'),
            'riwayat_jabatan' => $request->input('riwayat_jabatan'),
            'riwayat_mutasi' => $request->input('riwayat_mutasi'),
            'diklats' => $request->input('diklats'),
            'hukuman_disiplin' => $request->input('hukuman_disiplin'),
            'peningkatan_pendidikan' => $request->input('peningkatan_pendidikan'),
            'dokumen' => $request->input('dokumen'),
        ];
    }

    /**
     * Reset password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reset(Request $request, $id)
    {
        $error_message  = false;

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'password' => 'bail|required',
                'retype_password' => 'required_with:password|same:password',
            ]);

            if ($validator->fails()) {
                $error_message = $validator->errors()->all()[0];
            } else {
                $data['password'] = encryptor($request->input('password'));

                $insert = $this->model->update($id, $data);

                return redirect('/employee/show/'. $id)->with('success_message', 'Password berhasil diubah.');
            }
        }

        $data = [
            'list' => $this->model->find($id),
            'error_message' => $error_message,
        ];

        return view('pages.employee.resetEmployee', $data);
    }

    /**
     * Activate employee.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active($id)
    {
        $data = [
            'active' => 1,
        ];

        $insert = $this->model->update($id, $data);

        return redirect(url()->previous())->with('success_message', 'Pegawai berhasil diaktifkan.');
    }

    /**
     * Deactivate employee.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function inactive($id)
    {
        $data = [
            'active' => 0,
        ];

        $insert = $this->model->update($id, $data);

        return redirect(url()->previous())->with('success_message', 'Pegawai berhasil dinonaktifkan.');
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
     * Upload image.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response json
     */
    public function upload(Request $request)
    {
        // UPLOAD PHOTO PROFILE
        if ($request->hasFile('picture')) {
            $picturePath = public_path(env('PATH_PICTURE'));
            \File::exists($picturePath) or \File::makeDirectory($picturePath);

            $image = $request->file('picture');
            $pictureName = $image->getClientOriginalName();

            // checking there is old document or not
            // if yes, delete it first
            if(\File::isFile($picturePath.$pictureName)){
                \File::delete($picturePath.$pictureName);
            }

            $image->move($picturePath, $pictureName);
        }

        // UPLOAD DOCUMENT
        if ($request->hasFile('document')) {
            $documentPath = public_path(env('PATH_DOCUMENT'));
            \File::exists($documentPath) or \File::makeDirectory($documentPath);

            foreach ($request->file('document') as $value) {
                $documentName = $value->getClientOriginalName();

                // checking there is old document or not
                // if yes, delete it first
                if(\File::isFile($documentPath.$documentName)){
                    \File::delete($documentPath.$documentName);
                }

                $value->move($documentPath, $documentName);
            }
        }
    }

    /**
     * Export Data Diri.
     *
     * @return \Illuminate\Http\Response
     */
    public function export($id)
    {
        $data = [
            'list' => $this->model->find($id),
        ];

        $name = $data['list']['nip'] .' '. $data['list']['name'] .'.pdf';
        $pdf = PDF::loadView('pages.employee.exportEmployee', $data);

        // return view('pages.employee.exportEmployee', $data);
        return $pdf->download($name);
    }

    /**
     * Export Data Diri.
     *
     * @return \Illuminate\Http\Response
     */
    public function nilai(Request $request)
    {
        $now = Carbon::now();

        $param = [
            'employee_id' => session('employee')['id'],
            'privilege' => 'Pegawai',
            'unit_kerja' => session('employee')['unit_kerja'],
            'month' => $request->input('month') ?? $now->month,
            'year' => $request->input('year') ?? $now->year,
            'perpage' => 15,
            'field' => 'telat',
        ];

        $data = [
            'employee' => $this->model->getNilaiByEmployee($param)[0],
            'input' => $request->input(),
            'month' => $this->activity->listMonth(),
            'year' => $this->activity->listYear(),
            'now' => $now,
            'total_telat' => $this->model->getTotalAbsensiEmployeeYear($param),
        ];

        return view('pages.employee.nilaiEmployee', $data);
    }
}
