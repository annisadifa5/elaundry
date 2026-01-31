<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PromoController extends Controller
{
    public function index(): View
    {
        $promos = Promo::orderByDesc('tanggal_mulai')->get();

        return view('manajemen.indexpromo', compact('promos'));
    }

    public function create(): View
    {
        return view('manajemen.createpromo');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_promo'        => 'required|string|max:255',
            'deskripsi_promo'   => 'required|string',
            'skema'             => 'required|string',
            'status'            => 'required|in:aktif,nonaktif',
            'tanggal_mulai'     => 'required|date',
            'tanggal_selesai'   => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        Promo::create($request->only([
            'nama_promo',
            'deskripsi_promo',
            'skema',
            'status',
            'tanggal_mulai',
            'tanggal_selesai',
        ]));

        return redirect()
            ->route('manajemen.indexpromo')
            ->with('success', 'Promo berhasil ditambahkan');
    }

    public function show($id): View
    {
        $promo = Promo::findOrFail($id);

        return view('manajemen.showpromo', compact('promo'));
    }
}
