<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Barang Keluar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <h3 class="text-center my-4">Edit Data Barang Keluar</h3>
        <a href="{{ route('barangkeluar.index') }}" class="btn btn-secondary mb-3">Kembali</a>
        <form action="{{ route('barangkeluar.update', $barangkeluar->id_keluar) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="id_barang">Nama Barang</label>
                <select name="id_barang" class="form-control" required>
                    @foreach($barangs as $barang)
                        <option value="{{ $barang->id_barang }}" {{ $barangkeluar->id_barang == $barang->id_barang ? 'selected' : '' }}>{{ $barang->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="jumlah">Jumlah Keluar</label>
                <input type="number" name="jumlah" class="form-control" value="{{ $barangkeluar->jumlah }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="harga_satuan">Harga Satuan</label>
                <input type="number" step="0.01" name="harga_satuan" class="form-control" value="{{ $barangkeluar->harga_satuan }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="tanggal_keluar">Tanggal Keluar</label>
                <input type="date" name="tanggal_keluar" class="form-control" value="{{ $barangkeluar->tanggal_keluar }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3">{{ $barangkeluar->keterangan }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
