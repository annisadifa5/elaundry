<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservasiController extends Controller
{
    public function index(): View
    {
        return view('reservasi.index');
    }

    public function create(): View
    {
        return view('reservasi.create');
    }
    
    public function store(Request $request)
    {
        return view('reservasi.store');
    }
}
