<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class inventoryController extends Controller
{
    public function index()
    {
        return view('admin.inventory.index');
    }


}
