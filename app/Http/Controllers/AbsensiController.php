<?php

namespace App\Http\Controllers;

use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Repositories\AbsensiRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\ActivityRepository;

// import dan export
use App\Imports\AbsensiImport;
use App\Exports\AbsensiExport;
use Maatwebsite\Excel\Facades\Excel;


class AbsensiController extends Controller
{
    public function __construct(
        AbsensiRepository $absensi,
        EmployeeRepository $employee,
        ActivityRepository $activity
    )
    {
        $this->model = $absensi;
        $this->employee = $employee;
        $this->activity = $activity;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $now = Carbon::now();

        $param = [
            'perpage' => 15,
            'month' => $request->input('month') ?? $now->month,
            'year' => $request->input('year') ?? $now->year,
            'table' => 'absensis',
            'field' => 'date',
        ];

        $data = [
            'list' => $this->employee->findWithPaginate($param),
            'month' => $this->activity->listMonth(),
            'year' => $this->activity->listYear(),
            'now' => $now,
            'input' => $request->input(),
        ];

        return view('pages.absensi.listAbsensi', $data);
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
                'employee_id' => 'bail|required',
            ]);

            if ($validator->fails()) {
                $error_message = $validator->errors()->all()[0];
            } else {
                $data = [
                    'employee_id' => $request->input('employee_id'),
                    'date' => minusMonth(),
                    'hari_kerja' => $request->input('hari_kerja'),
                    'telat' => $request->input('telat'),
                    'pulang_cepat' => $request->input('pulang_cepat'),
                    'sakit' => $request->input('sakit'),
                    'izin' => $request->input('izin'),
                    'alfa' => $request->input('alfa'),
                ];

                if ($id) {
                    $insert = $this->model->update($id, $data);
                    $message = 'Absensi berhasil diubah.';
                } else {
                    $insert = $this->model->create($data);
                    $message = 'Absensi berhasil ditambahkan.';
                }

                return redirect('/absensi')->with('success_message', $message);
            }
        }

        $now = Carbon::now();
        $param = [
            'month' => $request->input('month') ?? $now->month,
            'year' => $request->input('year') ?? $now->year,
        ];

        $cacheTime = 3600 * +env('CACHE_TIME', 24);
        $cacheName = 'employee-by-absensi-'. $param['month'] .'-'. $param['year'];
        // $employee = \Cache::remember($cacheName, $cacheTime, function () use ($param) {
        //     return $this->employee->getEmployeeByAbsensi($param);
        // });

        $employee = $this->employee->getEmployeeByAbsensi($param);

        $data = [
            'list' => $list,
            'employee' => $employee,
            'error_message' => $error_message,
            'input' => $request->input(),
        ];

        return view('pages.absensi.formAbsensi', $data);
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

    public function downloadTemplate()
    {
        $fileName = 'Template_Import_Absensi.xlsx';
        return Excel::download(new AbsensiExport, $fileName);
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx,csv'
        ]);

        Excel::import(new AbsensiImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data absensi berhasil diimport!');
    }

    public function newIndex(Request $request)
    {
        $now = Carbon::now();

        $month = $request->input('month') ?? $now->month;
        $year = $request->input('year') ?? $now->year;

        // Hitung jumlah hari dalam bulan
        $daysInMonth = Carbon::create($year, $month, 1)->daysInMonth;

        // Header dan kolom untuk Handsontable
        $colHeaders = ['No', 'Nama'];
        $columns = [
            ['data' => 'kode_pegawai'],
            ['data' => 'nama'],
        ];

        for ($i = 1; $i <= $daysInMonth; $i++) {
            $colHeaders[] = (string)$i;
            $columns[] = ['data' => (string)$i];
        }

        $data = [
            'month' => $this->activity->listMonth(),
            'year' => $this->activity->listYear(),
            'now' => $now,
            'input' => $request->input(),
            'colHeaders' => $colHeaders,
            'columns' => $columns,
            'selectedMonth' => $month,
            'selectedYear' => $year,
        ];

        return view('pages.absensi.listAbsensiNew', $data);
    }

    public function loadData(Request $request)
    {
        $month = $request->query('month');
        $year = $request->query('year');

        if (!$month || !$year) {
            return response()->json([]);
        }

        $daysInMonth = Carbon::create($year, $month, 1)->daysInMonth;

        $records = DB::table('absensi_log')
            ->join('employees', 'employees.kode_pegawai', '=', 'absensi_log.kode_pegawai')
            ->select(
                'employees.name as nama',
                'absensi_log.kode_pegawai',
                'absensi_log.tanggal',
                'absensi_log.jam_masuk',
                'absensi_log.jam_pulang as jam_keluar'
            )
            ->whereYear('absensi_log.tanggal', $year)
            ->whereMonth('absensi_log.tanggal', $month)
            ->orderBy('employees.name', 'asc')
            ->get();

        if ($records->isEmpty()) {
            // generate 20 baris kosong
            $empty = [];
            for ($i = 1; $i <= 20; $i++) {
                $empty[] = ['kode_pegawai' => '', 'nama' => ''];
            }
            return response()->json($empty);
        }

        // group per nama
        $grouped = [];
        foreach ($records as $rec) {
            $day = date('j', strtotime($rec->tanggal));

            if (!isset($grouped[$rec->kode_pegawai])) {
                $grouped[$rec->kode_pegawai] = [
                    'kode_pegawai' => $rec->kode_pegawai,
                    'nama' => $rec->nama
                ];
            }

            // Format jam hanya jam dan menit (HH:mm)
            $masuk = $rec->jam_masuk ? date('H:i', strtotime($rec->jam_masuk)) : '';
            $keluar = $rec->jam_keluar ? date('H:i', strtotime($rec->jam_keluar)) : '';

            // Tampilkan di sel dengan format multi-baris
            $grouped[$rec->kode_pegawai][$day] = trim($masuk . "\n" . $keluar);
        }

        $result = [];
        foreach ($grouped as $row) {
            $result[] = $row;
        }

        return response()->json($result);
    }

    public function saveData(Request $request)
    {
        // pretty_dump($request->all());
        $month = $request->input('month');
        $year = $request->input('year');
        $data = $request->input('data');

        if (!$month || !$year || !$data) {
            return response()->json(['status' => 'error', 'message' => 'Data tidak valid'], 422);
        }

        foreach ($data as $row) {
            if (empty($row['kode_pegawai'])) continue;

            foreach ($row as $key => $value) {
                if (!is_numeric($key)) continue;
                if (empty($value)) continue;

                $tanggal = Carbon::create($year, $month, $key)->format('Y-m-d');

                // normalisasi teks multi-baris
                $clean = trim(str_replace("\r", '', $value));
                $lines = explode("\n", $clean);

                $lastIndex = count($lines) - 1;
                $jamMasuk = isset($lines[0]) ? trim($lines[0]) : null;
                $jamKeluar = isset($lines[$lastIndex]) ? trim($lines[$lastIndex]) : null;

                // kalau copy-paste pakai slash, tetap aman
                if (strpos($clean, '/') !== false) {
                    [$jamMasuk, $jamKeluar] = array_pad(explode('/', str_replace(' ', '', $clean)), 2, null);
                }

                DB::table('absensi_log')->updateOrInsert(
                    ['kode_pegawai' => $row['kode_pegawai'], 'tanggal' => $tanggal],
                    ['jam_masuk' => $jamMasuk, 'jam_pulang' => $jamKeluar, 'updated_at' => now()]
                );
            }
        }

        return response()->json(['status' => 'success']);
    }

}
