@extends('layouts.dashboard')

@section('title', 'Input Promo')

@section('content')
<div class="page-title">Input Promo</div>

<div class="card" style="max-width: 100%;">
    <h4>Input Promo</h4>

    <form method="POST" action="{{ route('manajemen.storepromo') }}">
    @csrf

    {{-- NAMA & SKEMA --}}
    <div class="row">
        <input type="text" name="nama_promo" placeholder="Nama Promo" required>
        <input type="text" name="skema" placeholder="Skema Promo" required>
    </div>

    {{-- BASIS PROMO --}}
    <div class="row">
        <select name="basis_promo" required>
            <option value="">Basis Promo</option>
            <option value="nominal">Promo Nominal (Rp)</option>
            <option value="persentase">Promo Persentase (%)</option>
        </select>

        <input type="number" name="nilai_promo"
               placeholder="Nilai Promo (Rp / %)"
               min="0"
               required>
    </div>

    {{-- STATUS & TANGGAL --}}
    <div class="row">
        <select name="status" required>
            <option value="">Status</option>
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Non Aktif</option>
        </select>

    <div class="date-group">
        <input type="date" name="tanggal_mulai" required>
        <label>Tanggal Mulai</label>
    </div>

    <div class="date-group">
        <input type="date" name="tanggal_selesai" required>
        <label>Tanggal Selesai</label>
    </div>
    </div>

    {{-- MINIMAL TRANSAKSI --}}
    <div class="row">
        <input type="number" name="minimal_transaksi"
               placeholder="Minimal Transaksi (Rp)"
               min="0">
    </div>

    {{-- DESKRIPSI --}}
    <div class="row">
        <textarea name="deskripsi_promo"
                  placeholder="Deskripsi Promo"
                  required></textarea>
    </div>

    <div class="btn-row">
        <a href="{{ route('manajemen.indexpromo') }}"
           class="btn btn-secondary btn-sm">Kembali</a>

        <button class="btn">Simpan Promo</button>
    </div>
    </form>

</div>

<style>

/* ===== CEGAH GESER KANAN KIRI ===== */
html, body {
    overflow-x: hidden;
}

/* ===== ROW FORM ===== */
.row {
    display: flex;
    flex-wrap: wrap;      /* 🔥 ini kunci */
    gap: 12px;
    margin-bottom: 12px;
}

/* input default desktop */
.row input,
.row select,
.row textarea,
.row .date-group {
    flex: 1;
    min-width: 220px;
    max-width: 100%;
}

/* textarea full width */
.row textarea {
    width: 100%;
    min-height: 90px;
}

/* tombol */
.btn-row {
    display: flex;
    gap: 10px;
    margin-top: 15px;
}

/* ===== MOBILE ===== */
@media (max-width: 768px) {

    /* semua field turun ke bawah */
    .row input,
    .row select,
    .row textarea {
        flex: 1 1 100%;
        min-width: 0;
    }

    /* tombol full */
    .btn-row {
        flex-direction: column;
    }

    .btn-row .btn,
    .btn-row a {
        width: 100%;
        text-align: center;
    }
}

.date-group {
    position: relative;
    margin-bottom: 20px;
}

.date-group input {
    width: 100%;
    height: 45px;
    padding: 12px;
    font-size: 14px;
}

.date-group label {
    position: absolute;
    left: 12px;
    top: 12px;
    color: #888;
    pointer-events: none;
    transition: 0.2s ease;
}

/* sembunyikan format bawaan */
input[type="date"]::-webkit-datetime-edit {
    color: transparent;
}

/* tampilkan tanggal kalau sudah isi / focus */
input[type="date"]:focus::-webkit-datetime-edit,
input[type="date"]:valid::-webkit-datetime-edit {
    color: black;
}

/* efek label naik */
.date-group input:focus + label,
.date-group input:valid + label {
    top: -8px;
    left: 8px;
    font-size: 11px;
    background: white;
    padding: 0 4px;
    color: #00b894;
}

.date-group input[type="date"] {
    width: 100%;
    height: 45px;        /* samakan dengan input lain */
    box-sizing: border-box;
    padding: 12px;
    font-size: 14px;
}

</style>
@endsection
