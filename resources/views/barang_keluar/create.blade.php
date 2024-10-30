<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Barang Keluar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <h3 class="text-center my-4">Tambah Data Barang Keluar</h3>
        <a href="{{ route('barangkeluar.index') }}" class="btn btn-secondary mb-3">Kembali</a>
        <form action="{{ route('barangkeluar.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="id_barang">Nama Barang</label>
                <select name="id_barang" class="form-control" required>
                    <option value="">Pilih Barang</option>
                    @foreach($barangs as $barang)
                        <option value="{{ $barang->id_barang }}">{{ $barang->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="jumlah">Jumlah Keluar</label>
                <input type="number" name="jumlah" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="harga_satuan">Harga Satuan</label>
                <input type="number" step="0.01" name="harga_satuan" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="tanggal_keluar">Tanggal Keluar</label>
                <input type="date" name="tanggal_keluar" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
