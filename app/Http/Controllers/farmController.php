<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class farmController extends Controller
{
    public function index()
    {
        return view('admin.farm.index');
    }

    public function cropsindex()
    {
        return view('admin.farm.crops.index');
    }

    public function livestocksindex()
    {
        return view('admin.farm.livestocks.index');
    }

    
}
