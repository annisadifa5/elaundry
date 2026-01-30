<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return Customer::with('user')->get();
    }

    public function show($id)
    {
        return Customer::with(['user', 'pemesanan'])->findOrFail($id);
    }

    public function store(Request $request)
    {
        return Customer::create($request->all());
    }
}
