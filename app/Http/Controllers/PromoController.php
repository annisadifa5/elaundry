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
        // VALIDASI INPUT
        $validated = $request->validate([
            'nama_promo'            => 'required|string|max:255',
            'skema'                 => 'required|string|max:255',

            // BASIS PROMO
            'basis_promo'           => 'required|in:nominal,persentase',
            'nilai_promo'           => 'required|numeric|min:0',

            // STATUS & WAKTU
            'status'                => 'required|in:aktif,nonaktif',
            'tanggal_mulai'         => 'required|date',
            'tanggal_selesai'       => 'required|date|after_or_equal:tanggal_mulai',

            // OPSIONAL
            'minimal_transaksi'     => 'nullable|numeric|min:0',

            'deskripsi_promo'       => 'required|string',
        ]);

        // SIMPAN DATA
        Promo::create([
            'nama_promo'        => $validated['nama_promo'],
            'skema'             => $validated['skema'],
            'basis_promo'       => $validated['basis_promo'],
            'nilai_promo'       => $validated['nilai_promo'],
            'minimal_transaksi' => $validated['minimal_transaksi'] ?? 0,
            'status'            => $validated['status'],
            'tanggal_mulai'     => $validated['tanggal_mulai'],
            'tanggal_selesai'   => $validated['tanggal_selesai'],
            'deskripsi_promo'   => $validated['deskripsi_promo'],
        ]);

        return redirect()
            ->route('manajemen.indexpromo')
            ->with('success', 'Promo berhasil ditambahkan 🎉');
    }

    public function show($id): View
    {
        $promo = Promo::findOrFail($id);

        // 🔥 CEK STATUS PROMO
        if ($promo->status !== 'aktif') {
            return redirect()
                ->route('manajemen.indexpromo')
                ->with('error', 'Promo sudah tidak aktif');
        }

        return view('manajemen.showpromo', compact('promo'));
    }

    public function nonaktifkan($id)
    {
        $promo = Promo::findOrFail($id);
        $promo->status = 'nonaktif';
        $promo->save();

        return redirect()
            ->route('manajemen.indexpromo')
            ->with('success', 'Promo berhasil dinonaktifkan');
    }

}
