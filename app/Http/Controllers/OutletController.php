<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OutletController extends Controller
{
    public function index()
    {
        return view('outlet.index');
    }
    
    public function create()
    {
        return view('outlet.create');
    }

    public function show($id)
    {
        // dummy data contoh
        $outlet = (object)[
            'nama' => 'Outlet Laundio',
            'jalan' => 'Jl. Merdeka',
            'desa' => 'Sukamaju',
            'kecamatan' => 'Ciputat',
            'kota' => 'Tangerang Selatan',
            'provinsi' => 'Banten',
            'kode_pos' => '15412',
            'telepon' => '08123456789',
            'email' => 'outlet@laundio.com',
            'website' => 'laundio.com',
            'pj_nama' => 'Andi',
            'pj_kontak' => '08129876543'
        ];

        return view('outlet.show', compact('outlet'));
    }

    public function store(Request $request)
    {
        // simpan data outlet
        return redirect()->route('outlet.index');
    }
}

