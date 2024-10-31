<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body style="background: #F8F9FA">

    <div class="container mt-5">
        <h3 class="text-center my-4">Data Transaksi</h3>

        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                <a href="{{ route('transaksi.create') }}" class="btn btn-success mb-3">Tambah Transaksi</a>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>NO</th>
                                <th>NAMA BARANG</th>
                                <th>JUMLAH</th>
                                <th>HARGA SATUAN</th>
                                <th>HARGA TOTAL</th>
                                <th>TANGGAL TRANSAKSI</th>
                                <th>KETERANGAN</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transaksi as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->barang->name}}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>{{ $item->harga_satuan, 2 }}</td>
                                    <td>{{ $item->harga_total, 2 }}</td>
                                    <td>{{ $item->tanggal_transaksi }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda yakin?');" action="{{ route('transaksi.destroy', $item->id_transaksi) }}" method="POST">
                                            <a href="{{ route('transaksi.edit', $item->id_transaksi) }}" class="btn btn-primary btn-sm">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <div class="alert alert-danger">Data Transaksi belum tersedia.</div>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $transaksi->links() }} <!-- Pagination -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Menampilkan pesan dengan SweetAlert
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'BERHASIL',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'GAGAL!',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
</body>
</html>
