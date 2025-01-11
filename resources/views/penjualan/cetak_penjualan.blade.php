<!DOCTYPE html>
<html>
<head>
    <title>Nota Penjualan</title>
</head>
<body>
    <h3>Nota Penjualan</h3>

    <div>
        <h3>Tanggal Penjualan: {{ \Carbon\Carbon::parse($penjualan->tanggal_penjualan)->format('d/m/Y') }}</h3>
        <p>Kode Transaksi: {{ $penjualan->id_penjualan }}</p>
        <p>Keterangan: {{ $penjualan->keterangan }}</p>

        <h4>Daftar Barang</h4>
        <table border="1" cellspacing="0" cellpadding="5">
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
            @foreach($penjualan->details as $detail)
            <tr>
                <td>{{ optional($detail->barang)->kode_barang }}</td>
                <td>{{ optional($detail->barang)->name }}</td>
                <td>{{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                <td>{{ $detail->jumlah }}</td>
                <td>{{ number_format($detail->sub_total, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </table>

        <h4>Total Harga: Rp. {{ number_format($penjualan->total_harga, 0, ',', '.') }}</h4>
    </div>
</body>
</html>
