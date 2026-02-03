@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
    <h3 class="page-title">Dashboard</h3>

    <div class="dashboard-grid">

        <div class="card summary customer">
            <div class="icon">👥</div>
            <div class="info">
                <p>Jumlah Customer</p>
                <h4>{{ $jumlahCustomer }}</h4>
            </div>
        </div>

        <div class="card summary karyawan">
            <div class="icon">👨‍🔧</div>
            <div class="info">
                <p>Jumlah Karyawan</p>
                <h4>{{ $jumlahKaryawan }}</h4>
            </div>
        </div>

        <div class="card summary pemesanan">
            <div class="icon">📦</div>
            <div class="info">
                <p>Total Pemesanan</p>
                <h4>{{ $totalPemesanan }}</h4>
            </div>
        </div>

        <div class="card summary pemasukan">
            <div class="icon">💰</div>
            <div class="info">
                <p>Pemasukan Bulan Ini</p>
                <h4>Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h4>
            </div>
        </div>

        <div class="card summary pengeluaran">
            <div class="icon">💸</div>
            <div class="info">
                <p>Pengeluaran Bulan Ini</p>
                <h4>Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h4>
            </div>
        </div>

        <div class="card summary laba">
            <div class="icon">📈</div>
            <div class="info">
                <p>Laba Bersih</p>
                <h4>Rp {{ number_format($labaBersih, 0, ',', '.') }}</h4>
            </div>
        </div>

    </div>

    <div class="chart-grid">
        <div class="card chart-card">
            <h4>Grafik Pemasukan & Pengeluaran</h4>
            <div class="chart-wrapper">
                <canvas id="chartKeuangan"></canvas>
            </div>
        </div>

        <div class="card chart-card">
            <h4>Grafik Customer Laundry per Bulan</h4>
            <div class="chart-wrapper">
                <canvas id="chartCustomer"></canvas>
            </div>
        </div>
    </div>

    {{-- STYLE DASHBOARD --}}
    <style>
        .page-title {
            font-weight: 600;
            margin-bottom: 16px;
        }

.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
}

        .card.summary {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 18px;
        }

        .card.summary .icon {
            font-size: 28px;
            background: #e0f2f1;
            padding: 12px;
            border-radius: 12px;
        }

        .card.summary .info p {
            font-size: 13px;
            color: #64748b;
            margin: 0;
        }

        .card.summary .info h4 {
            margin: 4px 0 0;
            font-size: 18px;
            font-weight: 600;
            color: #0f172a;
        }

        .card.summary {
            border-left: 5px solid transparent;
        }

        .card.summary.customer {
            border-left-color: #6366f1;
        }

        .card.summary.karyawan {
            border-left-color: #0ea5e9;
        }

        .card.summary.pemesanan {
            border-left-color: #f59e0b;
        }

        .card.summary.pemasukan {
            border-left-color: #22c55e;
        }

        .card.summary.pengeluaran {
            border-left-color: #ef4444;
        }

        .card.summary.laba {
            border-left: 5px solid #16a39a;
        }

        .card.summary {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card.summary:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
        }

        .chart-card {
            padding: 18px;
        }

        .chart-wrapper {
            position: relative;
            height: 320px;   /* TINGGI GRAFIK */
            width: 100%;
        }

        canvas {
            max-width: 100% !important;
        }

        .chart-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        margin-top: 20px;
        }

        /* Tablet & HP → turun ke 1 kolom */
        @media (max-width: 900px) {
            .chart-grid {
                grid-template-columns: 1fr;
            }
        }
        </style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const bulan = @json($bulan);

    // ===== LINE CHART PEMASUKAN & PENGELUARAN =====
    new Chart(document.getElementById('chartKeuangan'), {
        type: 'line',
        data: {
            labels: bulan,
            datasets: [
                {
                    label: 'Pemasukan',
                    data: @json($dataPemasukan),
                    borderWidth: 2,
                    tension: 0.3
                },
                {
                    label: 'Pengeluaran',
                    data: @json($dataPengeluaran),
                    borderWidth: 2,
                    tension: 0.3
                }
            ]
        }
    });

    // ===== BAR CHART CUSTOMER =====
    new Chart(document.getElementById('chartCustomer'), {
        type: 'bar',
        data: {
            labels: bulan,
            datasets: [{
                label: 'Jumlah Customer',
                data: @json($dataCustomer),
                borderWidth: 1
            }]
        }
    });
</script>

@endsection
