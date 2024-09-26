<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        @page {
            size: A4;
            margin: 15mm 10mm 15mm 10mm;
            margin: 0 0 0;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            line-height: 1.3;
            color: #333;
        }

        .title {
            text-align: center;
            margin-bottom: 15px;
        }

        .title h2 {
            margin: 0;
            color: #444;
            font-size: 18px;
        }

        .title h5 {
            margin: 3px 0;
            color: #666;
            font-size: 13px;
        }

        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .main-table th,
        .main-table td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
        }

        .main-table th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
        }

        .main-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .summary-section {
            margin-top: 20px;
            border-top: 2px solid #444;
            padding-top: 15px;
        }

        .summary-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #444;
        }

        .summary-table {
            width: 100%;
            border-collapse: collapse;
        }

        .summary-table td {
            padding: 5px;
            vertical-align: top;
            border: none;
        }

        .summary-label {
            font-weight: bold;
            color: #666;
            font-size: 10px;
        }

        .summary-value {
            color: #333;
            font-size: 11px;
        }

        .text-right {
            text-align: right;
        }

        @media print {
            thead {
                display: table-header-group;
            }
        }

        body {
            margin-top: 2cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
        }

        .header {
            width: 100%;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 5px;
        }

        .logo {
            width: 100px;
            height: auto;
        }

        .company-name {
            font-size: 18pt;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .company-address {
            font-size: 10pt;
            line-height: 1.3;
        }

        .document-title {
            font-size: 16pt;
            font-weight: bold;
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>

<body onload="window.print()">

    <div class="title">
        <h2>{{ $title }}</h2>
        <h5>Periode {{ $periode }}</h5>
        {{-- <h5>Jenis Penjualan: Semua</h5> --}}
    </div>

    <table class="main-table">
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>NAMA LENGKAP</th>
                <th>NAMA PERUSAHAAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data['detail-alumni-bekerja'] as $dt)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $dt['nik'] }}</td>
                    <td>{{ $dt['nama'] }}</td>
                    <td>{{ $dt['nama-perusahaan'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <div class="summary-section">
        <h3 class="summary-title">Ringkasan Penjualan</h3>
        <table class="summary-table">
            <tr>
                <td width="25%">
                    <div class="summary-label">Total Pendapatan:</div>
                    <div class="summary-value"><strong>Rp 2.250.000</strong></div>
                </td>
                <td width="25%">
                    <div class="summary-label">Jumlah Transaksi:</div>
                    <div class="summary-value">3</div>
                </td>
                <td width="25%">
                    <div class="summary-label">Rata-rata per Transaksi:</div>
                    <div class="summary-value">Rp 750.000</div>
                </td>
                <td width="25%">
                    <div class="summary-label">Total Produk Terjual:</div>
                    <div class="summary-value">18 pcs</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="summary-label">Penjualan Tertinggi:</div>
                    <div class="summary-value">Rp 1.000.000</div>
                </td>
                <td>
                    <div class="summary-label">Penjualan Terendah:</div>
                    <div class="summary-value">Rp 500.000</div>
                </td>
                <td>
                    <div class="summary-label">Penjualan Di Toko:</div>
                    <div class="summary-value">1 transaksi</div>
                </td>
                <td>
                    <div class="summary-label">Penjualan Dikirim:</div>
                    <div class="summary-value">2 transaksi</div>
                </td>
            </tr>
        </table>
    </div> --}}

    <div class="summary">
        {{-- <p class="text-right">Nama Admin: <strong>Haji Ibrahim</strong></p> --}}
        <p class="text-right">Tanggal Cetak: <strong>{{ now() }}</strong></p>
    </div>
</body>

</html>
