<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\SetupRepository;

class DashboardController extends Controller
{
    public function __construct(
        SetupRepository $setup
    )
    {
        $this->setup = $setup;
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

        $data = [
            'admin' => $admin,
            'employee' => $employee,
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
}
