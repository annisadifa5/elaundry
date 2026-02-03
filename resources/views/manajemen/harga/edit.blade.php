@extends('layouts.dashboard')

@section('title', 'Edit Harga')

@section('content')
<h3 class="page-title">Edit Harga</h3>

<div class="card">

    {{-- FORM --}}
    <form action="{{ route('manajemen.harga.update', $harga->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-grid">

            {{-- KATEGORI --}}
            <div class="form-group">
                <label>Kategori</label>
                <select name="kategori" id="kategori" required>
                    <option value="">Pilih Kategori</option>
                    <option value="laundry" {{ $harga->kategori == 'laundry' ? 'selected' : '' }}>Laundry</option>
                    <option value="jasa" {{ $harga->kategori == 'jasa' ? 'selected' : '' }}>Jasa</option>
                </select>
            </div>

            {{-- KODE LAYANAN --}}
            <div class="form-group">
                <label>Kode Layanan</label>
                <input type="text" name="kode_layanan" value="{{ $harga->kode_layanan }}" required>
            </div>

            {{-- JENIS LAYANAN --}}
            <div class="form-group">
                <label>Jenis Layanan</label>
                <input type="text" name="nama_layanan" value="{{ $harga->nama_layanan }}" required>
            </div>

            {{-- SATUAN --}}
            <div class="form-group">
                <label>Satuan</label>
                <select name="satuan" id="satuan" required>
                    <option value="">Pilih Satuan</option>
                    <option value="kg" {{ $harga->satuan == 'kg' ? 'selected' : '' }}>Per Kg</option>
                    <option value="pcs" {{ $harga->satuan == 'pcs' ? 'selected' : '' }}>Per Pcs</option>
                    <option value="km" {{ $harga->satuan == 'km' ? 'selected' : '' }}>Per KM</option>
                </select>
            </div>

            {{-- HARGA --}}
            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="harga" value="{{ $harga->harga }}" required>
            </div>

            {{-- JARAK --}}
            <div class="form-group">
                <label>Jarak (KM)</label>
                <input type="number" name="jarak" id="jarak"
                    value="{{ $harga->jarak }}"
                    {{ $harga->kategori != 'jasa' ? 'disabled' : '' }}>
            </div>

            {{-- CHECKBOX --}}
            <div class="form-group checkbox-group">
                <label class="checkbox-label">
                    <input type="checkbox" name="is_optional" id="is_optional" value="1"
                        {{ $harga->is_optional ? 'checked' : '' }}
                        {{ $harga->kategori != 'jasa' ? 'disabled' : '' }}>
                    <span>Layanan Opsional (Jasa)</span>
                </label>
            </div>

            <div class="form-group checkbox-group">
                <label class="checkbox-label">
                    <input type="checkbox" name="is_active" value="1"
                        {{ $harga->is_active ? 'checked' : '' }}>
                    <span>Aktif</span>
                </label>
            </div>

            {{-- KETERANGAN --}}
            <div class="form-group full">
                <label>Keterangan</label>
                <textarea name="keterangan" rows="3">{{ $harga->keterangan }}</textarea>
            </div>

        </div>

        {{-- BUTTON --}}
        <div class="form-action">
            <a href="{{ route('manajemen.harga.index') }}" class="btn kembali">Kembali</a>
            <button type="submit" class="btn simpan">Update</button>
        </div>
    </form>
</div>

{{-- STYLE (SAMA PERSIS CREATE) --}}
<style>
.page-title {
    font-weight: 600;
    margin-bottom: 16px;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}

.form-group {
    display: flex;
    flex-direction: column;
    font-size: 14px;
}

.form-group.full {
    grid-column: span 2;
}

.form-group label {
    margin-bottom: 6px;
    font-weight: 500;
}

.form-group input,
.form-group select,
.form-group textarea {
    padding: 8px 10px;
    border-radius: 6px;
    border: 1px solid #cbd5e1;
    font-size: 14px;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #16a39a;
}

.checkbox-group {
    justify-content: flex-start;
}

.checkbox-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: normal;
}

.checkbox-label input {
    margin: 0;
}

.form-action {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 20px;
}

.btn {
    padding: 8px 16px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    font-size: 13px;
    text-decoration: none;
}

.btn.kembali {
    background: #e2e8f0;
    color: #334155;
}

.btn.simpan {
    background: #fb923c;
    color: white;
}

.btn.simpan:hover {
    background: #f97316;
}
</style>

{{-- SCRIPT (SAMA PERSIS CREATE + AUTO INIT) --}}
<script>
const kategori = document.getElementById('kategori');
const satuan = document.getElementById('satuan');
const jarak = document.getElementById('jarak');
const isOptional = document.getElementById('is_optional');

function handleKategori() {
    if (kategori.value === 'jasa') {
        satuan.value = 'km';
        satuan.querySelectorAll('option').forEach(opt => {
            opt.disabled = opt.value !== 'km' && opt.value !== '';
        });

        jarak.disabled = false;
        isOptional.disabled = false;
    } else {
        satuan.querySelectorAll('option').forEach(opt => {
            opt.disabled = opt.value === 'km';
        });

        jarak.value = '';
        jarak.disabled = true;

        isOptional.checked = false;
        isOptional.disabled = true;
    }
}

kategori.addEventListener('change', handleKategori);
document.addEventListener('DOMContentLoaded', handleKategori);
</script>

@endsection
