<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BlogRepository;

class BlogController extends Controller
{
    public function __construct(
        BlogRepository $blog
    )
    {
        $this->model = $blog;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $param = [
            'perpage' => $request->input('perpage'),
            'slug' => $request->input('slug'),
        ];

        return $this->model->findWithPaginate($param);
    }
}
