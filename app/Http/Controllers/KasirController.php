<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class KasirController extends Controller
{
    public function create()
    {
        return view('admin.kasir.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'no_telp' => 'required',
            'password' => 'required|min:6',
        ]);

        User::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'no_telp' => $data['no_telp'],
            'role' => 'kasir', // 🔥 INI KUNCINYA
            'password' => Hash::make($data['password']),
        ]);

        return redirect('/admin/dashboard')->with('success', 'Kasir berhasil ditambahkan');
    }
}
