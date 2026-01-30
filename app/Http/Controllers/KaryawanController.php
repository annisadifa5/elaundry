<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Outlet;
use App\Models\User;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    /**
     * Tampilkan data karyawan
     */
    public function index()
    {
        $karyawans = Karyawan::with('outlet')->get();

        return view('karyawan.index', compact('karyawans'));
    }

    /**
     * Form tambah karyawan
     */
    public function create()
    {
        $outlets = Outlet::all();
        $users   = User::all();

        return view('karyawan.create', compact('outlets', 'users'));
    }

    /**
     * Simpan data karyawan
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_user'        => 'required',
            'id_outlet'      => 'required',
            'nama_karyawan'  => 'required|string|max:255',
            'jabatan'        => 'required|string|max:100',
            'jenis_kelamin'  => 'required',
            'no_hp'          => 'required',
            'email'          => 'required|email',
        ]);

        Karyawan::create($request->all());

        return redirect()
            ->route('karyawan.index')
            ->with('success', 'Data karyawan berhasil ditambahkan');
    }

    /**
     * Detail karyawan
     */
    public function show($id)
    {
        $karyawan = Karyawan::with('outlet', 'user')->findOrFail($id);

        return view('karyawan.show', compact('karyawan'));
    }

    /**
     * Form edit karyawan
     */
    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $outlets  = Outlet::all();
        $users    = User::all();

        return view('karyawan.edit', compact('karyawan', 'outlets', 'users'));
    }

    /**
     * Update data karyawan
     */
    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'jabatan'       => 'required|string|max:100',
            'email'         => 'required|email',
        ]);

        $karyawan->update($request->all());

        return redirect()
            ->route('karyawan.index')
            ->with('success', 'Data karyawan berhasil diperbarui');
    }

    /**
     * Hapus karyawan
     */
    public function destroy($id)
    {
        Karyawan::findOrFail($id)->delete();

        return redirect()
            ->route('karyawan.index')
            ->with('success', 'Data karyawan berhasil dihapus');
    }
}
