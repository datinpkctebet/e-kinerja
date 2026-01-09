<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\SetupRepository;
use App\Repositories\ActivityRepository;

class DashboardController extends Controller
{
    public function __construct(
        SetupRepository $setup,
        ActivityRepository $activity
    )
    {
        $this->setup = $setup;
        $this->activity = $activity;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = $this->setup->getAttention(session('employee')['privilege']);

        $employee = $this->setup->getAttention('Pegawai');

        $scheduleActivity = $this->activity->getScheduleActivity();

        // pretty_dump($scheduleActivity);

        $data = [
            'admin' => $admin,
            'employee' => $employee,
            'scheduleActivity' => $scheduleActivity,
        ];

        return view('pages.dashboard', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee = $this->setup->getAttention('employee');

        $data = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ];

        if ($request->hasFile('file')){
            $img_path   = public_path(env('PATH_FILE'));
            $img_old    = @$employee->file;

            \File::exists($img_path) or \File::makeDirectory($img_path);

            if(!empty($img_old)){
                if(\File::isFile($img_path.$img_old)){
                    \File::delete($img_path.$img_old);
                }
            }

            $img_name = $request->file('file')->getClientOriginalName();
            $request->file('file')->move($img_path, $img_name);

            $data['file'] = $img_name;
        }

        $insert = $this->setup->updateAttention('Pegawai', $data);

        return redirect('/dashboard/')->with('success_message', 'Pengumuman berhasil diubah.');
    }

    public function scheduleActivity(Request $request)
    {
        $rows = $this->activity->getScheduleActivity();

        $final_data = [];
        foreach ($rows as $r) {
            $employeeId = (int) $r->employee_id;
            $date_key = 'date_' . ltrim(date('d', strtotime($r->date)), '0');

            if (!isset($final_data[$employeeId])) {
                $final_data[$employeeId] = [
                    'id' => $employeeId,
                    'name' => $r->employee_name,
                    'activity' => []
                ];
            }

            $time_key = $r->start_time . '-' . $r->end_time;

            if (!isset($final_data[$employeeId]['activity'][$date_key])) {
                $final_data[$employeeId]['activity'][$date_key] = [];
            }

            $final_data[$employeeId]['activity'][$date_key][$time_key] = $r->tupoksis_name;
        }

        $final_data = array_values($final_data);
        return response()->json($final_data);
    }

    public function scheduleActivityToday(Request $request)
    {
        $data = $this->activity->getScheduleActivityToday();

        $activities = $data['activities'];
        $employee_list = $data['employees'];

        $data_sakit = $activities->where('activity_name', 'Sakit')->all();
        $data_cuti = $activities->where('activity_name', 'Cuti')->all();
        $data_libur = $activities->where('activity_name', 'Libur')->all();
        $data_izin = $activities->where('activity_name', 'Izin')->all();
        $data_sudah = $activities->whereNotIn('activity_name', ['Sakit', 'Cuti', 'Libur', 'Izin'])->all();

        // ambil employee_id yang sudah input activity hari ini, lalu eliminasi dari employee_list
        $employee_ids_with_activity = $activities->pluck('employee_id')->unique();
        $employee_ids_all = $employee_list->pluck('id');
        $employee_ids_without = $employee_ids_all->diff($employee_ids_with_activity);

        $data_sakit_count = count($data_sakit);
        $data_cuti_count = count($data_cuti);
        $data_libur_count = count($data_libur);
        $data_izin_count = count($data_izin);
        $data_belum_count = $employee_ids_without->count();
        $data_sudah_count = count($data_sudah);

        $data = [
            "success" => true,
            "date" => date('Y-m-d'),
            "day" => (int) date('d'),
            "data" => [
                "sakit" => $data_sakit_count,
                "cuti" => $data_cuti_count,
                "libur" => $data_libur_count,
                "izin" => $data_izin_count,
                "belum" => $data_belum_count,
                "total" => $data_sudah_count
            ]
        ];

        return response()->json($data);
    }

    public function scheduleActivityTodayDetails(Request $request)
    {
        $data = $this->activity->getScheduleActivityTodayDetails();

        $employee_list = $data['employees'];
        $employee_map = $data['employees_map'];
        $activities = $data['activities'];

        $details = [
            'sakit' => [],
            'cuti' => [],
            'libur' => [],
            'izin' => [],
            'belum' => []
        ];

        foreach ($activities as $a) {
            $cat = strtolower($a->activity_name);
            $activity_text = !empty($a->activity_description) ? $a->activity_description : $a->activity_name;
            $emp = $employee_map->get($a->employee_id);
            $name = $emp ? $emp->name : null;

            if ($activity_text == 'null') {
                $activity_text = 'Tidak ada keterangan';
            }

            $item = [
                'id' => (int) $a->employee_id,
                'name' => $name,
                'activity' => $activity_text
            ];

            if (in_array($cat, ['sakit', 'cuti', 'libur', 'izin'])) {
                $details[$cat][] = $item;
            }
        }

        $employee_ids_with_activity = $activities->pluck('employee_id')->unique()->all();

        foreach ($employee_list as $emp) {
            if (!in_array($emp->id, $employee_ids_with_activity)) {
                $details['belum'][] = [
                    'id' => (int) $emp->id,
                    'name' => $emp->name,
                    'activity' => 'Belum Input Aktivitas'
                ];
            }
        }

        $result = [
            "success" => true,
            "date" => date('Y-m-d'),
            "day" => (int) date('d'),
            "details" => $details
        ];

        return response()->json($result);
    }
}
