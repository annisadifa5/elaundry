@extends('layouts.dashboard')

@section('title', 'Lacak Pemesanan')

@section('content')
    <h3 class="page-title">Lacak Pemesanan Laundry</h3>

    <div class="card">
        {{-- FILTER --}}
        <form method="GET" action="#">
            <div class="row">
                <select name="status">
                    <option value="">Proses</option>
                    <option value="diterima">Diterima</option>
                    <option value="dicuci">Dicuci</option>
                    <option value="dikeringkan">Dikeringkan</option>
                    <option value="disetrika">Disetrika</option>
                </select>

                <input type="date" name="from">
                <input type="date" name="to">

                <button class="btn" type="submit">Terapkan</button>
            </div>
        </form>

        {{-- TABLE --}}
        <div style="margin-top: 20px; overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>No. Order</th>
                        <th>Nama</th>
                        <th>Payment</th>
                        <th>Tipe</th>
                        <th>Jenis Layanan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Dummy data --}}
                    <tr>
                        <td>1</td>
                        <td>Aghist Aprilia Eka Putri</td>
                        <td>Cash</td>
                        <td>Pick Up</td>
                        <td>Cuci Setrika</td>
                        <td class="aksi">
                            <button title="Detail">👁</button>
                            <button title="Edit">✎</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Alvino Bintang Adiatma</td>
                        <td>Qris</td>
                        <td>Regular</td>
                        <td>Express</td>
                        <td class="aksi">
                            <button title="Detail">👁</button>
                            <button title="Edit">✎</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- STYLE KHUSUS TABLE --}}
    <style>
        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .table thead {
            background: #16a39a;
            color: white;
        }

        .table th,
        .table td {
            padding: 10px 12px;
            text-align: left;
        }

        .table tbody tr {
            border-bottom: 1px solid #e2e8f0;
        }

        .table tbody tr:hover {
            background: #f1f9f9;
        }

        .aksi button {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin-right: 6px;
        }

        .aksi button:hover {
            opacity: 0.7;
        }
    </style>
@endsection
