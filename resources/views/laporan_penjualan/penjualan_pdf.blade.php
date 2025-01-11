<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        h3 {
            text-align: center;
            margin-top: 20px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .date-range {
            text-align: center;
            margin-bottom: 10px;
        }

        /* Style for the header box */
        .header-box {
            border: 1px solid #000;
            padding: 10px;
            margin-bottom: 20px;
        }

        .header-box h3 {
            margin: 0;
            font-weight: bold;
            text-align: center;
        }

        .header-box h4 {
            margin: 0;
            font-weight: bold;
            text-align: center;
        }

        .header-box p {
            margin: 5px 0;
            text-align: center;
        }

        .header-box .address {
            margin-top: 10px;
            font-style: italic;
        }

        /* Line before 'Laporan Penjualan' */
        .line {
            border-top: 2px solid black;
            margin-top: 10px;
            margin-bottom: 20px;
        }

    </style>
</head>
<body>

    <!-- Header Section -->
    <div class="header-box">
        <h3>Perlengkapan Rumah Toko Shadad</h3>
        <p>Jl. Datu Daim Pasar Tapandang Berseri I Blok G No 02 Tanah Laut Kalimantan Selatan</p>
        <p>Telepon: (021) 123456789</p>
        <div class="line"></div>
        <h4>Laporan Penjualan</h4>
        <div class="date-range">
            <p>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}</p>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Tanggal Penjualan</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Qty</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grandTotal = 0;
                $no = 1;
            @endphp
            @foreach ($penjualan as $index => $item)
                @foreach ($item->details as $detail)
                    @php
                        $subtotal = $detail->jumlah * $detail->harga_satuan;
                        $grandTotal += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $detail->id_penjualan }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_penjualan)->format('d-m-Y') }}</td>
                        <td>{{ $detail->barang->kode_barang }}</td>
                        <td>{{ $detail->barang->name }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td class="text-right">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                        <td class="text-right">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                        <td class="text-right">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

</body>
</html>
