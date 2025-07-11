<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Barang Keluar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 100px;
            height: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 12px;
        }
        .date-range {
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('Logo-PAMR.png') }}" alt="Logo">
        <h2>Laporan Barang Keluar</h2>
    </div>

    <div class="date-range">
        @if($startDate && $endDate)
            <p>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</p>
        @else
            <p>Semua Periode</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Tujuan</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $barang)
                <tr>
                    <td style="text-align: center">{{ $index + 1 }}</td>
                    <td style="text-align: center">{{ \Carbon\Carbon::parse($barang->tanggal)->format('d/m/Y') }}</td>
                    <td style="text-align: center">{{ $barang->kelolaBarang->id_barang }}</td>
                    <td>{{ $barang->kelolaBarang->nama_barang }}</td>
                    <td style="text-align: center">{{ $barang->jumlah }}</td>
                    <td style="text-align: center">{{ $barang->kelolaBarang->satuan->nama_satuan }}</td>
                    <td>{{ $barang->tujuan }}</td>
                    <td>{{ $barang->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html> 