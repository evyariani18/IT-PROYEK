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

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h3 style="text-align: center;">Laporan Pembelian</h3>
    <hr>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Tanggal Pembelian</th>
                <th>Supplier</th>
                <th>Nama Barang</th>
                <th>Qty</th>
                <th>Harga Satuan</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @forelse ($pembelian as $item)
                @foreach ($item->details as $index => $detail)
                    <tr>
                        @if ($index === 0)
                            <td rowspan="{{ $item->details->count() }}">{{ $no++ }}</td>
                            <td rowspan="{{ $item->details->count() }}">{{ $item->id_pembelian }}</td>
                            <td rowspan="{{ $item->details->count() }}">{{ \Carbon\Carbon::parse($item->tanggal_pembelian)->format('d-m-Y') }}</td>
                            <td rowspan="{{ $item->details->count() }}">{{ $item->supplier }}</td>
                        @endif
                        <td>{{ $detail->barang->name }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td>Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="6" style="text-align: right;"><strong>Total Harga:</strong></td>
                    <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Data pembelian tidak tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
