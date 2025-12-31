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

        // $data = [
        //     [
        //         'id' => 1,
        //         'name' => 'Andi',
        //         'activity' => [
        //             'date_1' => [
        //                 '07:30-13:00' => 'Meeting',
        //                 '13:00-15:00' => 'Project Review',
        //                 '15:00-18:00' => 'Development',
        //             ],
        //             'date_3' => [
        //                 '09:00-12:00' => 'Code Review',
        //                 '12:00-17:00' => 'Client Call',
        //             ],
        //             'date_5' => [
        //                 '08:00-12:00' => 'Team Lunch',
        //                 '12:00-16:00' => 'Brainstorming Session',
        //             ],
        //         ]
        //     ],
        //     [
        //         'id' => 2,
        //         'name' => 'Budi',
        //         'activity' => []
        //     ]
        // ];
        return response()->json($final_data);
    }

    public function scheduleActivityToday(Request $request)
    {
        // $date_key = $request->input('date');
        // $data = $this->activity->getScheduleActivityToday(['date' => $date_key]);

        $data = [
            "success" => true,
            "date" => "2024-12-30",
            "day" => 30,
            "data" => [
                "sakit" => 5,
                "cuti" => 3,
                "libur" => 2,
                "izin" => 4,
                "belum" => 10
            ],
            "total_records" => 24
        ];

        // pretty_dump(response()->json($data));

        return response()->json($data);
    }

    public function scheduleActivityTodayDetails(Request $request)
    {
        // $date_key = $request->input('date');
        // $employee_id = $request->input('employee_id');
        // $data = $this->activity->getScheduleActivityTodayDetails(['date' => $date_key, 'employee_id' => $employee_id]);

        $data = [
            "details" => [
                "sakit" => [
                    0 => [
                        "id" => 1,
                        "name" => "Andi",
                        "activity" => "Demam"
                    ],
                    1 => [
                        "id" => 2,
                        "name" => "Budi",
                        "activity" => "Sakit kepala"
                    ],
                ],
                "cuti" => [
                    0 => [
                        "id" => 3,
                        "name" => "Caca",
                        "activity" => "Cuti tahunan"
                    ],
                    1 => [
                        "id" => 4,
                        "name" => "Dodi",
                        "activity" => "Cuti menikah"
                    ],
                ],
                "belum" => [
                    0 => [
                        "id" => 5,
                        "name" => "Eka",
                        "activity" => "Belum absen"
                    ],
                    1 => [
                        "id" => 6,
                        "name" => "Fina",
                        "activity" => "Belum absen"
                    ],
                    2 => [
                        "id" => 7,
                        "name" => "Gina",
                        "activity" => "Belum absen"
                    ],
                ]
            ]
        ];

        return response()->json($data);
    }
}
