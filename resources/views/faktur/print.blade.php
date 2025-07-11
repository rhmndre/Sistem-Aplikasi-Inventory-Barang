<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faktur #{{ $faktur->nomor_faktur }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 14px;
        }
        .header {
            border-bottom: 2px solid #eee;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .company-info {
            float: left;
            width: 60%;
        }
        .faktur-info {
            float: right;
            width: 40%;
            text-align: right;
        }
        .logo {
            max-height: 80px;
            margin-bottom: 10px;
        }
        .clear {
            clear: both;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .total-row {
            font-weight: bold;
            border-top: 2px solid #000;
        }
        .footer {
            margin-top: 40px;
        }
        .notes {
            float: left;
            width: 60%;
        }
        .signature {
            float: right;
            width: 40%;
            text-align: right;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-info">
            <img src="{{ public_path('Logo-PAMR.png') }}" alt="Logo" class="logo">
            <h3 style="margin: 0 0 10px 0;">PT. Pupuk Alam Makmur Raya</h3>
            <p style="margin: 0;">Jl. Raya Pupuk No. 123</p>
            <p style="margin: 0;">Telp: (021) 123-4567</p>
            <p style="margin: 0;">Email: info@pamr.co.id</p>
        </div>
        <div class="faktur-info">
            <h1 style="margin: 0 0 20px 0;">FAKTUR</h1>
            <p style="margin: 0;">Nomor: {{ $faktur->nomor_faktur }}</p>
            <p style="margin: 0;">Tanggal: {{ \Carbon\Carbon::parse($faktur->tanggal_faktur)->format('d/m/Y') }}</p>
            <p style="margin: 0;">ID Transaksi: {{ $faktur->id_transaksi }}</p>
        </div>
        <div class="clear"></div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Jenis</th>
                <th class="text-center">Jumlah</th>
                <th class="text-right">Harga Satuan</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $faktur->nama_barang }}</td>
                <td>{{ $faktur->jenis_barang }}</td>
                <td class="text-center">{{ $faktur->jumlah }} {{ $faktur->satuan }}</td>
                <td class="text-right">Rp {{ number_format($faktur->harga_satuan, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($faktur->total_harga, 0, ',', '.') }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="4" class="text-right">Total:</td>
                <td class="text-right">Rp {{ number_format($faktur->total_harga, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    @if($faktur->keterangan)
        <div style="margin: 20px 0;">
            <h4 style="margin: 0 0 10px 0;">Keterangan:</h4>
            <p style="margin: 0;">{{ $faktur->keterangan }}</p>
        </div>
    @endif

    <div class="footer">
        <div class="notes">
            <p style="margin: 0 0 5px 0;">Catatan:</p>
            <p style="margin: 0;">1. Faktur ini adalah bukti resmi pembayaran</p>
            <p style="margin: 0;">2. Mohon simpan faktur ini sebagai bukti transaksi</p>
        </div>
        <div class="signature">
            <p style="margin: 0 0 80px 0;">Hormat kami,</p>
            <p style="margin: 0;">PT. Pupuk Alam Makmur Raya</p>
        </div>
        <div class="clear"></div>
    </div>
</body>
</html> 