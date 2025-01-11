<!DOCTYPE html>
<html>
<head>
    <title>Nota Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
        }

        .header p {
            margin: 5px 0;
        }

        .info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .info .left,
        .info .right {
            width: 48%;
        }

        .info .right {
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        .signature {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .signature div {
            width: 48%;
            text-align: center;
        }

        .signature div p {
            margin: 50px 0 0 0;
            border-top: 1px solid black;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Perlengkapan Rumah Toko Shadad</h1>
        <p>Jl. Datu Daim Pasar Tapandang Berseri I Blok G No 02 Tanah Laut Kalimantan Selatan</p>
        <p>Telp: 0355 324203</p>
    </div>

    <div class="info">
        <div class="left">
            <p>Tgl: {{ \Carbon\Carbon::parse($pembelian->tanggal_pembelian)->format('d/m/Y') }}</p>
            <p>Kode Transaksi: {{ $pembelian->id_pembelian }}</p>
            <p>Supplier: {{ $pembelian->supplier }}</p>
        </div>
    </div>

    <h4>Daftar Barang</h4>
    <table>
        <tr>
            <th>No.</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
        </tr>
        @foreach($pembelian->details as $detail)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ optional($detail->barang)->name }}</td>
            <td>{{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
            <td>{{ $detail->jumlah }}</td>
            <td>{{ number_format($detail->sub_total, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>

    <h4>Total Harga: Rp. {{ number_format($pembelian->total_harga, 0, ',', '.') }}</h4>

    <div class="signature">
        <div>
            <p>Hormat Kami</p>
        </div>
    </div>

</body>
</html>
