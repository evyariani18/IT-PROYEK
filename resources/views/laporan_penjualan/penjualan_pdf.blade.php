<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            border: 2px solid #000;
            padding: 20px;
            margin: 20px;
            border-radius: 5px;
        }
        .header-section {
            text-align: center;
            margin-bottom: 20px;
        }
        .header-section img {
            max-width: 130px;
            height: auto;
        }
        .header-details {
            text-align: left;
            margin-bottom: 20px;
        }
        .thead-style {
            background-color: #BC9F8B;
            color: white;
            text-align: center;
        }
        .tbody-style {
            background-color: #E7E8D8;
        }
        .signature-section {
            margin-top: 30px;
            text-align: right;
        }
        .signature-line {
            margin-top: 50px;
            border-top: 1px solid black;
            margin-bottom: 5px;
        }
        .signature-label {
            margin-top: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: center;
        }
        td {
            background-color: #F8F9FA;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Header Section -->
    <div class="header-section">
    <img src="{{ asset('storage/images/logo.png') }}" alt="Logo Toko Shadad" style="width: 130px; height: auto;">
        <h3>Perlengkapan Rumah Toko Shadad</h3>
        <p>Jl. Datu Daim Pasar Tapandang Berseri I Blok G No 02 Tanah Laut Kalimantan Selatan</p>
    </div>

    <!-- Kode Transaksi dan Tanggal -->
    <div class="header-details">
        <p><strong>Kode Transaksi:</strong> {{ $penjualan->first()->id_penjualan ?? '---' }}</p>
        <p><strong>Tanggal:</strong> {{ now()->format('d-m-Y') }}</p>
    </div>

    <!-- Tabel Penjualan -->
    <table>
        <thead class="thead-style">
            <tr>
                <th>NO</th>
                <th>KODE BARANG</th>
                <th>NAMA BARANG</th>
                <th>QTY</th>
                <th>HARGA SATUAN</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody class="tbody-style">
            @php $grandTotal = 0; @endphp
            @foreach ($penjualan as $item)
                @foreach ($item->details as $detail)
                    @php 
                        $subtotal = $detail->jumlah * $detail->harga_satuan; 
                        $grandTotal += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $detail->barang->kode_barang }}</td>
                        <td>{{ $detail->barang->name }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td>Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            @endforeach
            <tr>
                <td colspan="5" style="text-align:right; font-weight:bold;">Total:</td>
                <td><strong>Rp {{ number_format($grandTotal, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

    <!-- Tanda Tangan -->
    <div class="signature-section">
        <div class="signature-line"></div>
        <p class="signature-label">Kasir</p>
    </div>
</div>

</body>
</html>
