<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - Data Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: #f8f9fa">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Toko Shadad - Dashboard</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('dashboard2.create') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA</a>
                       <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">NO</th>
                                    <th scope="col">NAMA BARANG</th>
                                    <th scope="col">KATEGORI</th>
                                    <th scope="col">MEREK</th>
                                    <th scope="col">STOK</th>
                                    <th scope="col">HARGA</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($barangs as $index => $barang)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $barang->name }}</td>
                                        <td>{{ $barang->category->name }}</td>
                                        <td>{{ $barang->brand->name }}</td>
                                        <td>{{ $barang->stock }}</td>
                                        <td>Rp {{ number_format($barang->price, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('dashboard2.edit', $barang->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            <form onsubmit="return confirm('Apakah Anda yakin?');" action="{{ route('dashboard2.destroy', $barang->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data barang.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        </div>
                        {{ $barangs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Pesan dengan SweetAlert
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
</body>
</html>
