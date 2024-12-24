<!DOCTYPE html>
<html>
<head>
    <title>Cetak Pembelian</title>
</head>
<body>
    <h1>Laporan Pembelian</h1>

    @foreach($pembelian as $item)
    <div>
        <h3>Tanggal Pembelian: {{ \Carbon\Carbon::parse($item->tanggal_pembelian)->format('d/m/Y') }}</h3>
        <p>Supplier: {{ $item->supplier }}</p>

        <h4>Daftar Barang</h4>
        <table border="1" cellspacing="0" cellpadding="5">
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
            @foreach($item->details as $detail)
            <tr>
                <td>{{ optional($detail->barang)->kode_barang }}</td>
                <td>{{ optional($detail->barang)->name }}</td>
                <td>{{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                <td>{{ $detail->jumlah }}</td>
                <td>{{ number_format($detail->sub_total, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </table>

        <h4>Total Harga: Rp. {{ number_format($item->total_harga, 0, ',', '.') }}</h4>
        <hr>
    </div>
    @endforeach
</body>
</html>
