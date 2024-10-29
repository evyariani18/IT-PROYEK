<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Data Barang Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Edit Data Barang Masuk</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('barang_masuk.index') }}" class="btn btn-md btn-secondary mb-3">KEMBALI</a>
                        <form action="{{ route('barang_masuk.update', $barangmasuk->id_masuk) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')  <!-- Gunakan metode PUT untuk update -->

                            <div class="form-group mb-3">
                                <label for="id_barang">Nama Barang</label>
                                <select name="id_barang" class="form-control" required>
                                    <option value="">Pilih Merek</option>
                                    @foreach($barangs as $barang)
                                        <option value="{{ $barang->id_barang }}" {{ $barangmasuk->id_barang == $barang->id_barang ? 'selected' : '' }}>{{ $barang->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah', $barangmasuk->jumlah) }}" required>
                                @error('stok')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="harga_satuan">Harga Satuan</label>
                                <input type="number" name="harga_satuan" step="0.01" class="form-control" value="{{ old('harga_satuan', $barangmasuk->harga_satuan) }}" required min="0">
                                @error('harga_satuan')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="harga_total">Harga Total</label>
                                <input type="number" name="harga_total" step="0.01" class="form-control" value="{{ old('harga_total', $barangmasuk->harga_total) }}" required min="0">
                                @error('harga_total')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="supplier">Supplier</label>
                                <input type="text" name="supplier" class="form-control" value="{{ old('supplier', $barangmasuk->supplier) }}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="tanggal_masuk">Tanggal Masuk</label>
                                <input type="date" name="tanggal_masuk" class="form-control" value="{{ old('tanggal_masuk', $barangmasuk->tanggal_masuk) }}">
                                @error('tanggal_masuk')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        //message with sweetalert
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
