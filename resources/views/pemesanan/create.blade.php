@extends(
    auth()->user()->role === 'admin'
        ? 'layouts.dashboard'
        : 'layouts.dashboard_kasir'
)

@section('title', 'Pemesanan Laundio')

@section('content')
<div class="page-title">Pemesanan Laundio</div>

<div class="card">
    <h4>Form Pemesanan Laundio</h4>

    @if ($errors->any())
        <div style="color:red; margin-bottom:10px">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="form-pemesanan" method="POST" action="{{ route('pemesanan.store') }}">
    @csrf
    <input type="hidden" name="id_outlet" value="3">

    {{-- SECTION CUSTOMER --}}
    <div class="card-section">
        <div class="section-title">Data Customer</div>

        <div class="row">
            <input type="text" name="nama_lengkap" placeholder="Nama Customer" required>
            <input type="text" name="no_telp" placeholder="No Telepon" required>
        </div>

        <div class="row">
            <textarea id="alamat" name="alamat" placeholder="Alamat" required></textarea>
        </div>

        <div id="map" style="height:300px;border-radius:12px;margin-top:10px;"></div>

        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">
    </div>

    {{-- SECTION DETAIL --}}
    <div class="card-section">
        <div class="section-title">Detail Layanan</div>

        <div class="row-item header-row">
            <div>Jenis</div>
            <div>Harga</div>
            <div>Qty</div>
            <div>Total</div>
            <div></div>
        </div>

        <div id="layanan-container"></div>

        <button type="button" onclick="tambahRow()" class="btn-add">
            + Tambah
        </button>
    </div>

    {{-- TOTAL --}}
    <div class="total-box">
        <span>Total Pembayaran</span>
        <span id="grand-total">Rp 0</span>
    </div>

    <input type="hidden" name="total_harga" id="total_harga_input">
    <input type="hidden" name="detail_layanan" id="detail_layanan_input">

    {{-- CATATAN --}}
    <div class="card-section">
        <div class="section-title">Catatan</div>
        <textarea name="catatan_khusus" placeholder="Catatan Khusus"></textarea>
    </div>

    <div style="text-align:right; margin-top:10px;">
        <button class="btn-submit">Pesan</button>
    </div>

    {{-- Untuk Maps --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    </form>
</div>

<div id="successModal" class="modal-overlay" style="display:none">
    <div class="modal-box">
        <div class="check-icon">✔</div>
        <h3>Berhasil 🎉</h3>
        <p>Pemesanan berhasil dibuat</p>

        <div style="display:flex;gap:10px;justify-content:center;margin-top:20px">
            <button onclick="closeModal()" class="btn-secondary">Tutup</button>
            <a id="btnNota" class="btn-primary" target="_blank">Unduh Nota</a>
        </div>
    </div>
</div>

<!-- Nota -->
<script>
    document.getElementById('form-pemesanan').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = this;
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                document.getElementById('successModal').style.display = 'flex';

                // arahkan tombol nota
                document.getElementById('btnNota')
                    .href = `/pemesanan/${res.id}/nota`;
            }
        })
        .catch(err => {
            alert('Terjadi kesalahan');
        });
    });

    function closeModal() {
        document.getElementById('successModal').style.display = 'none';
    }
</script>



{{-- Jenis layanan --}}
<script>
    const hargaList = @json($hargaList);
    let rowIndex = 0;

    function generateOptgroup() {

        let grouped = {};

        hargaList.forEach(h => {
            if (!grouped[h.kategori]) {
                grouped[h.kategori] = [];
            }
            grouped[h.kategori].push(h);
        });

        let html = '';

        Object.keys(grouped).forEach(kategori => {

            html += `<optgroup label="${capitalize(kategori)}">`;

            grouped[kategori].forEach(h => {
                html += `
                    <option value="${h.kode_layanan}" data-harga="${h.harga}">
                        ${h.nama_layanan}
                    </option>
                `;
            });

            html += `</optgroup>`;
        });

        return html;
    }

    function capitalize(text) {
        return text.charAt(0).toUpperCase() + text.slice(1);
    }

    function tambahRow() {

        const container = document.getElementById('layanan-container');

        const row = document.createElement('div');
        row.className = 'row-item';

        row.innerHTML = `
            <select onchange="updateHarga(${rowIndex})" id="layanan_${rowIndex}">
                <option value="">Pilih Layanan</option>
                ${generateOptgroup()}
            </select>

            <input type="text" id="harga_${rowIndex}" readonly>

            <input type="number" min="1" value="1"
                oninput="hitungRow(${rowIndex})"
                id="qty_${rowIndex}">

            <input type="text" id="total_${rowIndex}" readonly>

            <button type="button" class="btn-remove" onclick="hapusRow(this)">✕</button>
        `;

        container.appendChild(row);
        rowIndex++;
    }

    function updateHarga(i) {

        const select = document.getElementById(`layanan_${i}`);
        const hargaInput = document.getElementById(`harga_${i}`);

        const harga = parseInt(select.selectedOptions[0]?.dataset.harga || 0);

        hargaInput.value = formatRupiah(harga);

        hitungRow(i);
    }

    function hitungRow(i) {

        const select = document.getElementById(`layanan_${i}`);
        const harga = parseInt(select.selectedOptions[0]?.dataset.harga || 0);
        const qty = parseInt(document.getElementById(`qty_${i}`).value || 0);

        const total = harga * qty;

        document.getElementById(`total_${i}`).value = formatRupiah(total);

        hitungGrandTotal();
    }

    function hitungGrandTotal() {

        let total = 0;

        for (let i = 0; i < rowIndex; i++) {
            const totalField = document.getElementById(`total_${i}`);
            if (!totalField) continue;

            const value = totalField.value.replace(/[^\d]/g,'');
            total += parseInt(value || 0);
        }

        document.getElementById('grand-total')
            .innerText = formatRupiah(total);

        document.getElementById('total_harga_input')
            .value = total;

        simpanDetail();
    }

    function hapusRow(btn) {
        btn.parentElement.remove();
        hitungGrandTotal();
    }

    function formatRupiah(angka) {
        return 'Rp ' + Number(angka).toLocaleString('id-ID');
    }

    function simpanDetail() {

        let detail = [];

        for (let i = 0; i < rowIndex; i++) {

            const select = document.getElementById(`layanan_${i}`);
            const qty = document.getElementById(`qty_${i}`);

            if (!select || !qty) continue;
            if (!select.value) continue;

            detail.push({
                kode_layanan: select.value,
                qty: qty.value
            });
        }

        document.getElementById('detail_layanan_input')
            .value = JSON.stringify(detail);
    }

    document.addEventListener('DOMContentLoaded', tambahRow);
</script>

{{-- Maps dan Ongkir --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {

        const outletLat = -6.9815723;
        const outletLng = 110.3913043;

        const outlet = L.latLng(outletLat, outletLng);

        const map = L.map('map').setView([outletLat, outletLng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        L.marker([outletLat, outletLng])
            .addTo(map)
            .bindPopup("Lokasi Outlet");

        let customerMarker;

        function hitungOngkir(customerLat, customerLng) {

            const customer = L.latLng(customerLat, customerLng);
            const jarakMeter = outlet.distanceTo(customer);
            const jarakKm = jarakMeter / 1000;

            const ongkirPerKm = 3000; // Rp 3.000 per km
            const ongkir = Math.round(jarakKm * ongkirPerKm);

            return ongkir;
        }

        function updateGrandTotalDenganOngkir(ongkir) {

            let totalLayanan = 0;

            for (let i = 0; i < rowIndex; i++) {
                const totalField = document.getElementById(`total_${i}`);
                if (!totalField) continue;

                const value = totalField.value.replace(/[^\d]/g,'');
                totalLayanan += parseInt(value || 0);
            }

            const grandTotal = totalLayanan + ongkir;

            document.getElementById('grand-total')
                .innerText = formatRupiah(grandTotal);

            document.getElementById('total_harga_input')
                .value = grandTotal;
        }

        function setCustomerMarker(lat, lng) {

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            if (customerMarker) {
                map.removeLayer(customerMarker);
            }

            customerMarker = L.marker([lat, lng]).addTo(map);
            map.setView([lat, lng], 16);

            const ongkir = hitungOngkir(lat, lng);
            updateGrandTotalDenganOngkir(ongkir);
        }

        // Klik manual
        map.on('click', function (e) {
            setCustomerMarker(e.latlng.lat, e.latlng.lng);
        });

        // Auto geocode alamat
        const alamatInput = document.getElementById('alamat');
        let timer;

        alamatInput.addEventListener('input', function () {

            clearTimeout(timer);

            timer = setTimeout(() => {

                const alamat = alamatInput.value.trim();
                if (alamat.length < 5) return;

                fetch(`https://nominatim.openstreetmap.org/search?format=json&limit=1&q=${encodeURIComponent(alamat)}`)
                .then(res => res.json())
                .then(data => {

                    if (data.length > 0) {
                        const lat = parseFloat(data[0].lat);
                        const lon = parseFloat(data[0].lon);
                        setCustomerMarker(lat, lon);
                    }

                }).catch(err => console.log(err));

            }, 1000);

        });

    });
</script>


<style>
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,.4);
        display:flex;
        align-items:center;
        justify-content:center;
        z-index:9999;
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
        font-size:48px;
        color:#22c55e;
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
    .card-section {
        background: #ffffff;
        padding: 20px;
        border-radius: 14px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.05);
        margin-bottom: 20px;
    }

    .section-title {
        font-weight: 600;
        margin-bottom: 15px;
        font-size: 15px;
        color: #111827;
    }

    .row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 12px;
    }

    .row textarea {
        grid-column: span 2;
    }

    .row-item {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr auto;
        gap: 10px;
        align-items: center;
        margin-bottom: 8px;
    }

    .header-row {
        font-weight: 600;
        font-size: 13px;
        color: #6b7280;
    }

    input, select, textarea {
        padding: 9px 12px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
    }

    .btn-add {
        margin-top: 10px;
        background: #22c55e;
        color: white;
        padding: 8px 14px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
    }

    /* TOTAL LEBIH SOFT & GEN Z */
    .total-box {
        background: linear-gradient(135deg, #f0fdf4, #ecfeff);
        padding: 14px 18px;
        border-radius: 18px;
        font-size: 15px;
        font-weight: 600;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 20px 0;
        border: 1px solid #d1fae5;
    }

    #grand-total {
        font-size: 18px;
        font-weight: 700;
        color: #16a34a;
    }

    /* BUTTON PESAN LEBIH SLIM */
    .btn-submit {
        width: auto;
        padding: 10px 22px;
        border-radius: 999px;
        border: none;
        background: linear-gradient(135deg, #22c55e, #16a34a);
        color: white;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 6px 16px rgba(34,197,94,0.25);
    }

    /* Hover effect biar modern */
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 22px rgba(34,197,94,0.35);
    }
    .btn-remove {
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fee2e2;
        border-radius: 10px;
        width: 32px;
        height: 32px;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.2s ease;
    }

    .btn-remove:hover {
        background: #dc2626;
        color: white;
        transform: scale(1.05);
    }
</style>

@endsection
