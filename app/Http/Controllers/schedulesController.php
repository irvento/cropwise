<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class schedulesController extends Controller
{
    public function index()
    {
        return view('admin.schedule.index');
    }

    public function create()
    {
        return view('admin.schedule.create');
    }

    public function edit($id)
    {
        return view('admin.schedule.edit', compact('id'));
    }
}
