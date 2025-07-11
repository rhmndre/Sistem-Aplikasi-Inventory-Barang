<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Stok Barang</title>
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
        .warning {
            color: #ff0000;
            font-weight: bold;
        }
        .status {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
        }
        .status-minimum {
            background-color: #fee2e2;
            color: #dc2626;
        }
        .status-aman {
            background-color: #dcfce7;
            color: #16a34a;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('Logo-PAMR.png') }}" alt="Logo">
        <h2>Laporan Stok Barang</h2>
        <p>{{ $filter === 'minimum' ? 'Stok Minimum' : 'Semua Stok' }}</p>
        <p>Tanggal: {{ now()->format('d/m/Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Jenis Barang</th>
                <th>Stok</th>
                <th>Satuan</th>
                <th>Minimum</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $barang)
                <tr>
                    <td style="text-align: center">{{ $index + 1 }}</td>
                    <td style="text-align: center">{{ $barang['id_barang'] }}</td>
                    <td>{{ $barang['nama_barang'] }}</td>
                    <td>{{ $barang['jenis_barang'] }}</td>
                    <td style="text-align: center" @if($barang['stok'] <= $barang['minimum']) class="warning" @endif>
                        {{ $barang['stok'] }}
                    </td>
                    <td style="text-align: center">{{ $barang['satuan'] }}</td>
                    <td style="text-align: center">{{ $barang['minimum'] }}</td>
                    <td style="text-align: center">
                        @if($barang['stok'] <= $barang['minimum'])
                            <span class="status status-minimum">Stok Minimum</span>
                        @else
                            <span class="status status-aman">Stok Aman</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html> 