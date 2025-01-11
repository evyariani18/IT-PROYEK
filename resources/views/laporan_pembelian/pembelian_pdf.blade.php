<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembelian</title>
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

        /* Line before 'Laporan Pembelian' */
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
        <h4>Laporan Pembelian</h4>
        <div class="date-range">
            <p>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}</p>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Tanggal Pembelian</th>
                <th>Supplier</th>
                <th>Nama Barang</th>
                <th>Qty</th>
                <th>Harga Satuan</th>
                <th>Sub Total</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
                $currentTransaction = null;
            @endphp
            @foreach ($pembelian as $item)
                @foreach($item->details as $detail)
                    <tr>
                        @if($currentTransaction !== $item->id_pembelian)
                            <td class="text-center" rowspan="{{ $item->details->count() }}">{{ $no++ }}</td>
                            <td rowspan="{{ $item->details->count() }}">{{ $item->id_pembelian }}</td>
                            <td rowspan="{{ $item->details->count() }}">{{ \Carbon\Carbon::parse($item->tanggal_pembelian)->format('d-m-Y') }}</td>
                            <td rowspan="{{ $item->details->count() }}">{{ $item->supplier }}</td>
                            @php
                                $currentTransaction = $item->id_pembelian;
                            @endphp
                        @endif
                        <td>{{ $detail->barang->name }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td class="text-right">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                        <td class="text-right">Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                        <td class="text-right">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

</body>
</html>
