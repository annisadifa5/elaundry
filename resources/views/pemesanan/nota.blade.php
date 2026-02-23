<!DOCTYPE html>
<html>
<head>
    <title>Nota Laundry</title>

    <style>
        body{
            font-family: monospace;
            font-size:12px;
        }

        #nota{
            width:80mm;
            padding:8px;
        }

        .center{ text-align:center; }

        .line{
            border-top:1px dashed #000;
            margin:6px 0;
        }

        .row{
            display:flex;
            justify-content:space-between;
        }

        .small{ font-size:11px; }

        .bold{
            font-weight:bold;
        }

        @media print {
            body{ margin:0; }
        }

        .row{
            display:flex;
            justify-content:space-between;
            margin:2px 0;
        }
    </style>
</head>

<body>

<div id="nota">

    <!-- HEADER -->
    <div class="center">
        <strong>{{ $pemesanan->outlet->nama_outlet ?? 'LAUNDIO' }}</strong><br>

        {{ $pemesanan->outlet->jalan ?? '' }}<br>
        {{ $pemesanan->outlet->kelurahan ?? '' }},
        {{ $pemesanan->outlet->kecamatan ?? '' }}<br>
        {{ $pemesanan->outlet->kota_kab ?? '' }},
        {{ $pemesanan->outlet->provinsi ?? '' }}
        {{ $pemesanan->outlet->kode_pos ?? '' }}<br>

        Telp: {{ $pemesanan->outlet->no_telp ?? '-' }}
    </div>

    <div class="line"></div>

    <!-- INFO ORDER -->
    <div class="small">
        Order   : {{ $pemesanan->no_order }}<br>
        Tanggal : {{ $pemesanan->tanggal_masuk }}<br>
        Pelanggan : {{ $pemesanan->customer->nama_lengkap }}<br>
        No. HP  : {{ $pemesanan->customer->no_telp ?? '-' }}<br>
        Alamat  : {{ $pemesanan->customer->alamat ?? '-' }}
    </div>

    @if($pemesanan->latitude && $pemesanan->longitude)
    <div class="small">
        Lokasi :
        <a href="https://www.google.com/maps?q={{ $pemesanan->latitude }},{{ $pemesanan->longitude }}"
        target="_blank">
            Buka Maps
        </a>
    </div>
    @endif

    <div class="line"></div>

    <!-- DETAIL LAYANAN -->
    <div class="center bold small">Detail Layanan</div>

    <div class="line"></div>

    @php
    use App\Models\Harga;

    $layananList = explode(',', $pemesanan->jenis_layanan);

    $qty = $pemesanan->berat_cucian 
            ?? $pemesanan->jumlah_item 
            ?? 1;
    @endphp

    @foreach($layananList as $kode)

    @php
    $harga = Harga::where('kode_layanan',$kode)->first();
    $nama  = $harga->nama_layanan ?? ucwords(str_replace('_',' ',$kode));
    $satuan = $harga->satuan ?? 'pcs';
    $hargaSatuan = $harga->harga ?? 0;

    $totalItem = $hargaSatuan * $qty;
    @endphp

    <div class="row">
        <span>{{ $nama }}</span>
    </div>

    <div class="row small">
        <span>{{ $qty }} {{ $satuan }} × {{ number_format($hargaSatuan,0,',','.') }}</span>
        <span>Rp {{ number_format($totalItem,0,',','.') }}</span>
    </div>

    @endforeach

    <!-- Jika ada berat
    @if(!empty($pemesanan->berat_cucian))
    <div class="row small">
        <span>Berat</span>
        <span>{{ $pemesanan->berat_cucian }} kg</span>
    </div>
    @endif -->

    <!-- Jika ada jumlah item -->
    @if(!empty($pemesanan->jumlah_item))
    <div class="row small">
        <span>Jumlah Item</span>
        <span>{{ $pemesanan->jumlah_item }} pcs</span>
    </div>
    @endif

    <div class="line"></div>

    <!-- SUBTOTAL -->
    <div class="row">
        <span>Subtotal</span>
        <span>Rp {{ number_format($pemesanan->total_harga,0,',','.') }}</span>
    
    <!-- tiara -->
    @php
        $detail = json_decode($pemesanan->detail_layanan ?? '[]', true);
        $detail = is_array($detail) ? $detail : [];
        $totalLayanan = 0;
    @endphp

    @if(count($detail) > 0)

        @foreach($detail as $item)

            @php
                $layanan = \App\Models\Harga::where('kode_layanan',$item['kode_layanan'])->first();
                $harga = $layanan->harga ?? 0;
                $qty = $item['qty'];
                $subtotal = $harga * $qty;
                $totalLayanan += $subtotal;
            @endphp

            <div class="row">
                <span>{{ $layanan->nama_layanan ?? '-' }}</span>
                <span>Rp {{ number_format($subtotal,0,',','.') }}</span>
            </div>

            <div class="small">
                {{ $qty }} x Rp {{ number_format($harga,0,',','.') }}
            </div>

            <div class="line"></div>

        @endforeach

    @else

        <!-- fallback untuk order lama -->
        <div class="row">
            <span>Layanan</span>
            <span>Rp {{ number_format($pemesanan->total_harga - $pemesanan->ongkir,0,',','.') }}</span>
        </div>

    @endif

    {{-- <div class="line"></div> --}}

    <!-- JARAK & ONGKIR -->
    <div class="row">
        <span>Jarak</span>
        <span>{{ number_format($pemesanan->jarak_km,2) }} km</span>
    </div>

    <div class="row">
        <span>Ongkir</span>
        <span>Rp {{ number_format($pemesanan->ongkir,0,',','.') }}</span>
    
    </div>

    <div class="line"></div>

    <!-- TOTAL -->
    <div class="row">
        <strong>Total</strong>
        <strong>Rp {{ number_format($pemesanan->total_harga,0,',','.') }}</strong>
    </div>

    <div class="line"></div>

    <!-- STATUS -->
    <div class="small">
        Status Proses : {{ ucfirst($pemesanan->status_proses ?? 'diterima') }}<br>
        Status Bayar  : {{ ucfirst($pemesanan->status_bayar ?? 'belum') }}
    </div>

    <div class="line"></div>

    <!-- JADWAL
    <div class="small">
        Tgl Jemput : {{ $pemesanan->tanggal_jemput ?? '-' }}<br>
        Jam Jemput : {{ $pemesanan->jam_jemput ?? '-' }}<br>
        Estimasi Selesai : {{ $pemesanan->estimasi_selesai ?? '-' }}
    </div>

    <div class="line"></div> -->

    <!-- CATATAN -->
    @if(!empty($pemesanan->catatan_khusus))
    <div class="small">
        Catatan:<br>
        {{ $pemesanan->catatan_khusus }}
    </div>

    <div class="line"></div>
    @endif

    <!-- FOOTER -->
    <div class="center small">
        Terima kasih telah mempercayakan cucian Anda 🙏  <br>
        Bersih Tak Kenal Waktu <br>
        Simpan nota ini<br><br>

        Jam Operasional : 08.00 - 21.00<br>
        WA : {{ $pemesanan->outlet->no_telp ?? '-' }}
    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
<script>
html2canvas(document.querySelector("#nota")).then(canvas => {
    let link = document.createElement('a');
    link.download = 'nota-{{ $pemesanan->id_pemesanan }}.png';
    link.href = canvas.toDataURL();
    link.click();

    window.print();
});
</script>

</body>
</html>