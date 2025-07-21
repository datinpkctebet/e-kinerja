<?php

namespace App\Http\Controllers;

use Validator;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\KompetensiDiklat;
use App\Repositories\ProfessionRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KompetensiDiklatController extends Controller
{
    public function __construct(
        ProfessionRepository $profession
    )
    {
        $this->profession = $profession;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function employee(Request $request)
    {
        $jabatan =  $request->input('jabatan');
        $per_page =  $request->input('per_page') ?? 20;

        $employees = Employee::select('employees.id', 'employees.nip', 'employees.name', 'employees.jabatan')
            ->leftJoin('kompetensi_diklats', 'employees.id', '=', 'kompetensi_diklats.employee_id')
            ->selectRaw('COUNT(kompetensi_diklats.id) as total')
            ->groupBy('employees.id', 'employees.nip', 'employees.name', 'employees.jabatan')
            ->havingRaw('COUNT(kompetensi_diklats.id) > ?', [0])
            ->orderBy('total', 'DESC');

        if (!empty($jabatan)) {
            $employees->whereIn('jabatan', [(int)$jabatan]);
        }

        $employees = $employees->paginate($per_page);

        if (!empty($jabatan)) {
            $employees->appends([
                'jabatan' => $jabatan,
            ]);
        }

        $data = [
            'input' => $request->input(),
            'employees' => $employees,
            'jabatans' => $this->profession->get(),
        ];

        return view('pages.employee-kompetensi.adminEmployeeKompetensi', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function diklatByEmployee(Request $request, $employee_id)
    {
        $per_page =  $request->input('per_page') ?? 20;
        $search = $request->input('search') ?? '';

        $kompetensies = KompetensiDiklat::with(['employee'])
            ->orderBy('kompetensi_diklats.updated_at', 'DESC');
        
        if (isAdmin()) {
            $kompetensies->where('employee_id', $employee_id);
        }

        if (!empty($search)) {
            $kompetensies->where('nama_pelatihan', 'like', '%'. $search .'%');
            $kompetensies->orWhere('nama_institusi', 'like', '%'. $search .'%');
        }

        $kompetensies = $kompetensies->paginate($per_page);

        if (!empty($search)) {
            $kompetensies->appends([
                'search' => $search,
            ]);
        }

        $data = [
            'input' => $request->input(),
            'kompetensies' => $kompetensies,
            'employee_id' => $employee_id,
        ];

        return view('pages.employee-kompetensi.indexEmployeeKompetensi', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page =  $request->input('per_page') ?? 20;
        $search = $request->input('search') ?? '';

        $kompetensies = KompetensiDiklat::with(['employee'])
            ->orderBy('kompetensi_diklats.updated_at', 'DESC');
        
        if (!isAdmin()) {
            $kompetensies->where('employee_id', session('employee')['id']);
        }

        if (!empty($search)) {
            $kompetensies->where('nama_pelatihan', 'like', '%'. $search .'%');
            $kompetensies->orWhere('nama_institusi', 'like', '%'. $search .'%');
        }

        $kompetensies = $kompetensies->paginate($per_page);

        if (!empty($search)) {
            $kompetensies->appends([
                'search' => $search,
            ]);
        }

        $data = [
            'input' => $request->input(),
            'kompetensies' => $kompetensies,
        ];

        return view('pages.employee-kompetensi.indexEmployeeKompetensi', $data);
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
        $kompetensi = null;

        if ($id) {
            $kompetensi = KompetensiDiklat::find($id);
        }

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'nama_pelatihan' => 'required|string',
            ]);

            if ($validator->fails()) {
                $error_message = $validator->errors()->all()[0];
            } else {
                $data = [
                    'employee_id' => session('employee')['id'],
                    'nama_pelatihan' => $request->input('nama_pelatihan'),
                ];

                // UPLOAD FILE PDF, JPG, PNG
                if ($request->hasFile('file')) {
                    $imagePath = public_path(env('PATH_KOMPETENSI'));
                    $image = $request->file('file');
                    $fileName = Str::slug($request->input('nama_pelatihan'), '-') .
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
                    $kompetensi->update($data);
                    $message = 'Kompetensi Diklat berhasil diubah.';
                } else {
                    KompetensiDiklat::create($data);
                    $message = 'Kompetensi Diklat berhasil ditambahkan.';
                }

                return redirect('/kompetensi-diklat')->with('success_message', $message);
            }
        }

        $data = [
            'diklat' => $kompetensi,
            'error_message' => $error_message,
            'input' => $request->input(),
        ];

        return view('pages.employee-kompetensi.formEmployeeKompetensi', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function approve($id, $employee_id = null)
    {
        $kompetensi = KompetensiDiklat::find($id);
        $data = [
            'is_validated' => (string) 1,
        ];
        $kompetensi->update($data);

        $message =  'Kompetensi Diklat '. $kompetensi->name .' sudah disetujui.';

        if ($employee_id) {
            return redirect('/employee-kompetensi/'. $employee_id)->with('success_message', $message);
        }

        return redirect('/kompetensi-diklat')->with('success_message', $message);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function decline($id, $employee_id = null)
    {
        $kompetensi = KompetensiDiklat::find($id);
        $data = [
            'is_validated' => (string) 0,
        ];
        $kompetensi->update($data);

        $message =  'Kompetensi Diklat '. $kompetensi->name .' tidak disetujui.';

        if ($employee_id) {
            return redirect('/employee-kompetensi/'. $employee_id)->with('success_message', $message);
        }

        return redirect('/kompetensi-diklat')->with('success_message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KompetensiDiklat  $kompetensiDiklat
     * @return \Illuminate\Http\Response
     */
    public function destroy(KompetensiDiklat $kompetensiDiklat)
    {
        $kompetensiDiklat->delete();

        return response()->json([
            'message' => 'Kompetensi Diklat Berhasil Dihapus'
        ]);;
    }
}
