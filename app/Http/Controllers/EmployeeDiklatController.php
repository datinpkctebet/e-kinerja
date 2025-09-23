<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use Validator;
use App\Models\Employee;
use App\Models\EmployeeDiklat;
use App\Repositories\EmployeeRepository;
use App\Repositories\ProfessionRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

// export
use App\Exports\EmployeeDiklatExport;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeDiklatController extends Controller
{
    public function __construct(
        EmployeeRepository $employee,
        ProfessionRepository $profession
    )
    {
        $this->employee = $employee;
        $this->profession = $profession;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function employee(Request $request)
    {
        $now = Carbon::now();
        $current_year = $now->year;
        $year = $request->input('year') ?? $current_year;
        $jabatan =  $request->input('jabatan');
        $per_page =  $request->input('per_page') ?? 20;


        $employees = Employee::select('employees.id', 'employees.nip', 'employees.name', 'employees.jabatan')
            ->leftJoin('employee_diklats', 'employees.id', '=', 'employee_diklats.employee_id')
            ->selectRaw('employees.id, SUM(employee_diklats.jpl_diklat) as total')
            ->groupBy('employees.id', 'employees.nip', 'employees.name', 'employees.jabatan')
            ->orderBy('total', 'DESC');

        if (!empty($year)) {
            $employees->whereYear('employee_diklats.tanggal_mulai', $year);
        }

        if (!empty($jabatan)) {
            $employees->whereIn('jabatan', [(int)$jabatan]);
        }

        $employees = $employees->paginate($per_page);

        if (!empty($year)) {
            $employees->appends([
                'year' => $year,
            ]);
        }
        
        if (!empty($jabatan)) {
            $employees->appends([
                'jabatan' => $jabatan,
            ]);
        }

        $data = [
            'input' => $request->input(),
            'employees' => $employees,
            'jabatans' => $this->profession->get(),
            'years' => getListYears(),
            'current_year' => $current_year,
        ];

        return view('pages.employee-diklat.adminEmployeeDiklat', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function diklatByEmployee(Request $request, $employee_id)
    {
        $now = Carbon::now();
        $current_year = $now->year;
        $per_page =  $request->input('per_page') ?? 20;
        $search = $request->input('search') ?? '';
        $year = $request->input('year') ?? $current_year;

        $employee = Employee::find($employee_id);
        $diklats = EmployeeDiklat::where('employee_id', $employee_id);

        if (!empty($search)) {
            $diklats->where('nama_pelatihan', 'like', '%'. $search .'%');
            $diklats->orWhere('nama_institusi', 'like', '%'. $search .'%');
        }

        if (!empty($year)) {
            $diklats->whereYear('tanggal_mulai', $year);
        }

        $total = $diklats->sum('jpl_diklat');

        $diklats = $diklats->orderBy('tanggal_mulai', 'DESC')
            ->paginate($per_page);

        if (!empty($search)) {
            $diklats->appends([
                'search' => $search,
            ]);
        }

        if (!empty($year)) {
            $diklats->appends([
                'year' => $year,
            ]);
        }
     
        $data = [
            'input' => $request->input(),
            'diklats' => $diklats,
            'employee' => $employee,
            'total' => $total,
            'years' => getListYears(),
            'current_year' => $current_year,
        ];

        return view('pages.employee-diklat.indexEmployeeDiklat', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $now = Carbon::now();
        $current_year = $now->year;
        $per_page =  $request->input('per_page') ?? 20;
        $search = $request->input('search') ?? '';
        $year = $request->input('year') ?? $current_year;

        $diklats = EmployeeDiklat::where('employee_id', session('employee')['id']);

        if (!empty($search)) {
            $diklats->where('nama_pelatihan', 'like', '%'. $search .'%');
            $diklats->orWhere('nama_institusi', 'like', '%'. $search .'%');
        }

        if (!empty($year)) {
            $diklats->whereYear('tanggal_mulai', $year);
        }

        $total = $diklats->sum('jpl_diklat');

        $diklats = $diklats->orderBy('tanggal_mulai', 'DESC')
            ->paginate($per_page);

        if (!empty($search)) {
            $diklats->appends([
                'search' => $search,
            ]);
        }

        if (!empty($year)) {
            $diklats->appends([
                'year' => $year,
            ]);
        }
     
        $data = [
            'input' => $request->input(),
            'diklats' => $diklats,
            'total' => $total,
            'years' => getListYears(),
            'current_year' => $current_year,
        ];

        return view('pages.employee-diklat.indexEmployeeDiklat', $data);
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
        $diklat = null;

        if ($id) {
            $diklat = EmployeeDiklat::find($id);
        }

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'nama_pelatihan' => 'required|string',
                'nama_institusi' => 'required|string',
                'lokasi_kota' => 'required|string',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date',
                'jenis_diklat' => 'required|string',
                'jpl_diklat' => 'required|integer',
            ]);

            if ($validator->fails()) {
                $error_message = $validator->errors()->all()[0];
            } else {
                $data = [
                    'employee_id' => session('employee')['id'],
                    'nama_pelatihan' => $request->input('nama_pelatihan'),
                    'nama_institusi' => $request->input('nama_institusi'),
                    'lokasi_kota' => $request->input('lokasi_kota'),
                    'akreditasi' => $request->input('akreditasi'),
                    'tanggal_mulai' => $request->input('tanggal_mulai'), // date
                    'tanggal_selesai' => $request->input('tanggal_selesai'), // date
                    'jenis_diklat' => $request->input('jenis_diklat'),
                    'no_sertifikat' => $request->input('no_sertifikat'),
                    'jpl_diklat' => $request->input('jpl_diklat'), // integer
                ];

                // UPLOAD FILE PDF, JPG, PNG
                if ($request->hasFile('file')) {
                    $imagePath = public_path(env('PATH_DIKLAT'));
                    $image = $request->file('file');
                    $fileName = Str::slug($request->input('jenis_diklat'), '-') .
                        '_' . Str::slug($request->input('nama_pelatihan'), '-') .
                        '_' . (string) Str::uuid() .'.'. $image->extension();

                    // checking there is old document or not
                    // if yes, delete it first
                    if(\File::isFile($imagePath.$fileName)){
                        \File::delete($imagePath.$fileName);
                    }

                    $image->move($imagePath, $fileName);
                    $data['file'] = $fileName;
                }

                if ($id) {
                    $diklat->update($data);
                    $message = 'Diklat Karyawan berhasil diubah.';
                } else {
                    EmployeeDiklat::create($data);
                    $message = 'Diklat Karyawan berhasil ditambahkan.';
                }

                return redirect('/diklat')->with('success_message', $message);
            }
        }

        $data = [
            'diklat' => $diklat,
            'jenis_diklat' => $this->employee->jenisDiklat(),
            'error_message' => $error_message,
            'input' => $request->input(),
        ];

        return view('pages.employee-diklat.formEmployeeDiklat', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeDiklat  $employee_diklat
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeDiklat $employee_diklat, $id = false)
    {
        try {
            if (!$id) {
                throw new Exception('ID tidak ditemukan');
            }

            $employee_diklat = EmployeeDiklat::find($id);
            
            if (!$employee_diklat) {
                throw new Exception('Diklat Karyawan tidak ditemukan.');
            }
            
            if ($employee_diklat->employee_id != session('employee')['id']) {
                throw new Exception('Anda tidak memiliki akses untuk menghapus diklat ini.');
            }
            
            // delete record
            $delete_record = $employee_diklat->delete();
            if (!$delete_record) {
                throw new Exception('Gagal menghapus diklat Karyawan.');
            }
            
            // delete file
            $filePath = public_path(env('PATH_DIKLAT') . $employee_diklat->file);
            if (\File::isFile($filePath)) {
                $delete_file = \File::delete($filePath);
                if (!$delete_file) {
                    throw new Exception('Gagal menghapus file diklat Karyawan.');
                }
            }

            return redirect('/diklat')->with('success_message', 'Diklat Karyawan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect('/diklat')->with('error_message', 'Terjadi kesalahan saat menghapus diklat: ' . $e->getMessage());
        }
    }

    public function export($year, $jabatan)
    {
        // validasi year dan jabatan
        if(!is_numeric($year) || (!is_numeric($jabatan))) {
            return redirect('/employee-diklat')->with('error', 'Data tidak valid');
        }

        $jabatan = (int) $jabatan == 0 ? '' : (int) $jabatan;

        $now = Carbon::now();

        $param = [
            'year' => $year ?? $now->year,
            'jabatan' => $jabatan,
            'per_page' => 99999, // ambil semua data tanpa pagination
        ];
        
        // ambil nama jabatan dari tabel
        $jabatanName = DB::table('professions')->where('id', $jabatan)->value('name'); // sesuaikan kolom, bisa 'nama_jabatan'
        $jabatanName = $jabatanName ? $jabatanName : 'All';

        // export to excel
        // contoh: "Diklat-Pegawai-Dokter-2025.xlsx"
        $fileName = 'Diklat-Pegawai-' . $jabatanName . '-' . $year . '.xlsx';
        return Excel::download(new EmployeeDiklatExport($param), $fileName);
    }
}
