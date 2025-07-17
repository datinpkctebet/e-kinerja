<?php

namespace App\Http\Controllers;

use Auth;
use Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Repositories\EmployeeRepository;


class LoginController extends Controller
{
    public function __construct(
        EmployeeRepository $employee
    )
    {
        $this->model = $employee;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->session()->has('employee')) return redirect('/dashboard');

        $error_message = false;

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'nip' => 'bail|required',
                'password' => 'bail|required',
            ]);

            if ($validator->fails()) {
                $error_message = $validator->errors()->all()[0];
            } else {
                $auth = $this->model->getFirst($request->input('nip'));

                if (empty($auth)) {
                    $error_message = "Pegawai belum tersedia.";
                }

                else if ($auth->active) {
                    if ($request->input('password') === decryptor($auth->password)) {
                        $employee = [
                            'id' => $auth->id,
                            'nip' => $auth->nip,
                            'name' => $auth->name,
                            'privilege' => $auth->privilege,
                            'profession' => $auth->jabatan,
                            'unit_kerja' => $auth->unit_kerja,
                            'photo' => $auth->photo,
                        ];

                        session(['employee' => $employee]);

                        return redirect('/')->with('success_message', 'Login berhasil.');
                    } else {
                        $error_message = 'No Pegawai atau kata sandi yang Anda masukkan salah.';
                    }
                }

                else {
                    $error_message = 'Akun anda belum aktif, silahkan lapor admin untuk mengaktifkannya.';
                }
            }
        }

        $data = [
            'error_message' => $error_message,
            'input' => $request->input(),
        ];

        return view('pages.login', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        if ($request->session()->has('employee')) return redirect('/dashboard');

        $error_message = false;

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'nip' => 'bail|required|unique:employees,nip',
                'name' => 'bail|required',
                'password' => 'bail|required|min:6',
                'retype_password' => 'required_with:password|same:password|min:6',
            ]);

            if ($validator->fails()) {
                $error_message = $validator->errors()->all()[0];
            } else {
                $data = [
                    'nip' => $request->input('nip'),
                    'name' => $request->input('name'),
                    'password' => encryptor($request->input('password')),
                    'privilege' => 'Pegawai',
                ];

                $insert = $this->model->create($data);

                return redirect('/')->with('success_message', 'Pendaftaran berhasil, silahkan lapor admin untuk mengaktifkan akun anda.');
            }
        }

        $data = [
            'error_message' => $error_message,
            'input' => $request->input(),
        ];

        return view('pages.register', $data);
    }

    /**
     * Handle logout.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        session()->flush();

        return redirect('login');
    }
}
