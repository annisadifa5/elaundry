@extends(
    auth()->user()->role === 'admin'
        ? 'layouts.dashboard'
        : 'layouts.dashboard_kasir'
)

@section('title', 'Reservasi Laundio')

@section('content')
<div class="page-title">Reservasi Laundio</div>

<div class="card">
    <h4>Form Reservasi Laundio</h4>

    <form id="form-reservasi" action="{{ route('reservasi.store') }}" method="POST">
        @csrf
        
        <input type="hidden" name="id_outlet" value="2">

        {{-- NAMA & TELP --}}
        <div class="row">
            <input type="text" name="nama_lengkap" placeholder="Nama" required>
            <input type="text" name="no_telp" placeholder="No. Telp" required>
        </div>

        {{-- ALAMAT --}}
        <div class="row">
            <textarea id="alamat" name="alamat_jemput" placeholder="Alamat Jemput" required></textarea>
        </div>

        <div class="row" style="margin-bottom:10px;">
            <input type="text" id="searchLokasi" placeholder="Cari alamat..."
                style="flex:1;padding:8px;border-radius:6px;border:1px solid #ccc;">
            <button type="button" onclick="cariLokasi()"
                    style="padding:8px 12px;border:none;background:#22c55e;color:white;border-radius:6px;">
                Cari
            </button>
        </div>

        <div class="row">
            <label><strong>Pilih Lokasi di Map</strong></label>
            <div id="map" style="height:300px;width:100%;border-radius:10px;"></div>
        </div>


        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">

        {{-- <!-- LOKASI -->
        <div class="row">
            <input
                type="url"
                name="lokasi"
                placeholder="Titik Lokasi (URL Google Maps)"
                value="{{ old('lokasi') }}"
            >
        </div> --}}

        <!-- {{-- HIDDEN KOORDINAT CUSTOMER
        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">
        <input type="hidden" name="id_outlet" value="3">
 --}} -->

        {{-- JENIS LAYANAN --}}
        <div class="form-group">
            <div style="display:flex;flex-wrap:wrap;gap:8px;align-items:center;">
                <select id="layanan-select" style="min-width:200px;">
                    <option value="">Jenis Layanan</option>
                    <option value="cuci">Cuci</option>
                    <option value="setrika">Setrika</option>
                    <option value="cuci_kering">Cuci Kering</option>
                    <option value="cuci_setrika">Cuci Setrika</option>
                    <option value="express">Express</option>
                    <option value="sprei">Sprei</option>
                    <option value="bed_cover">Bed Cover</option>
                    <option value="boneka">Boneka</option>
                    <option value="bantal">Bantal</option>
                </select>

                <div id="layanan-chip-wrapper"
                     style="display:flex;gap:6px;flex-wrap:wrap;"></div>
            </div>

            {{-- hidden untuk controller --}}
            <input type="hidden" name="jenis_layanan" id="jenis_layanan_input">
        </div>

        {{-- TIPE PEMESANAN --}}
        {{-- <div class="form-group">
            <div style="display:flex;flex-wrap:wrap;gap:8px;align-items:center;">
                <select id="tipe-select" style="min-width:200px;">
                    <option value="">Tipe Pemesanan</option>
                    <option value="kiloan">Kiloan</option>
                    <option value="satuan">Satuan</option>
                </select>

                <div id="tipe-chip-wrapper"
                    style="display:flex;gap:6px;flex-wrap:wrap;"></div>
            </div>

            <input type="hidden" name="tipe_pemesanan" id="tipe_pemesanan_input">
        </div> --}}

        {{-- TANGGAL & JAM --}}
        <div class="row" style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
            <input type="date" name="tanggal_jemput" required>
            <input type="time" name="jam_jemput" required>
        </div>


        {{-- JUMLAH ITEM --}}
        <div class="row">
            <input type="number" name="jumlah_item" placeholder="Kuantitas">
        </div>

        <!-- JARAK -->
        <div class="row">
            <span>Jarak:</span>
            <span id="jarak-text">0 km</span>
        </div>

        <!-- ONGKIR -->
        <div class="row">
            <span>Ongkir:</span>
            <span id="ongkir-text">Rp 0</span>
        </div>

        <div class="row">
            <strong>Total Harga:</strong>
            <span id="total-harga">Rp 0</span>
        </div>

        <input type="hidden" name="total_harga" id="total_harga_input">


        {{-- CATATAN --}}
        <div class="row">
            <textarea name="catatan_khusus" placeholder="Catatan Khusus"></textarea>
        </div>

        <div class="row btn-row">
            <button type="submit" class="btn" id="pickupNow">Pickup Now</button>
        </div>
    </form>
</div>

<div id="successModal" class="modal-overlay" style="display:none">
    <div class="modal-box">
        <div class="check-icon">✔</div>
        <h3>Berhasil 🎉</h3>
        <p>Reservasi berhasil dibuat</p>

        <div style="display:flex;gap:10px;justify-content:center;margin-top:20px">
            <button onclick="closeModal()" class="btn-secondary">Tutup</button>
            <a id="btnNota" class="btn-primary" target="_blank">Unduh Nota</a>
        </div>
    </div>
</div>

<script>
    const select = document.getElementById('layanan-select');
    const chipWrapper = document.getElementById('layanan-chip-wrapper');
    const hiddenInput = document.getElementById('jenis_layanan_input');

    let layananDipilih = [];

    select.addEventListener('change', function () {
        const value = this.value;
        const text = this.options[this.selectedIndex].text;

        if (!value || layananDipilih.includes(value)) {
            this.value = '';
            return;
        }

        layananDipilih.push(value);
        hiddenInput.value = layananDipilih.join(',');

        const chip = document.createElement('div');
        chip.className = 'chip';
        chip.innerHTML = `${text} <span onclick="removeLayanan('${value}', this)">×</span>`;
        chipWrapper.appendChild(chip);

        this.value = '';
    });

    function removeLayanan(value, el) {
        layananDipilih = layananDipilih.filter(v => v !== value);
        hiddenInput.value = layananDipilih.join(',');
        el.parentElement.remove();
    }
</script>

<script>
    const hargaList = @json($hargaList);
</script>

<script>
    function hitungTotal() {
        let total = 0;
        const jumlah = parseInt(document.querySelector('[name="jumlah_item"]')?.value || 0);

        layananDipilih.forEach(kode => {
            const data = hargaList[kode];
            if (!data) return;

            // reservasi hanya satuan (pcs)
            if (data.satuan === 'pcs') {
                total += data.harga * jumlah;
            }
        });

        document.getElementById('total-harga').innerText =
            'Rp ' + total.toLocaleString('id-ID');

        document.getElementById('total_harga_input').value = total;
    }

    document.addEventListener('change', hitungTotal);
    document.addEventListener('keyup', hitungTotal);
</script>

{{-- Alert Tidak bisa hitung harga satuan KG --}}
<script>
    function cekLayananKg() {
        let adaKg = false;

        layananDipilih.forEach(kode => {
            const data = hargaList[kode];
            if (data && data.satuan === 'kg') {
                adaKg = true;
            }
        });

        if (adaKg) {
            alert('⚠️ Reservasi belum mendukung layanan kiloan (kg).\nSilakan lakukan pemesanan langsung.');
        }
    }

    // panggil saat pilih / hapus layanan
    select.addEventListener('change', cekLayananKg);
</script>

<!-- nota -->
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const form = document.getElementById('form-reservasi');
        const btn  = document.getElementById('pickupNow');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            if (!document.getElementById('jenis_layanan_input').value) {
                alert('Pilih minimal 1 jenis layanan');
                return;
            }

            btn.disabled = true;
            btn.innerText = 'Memproses...';

            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(async res => {
                const text = await res.text(); // 🔥 PENTING
                try {
                    return JSON.parse(text);
                } catch (e) {
                    console.error('Response bukan JSON:', text);
                    throw new Error('Invalid JSON');
                }
            })
            .then(data => {
                console.log('RESP:', data);

                if (data.success === true) {
                    document.getElementById('successModal').style.display = 'flex';
                    document.getElementById('btnNota').href =
                        `/reservasi/${data.id}/nota`;
                } else {
                    alert('Reservasi gagal');
                }
            })
            .catch(err => {
                console.error(err);
                alert('Terjadi kesalahan server');
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerText = 'Pickup Now';
            });
        });

    });
</script>

<script>
    function closeModal() {
        document.getElementById('successModal').style.display = 'none';
    }
</script>


{{-- Menentukan Ongkir Berdasarkan Jarak --}}

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    let map;
    let marker;

    window.onload = function() {

        map = L.map('map').setView([-6.200000, 106.816666], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        map.on('click', function(e) {
            setMarker(e.latlng.lat, e.latlng.lng);
        });

        setTimeout(function(){
            map.invalidateSize();
        }, 500);
    };

    function setMarker(lat, lng) {

        if (marker) {
            map.removeLayer(marker);
        }

        marker = L.marker([lat, lng]).addTo(map);
        map.setView([lat, lng], 16);

        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
    }

    function cariLokasi() {

        const keyword = document.getElementById('searchLokasi').value;

        if (!keyword) return alert("Masukkan alamat dulu");

        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${keyword}`)
            .then(res => res.json())
            .then(data => {
                if (data.length > 0) {
                    const lat = data[0].lat;
                    const lon = data[0].lon;
                    setMarker(lat, lon);
                } else {
                    alert("Alamat tidak ditemukan");
                }
            });
    }
</script>

{{-- Menampilkan Ongkir dan Jarak --}}
<script>
    const outletLat = -6.9815723; // 🔥 GANTI sesuai outlet
    const outletLng = 110.3913043;

    function hitungJarakJS(lat1, lon1, lat2, lon2) {
        const R = 6371;
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLon = (lon2 - lon1) * Math.PI / 180;

        const a =
            Math.sin(dLat/2) * Math.sin(dLat/2) +
            Math.cos(lat1 * Math.PI/180) *
            Math.cos(lat2 * Math.PI/180) *
            Math.sin(dLon/2) * Math.sin(dLon/2);

        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
        return R * c;
    }

    function hitungOngkirDanTotal() {

        const lat = parseFloat(document.getElementById('latitude').value);
        const lng = parseFloat(document.getElementById('longitude').value);

        if (!lat || !lng) return;

        const jarak = hitungJarakJS(outletLat, outletLng, lat, lng);
        const tarifPerKm = 3000;

        const ongkir = Math.ceil(jarak) * tarifPerKm;

        document.getElementById('jarak-text').innerText =
            jarak.toFixed(2) + ' km';

        document.getElementById('ongkir-text').innerText =
            'Rp ' + ongkir.toLocaleString('id-ID');

        // ambil total layanan
        const totalLayanan = parseInt(document.getElementById('total_harga_input').value || 0);

        const totalFinal = totalLayanan + ongkir;

        document.getElementById('total-harga').innerText =
            'Rp ' + totalFinal.toLocaleString('id-ID');

        document.getElementById('total_harga_input').value = totalFinal;
    }

    document.addEventListener('change', hitungOngkirDanTotal);
    document.addEventListener('keyup', hitungOngkirDanTotal);
</script>

<style>
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    .modal-box {
        background: #fff;
        padding: 32px;
        border-radius: 16px;
        width: 100%;
        max-width: 480px;   /* desktop */
        min-height: 260px;
        text-align: center;
    }

    .check-icon {
        font-size: 48px;
        color: #22c55e;
    }

    .btn-primary {
        background:#22c55e;
        color:white;
        padding:10px 16px;
        border-radius:8px;
        text-decoration:none;
    }
    .btn-secondary {
        background:#e5e7eb;
        padding:10px 16px;
        border-radius:8px;
    }
</style>

@endsection
