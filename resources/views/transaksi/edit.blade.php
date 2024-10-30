<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: #F8F9FA">

    <div class="container mt-5">
        <h3 class="text-center my-4">Edit Transaksi</h3>

        @if (session('success'))
            <div class="alert alert-success">
                <span class="me-2">&#10003;</span> {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger">
                <span class="me-2">&#10060;</span> {{ session('error') }}
            </div>
        @endif

        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                <form action="{{ route('transaksi.update', $transaksi->id_transaksi) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="id_barang" class="form-label">ID Barang</label>
                        <input type="text" name="id_barang" id="id_barang" class="form-control" value="{{ $transaksi->id_barang }}" readonly>
                        <small class="form-text text-muted">ID barang yang terkait dengan transaksi ini.</small>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ $transaksi->jumlah }}" required min="1">
                    </div>

                    <div class="mb-3">
                        <label for="harga_satuan" class="form-label">Harga Satuan</label>
                        <input type="number" name="harga_satuan" id="harga_satuan" class="form-control" value="{{ $transaksi->harga_satuan }}" required min="0" step="0.01">
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                        <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" value="{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('Y-m-d') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" rows="3">{{ $transaksi->keterangan }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
