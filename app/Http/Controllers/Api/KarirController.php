<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\KarirRepository;

class KarirController extends Controller
{
    public function __construct(
        KarirRepository $karir
    )
    {
        $this->model = $karir;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $param = [
            'perpage' => 100,
            'slug' => $request->input('slug'),
        ];

        return $this->model->findWithPaginate($param);
    }
}
