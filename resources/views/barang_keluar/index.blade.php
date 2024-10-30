<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang Keluar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Tambahkan SweetAlert -->
</head>
<body style="background: #F8F9FA">

    <div class="container mt-5">
        <h3 class="text-center my-4">Data Barang Keluar</h3>

        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                <a href="{{ route('barangkeluar.create') }}" class="btn btn-success mb-3">Tambah Barang Keluar</a>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Keluar</th>
                                <th>Tanggal Keluar</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($barangkeluar as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->barang->name }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_keluar)->format('d M Y') }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda yakin?');" action="{{ route('barangkeluar.destroy', $item->id_keluar) }}" method="POST">
                                            <a href="{{ route('barangkeluar.edit', $item->id_keluar) }}" class="btn btn-primary btn-sm">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center alert alert-danger">Data Barang Keluar belum tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $barangkeluar->links() }} <!-- Pagination -->
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
