<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PromoController extends Controller
{
    public function index(): View
    {
        return view('manajemen.indexpromo');
    }

    public function create(): View
    {
        return view('manajemen.createpromo');
    }
}
    
