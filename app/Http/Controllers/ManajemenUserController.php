<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ManajemenUserController extends Controller
{
    public function index()
    {
        return view('manajemen.user.index', [
            'users' => User::orderBy('role')->get()
        ]);
    }

    public function create()
    {
        return view('manajemen.user.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'no_telp' => 'required',
            'role' => 'required|in:admin,kasir',
            'password' => 'required|min:6',
        ]);

        User::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'no_telp' => $data['no_telp'],
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('manajemen.user.index');
    }

    public function edit(User $user)
    {
        return view('manajemen.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_telp' => 'required',
            'role' => 'required|in:admin,kasir',
        ]);

        $user->update($data);

        return redirect()->route('manajemen.user.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}

