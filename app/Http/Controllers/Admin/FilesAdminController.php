<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilesAdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('permits')->only([
            'index'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('filesAdmin.index');
    }
}
