<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin()
    {
        return view('admin.dashboard.admin');
    }

    public function employee()
    {
        return view('admin.dashboard.employee');
    }

    public function client()
    {
        return view('admin.dashboard.guest');
    }
}