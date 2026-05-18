<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.manage.customer_management.index');
    }
    public function detail()
    {
        return view('admin.manage.customer_management.detail');
    }

    public function import()
    {
        return view('admin.manage.customer_management.import');
    }
}