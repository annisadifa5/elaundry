<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LacakController extends Controller
{
    public function index()
    {
        return view('lacak.index');
    }
}
