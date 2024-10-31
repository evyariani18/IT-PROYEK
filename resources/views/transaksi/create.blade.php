<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: #F8F9FA">

    <div class="container mt-5">
        <h3 class="text-center my-4">Tambah Transaksi</h3>

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
                        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">KEMBALI</a>
                        <form action="{{ route('transaksi.store') }}" method="POST">
                            @csrf
                            
                <div class="mb-3">
                    <label for="id_barang" class="form-label">Nama Barang</label>
                    <select name="id_barang" id="id_barang" class="form-control" required>
                        <option value="">Pilih Barang</option>
                        @foreach($barangs as $barang) <!-- Menggunakan variabel $barangs -->
                        <option value="{{ $barang->id_barang }}" data-harga="{{ $barang->harga }}">{{ $barang->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="harga_satuan" class="form-label">Harga Satuan</label>
                    <input type="number" name="harga_satuan" id="harga_satuan" class="form-control" readonly>
                </div>
            
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control" required min="1">
                </div>
                                    
                <div class="mb-3">
                        <label for="harga_total" class="form-label">Total Harga</label>
                        <input type="number" name="harga_total" id="harga_total" class="form-control" readonly>
                </div>
                                    
                <div class="mb-3">
                    <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                    <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" required>
                </div>
                                    
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control" rows="3"></textarea>
                </div>
                                    
                <button type="submit" class="btn btn-success">SIMPAN</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
        // Mengambil elemen-elemen yang diperlukan
        const idBarangSelect = document.getElementById('id_barang');
        const hargaSatuanInput = document.getElementById('harga_satuan');
        const hargaTotalInput = document.getElementById('harga_total');
        const jumlahInput = document.getElementById('jumlah');

        // Event listener untuk ketika barang dipilih
        idBarangSelect.addEventListener('change', function() {
            const selectedOptions = Array.from(this.selectedOptions);
            const totalHargaSatuan = selectedOptions.reduce((total, option) => {
                return total + parseFloat(option.getAttribute('data-harga')) || 0;
            }, 0);

            // Mengisi harga satuan sebagai total harga satuan untuk barang yang dipilih
            hargaSatuanInput.value = totalHargaSatuan;
            calculateTotal(); // Menghitung total ketika harga satuan diisi
        });

        // Fungsi untuk menghitung total harga
        jumlahInput.addEventListener('input', calculateTotal);

        // Fungsi untuk menghitung total harga
        function calculateTotal() {
            const hargaSatuan = parseFloat(hargaSatuanInput.value) || 0;
            const jumlah = parseInt(jumlahInput.value) || 0;
            hargaTotalInput.value = hargaSatuan * jumlah; // Menghitung total
        }
    </script>
    