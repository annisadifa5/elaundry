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
            width:58mm;
            padding:6px;
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

        @media print {
            body{ margin:0; }
        }
    </style>
</head>

<body>

<div id="nota">

    <!-- HEADER -->
    <div class="center">
        <strong>{{ $pemesanan->outlet->nama_outlet ?? 'LAUNDIO' }}</strong><br>

        {{ $pemesanan->outlet->jalan ?? '' }}<br>
        {{ $pemesanan->outlet->kota_kab ?? '' }}<br>
        {{ $pemesanan->outlet->no_telp ?? '' }}
    </div>

    <div class="line"></div>

    <!-- INFO -->
    <div class="small">
        Order   : {{ $pemesanan->no_order }}<br>
        Tanggal : {{ $pemesanan->tanggal_masuk }}<br>
        Pelanggan : {{ $pemesanan->customer->nama_lengkap }}
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

    <div class="center small">
        Terima kasih 🙏<br>
        Simpan nota ini
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