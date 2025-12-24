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
        $data = $this->activity->getScheduleActivity();

        $final_data = [];
        foreach($data as $data){
            $date_key = 'date_' . ltrim(date('d', strtotime($data->date)), '0');
            if(!isset($final_data[$data->employee_id])){
                $final_data[$data->employee_id] = [
                    'id' => (int) $data->employee_id,
                    'name' => $data->employee_name,
                ];
            }
            $final_data[$data->employee_id][$date_key] = $data->tupoksis_name;
        }

        // pretty_dump($final_data);
        $data = [
            [
                'id' => 1,
                'name' => 'Andi',
                'date_1' => 'Meeting',
                'date_2' => 'Conference',
                'date_3' => '',
                'date_4' => '',
                'date_5' => 'Training',
                'date_6' => '',
                'date_7' => '',
                'date_8' => '',
                'date_9' => '',
                'date_10' => '',
                'date_11' => '',
                'date_12' => '',
                'date_13' => '',
                'date_14' => '',
                'date_15' => '',
                'date_16' => '',
                'date_17' => '',
                'date_18' => '',
                'date_19' => '',
                'date_20' => '',
                'date_21' => '',
                'date_22' => '',
                'date_23' => '',
                'date_24' => '',
                'date_25' => '',
                'date_26' => '',
                'date_27' => '',
                'date_28' => '',
                'date_29' => '',
                'date_30' => '',
                'date_31' => '',
            ],
            [
                'id' => 2,
                'name' => 'Budi',
                'date_1' => 'Training',
                'date_2' => 'Workshop'
            ],
            [
                'id' => 3,
                'name' => 'Caca',
                'date_1' => 'Seminar',
                'date_2' => 'Workshop'
            ],
            [
                'id' => 4,
                'name' => 'Dodi',
                'date_1' => 'Training',
                'date_2' => 'Conference'
            ],
            [
                'id' => 5,
                'name' => 'Eka',
                'date_1' => 'Meeting',
                'date_2' => 'Seminar'
            ],
            [
                'id' => 6,
                'name' => 'Fina',
                'date_1' => 'Workshop',
                'date_2' => 'Conference'
            ],
            [
                'id' => 7,
                'name' => 'Gina',
                'date_1' => 'Training',
                'date_2' => 'Meeting'
            ],
            [
                'id' => 8,
                'name' => 'Hadi',
                'date_1' => 'Seminar',
                'date_2' => 'Workshop'
            ],
            [
                'id' => 9,
                'name' => 'Intan',
                'date_1' => 'Conference',
                'date_2' => 'Training'
            ],
            [
                'id' => 10,
                'name' => 'Joko',
                'date_1' => 'Meeting',
                'date_2' => 'Seminar'
            ],
            [
                'id' => 11,
                'name' => 'Kiki',
                'date_1' => 'Workshop',
                'date_2' => 'Conference'
            ],
        ];
        // pretty_dump($data);
        return response()->json($data);
    }
}
