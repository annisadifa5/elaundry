@extends('layouts.dashboard')

@section('title', 'Reservasi Laundio')

@section('content')
    <div class="page-title">Pemesanan Laundio</div>

    <div class="card">
        <h4>Form Pemesanan Laundio</h4>

        <form>
            <div class="row">
                <input type="text" placeholder="Nama">
                <input type="text" placeholder="No. Telp">
            </div>

            <div class="row">
                <input type="text" placeholder="Alamat">
            </div>

            <div class="row">
                <select>
                    <option>Pilih Jenis Layanan</option>
                    <option>Cuci</option>
                    <option>Setrika</option>
                    <option>Cuci Kering</option>
                    <option>Cuci Setrika</option>
                    <option>Express</option>
                    <option>Sprei</option>
                    <option>Bed Cover</option>
                    <option>Boneka</option>
                    <option>Bantal</option>
                </select>

                <input type="date">
                <input type="time">
            </div>

            <div class="row">
                <textarea placeholder="Catatan Khusus"></textarea>
            </div>

            <div class="row btn-row">
                <button class="btn">Pickup Now</button>
            </div>

        </form>
    </div>
@endsection
