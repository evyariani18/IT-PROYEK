@extends('theme.default')

@section('title', 'Tambah Transaksi')

@section('content')


<style>
    .form-label {
        font-weight: bold;
    }

    .form-control {
        border-radius: 8px;
    }

</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-10 shadow-sm rounded">
                <div class="card-header text-center">
                    <h3>Tambah Penjualan</h3>
                </div>
                <div class="card-body">
            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">KEMBALI</a>
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="id_barang" class="form-label">Kode Barang</label>
                    <select name="id_barang" id="id_barang" class="form-control" required>
                        <option value="">Pilih Barang</option>
                        @foreach($barang as $item)
                            <option value="{{ $item->id_barang }}" data-name="{{ $item->name}}" data-harga="{{ $item->harga }}">{{ $item->kode_barang }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Barang</label>
                    <input type="text" name="name" id="name" class="form-control" readonly>
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
                    <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" value="{{ old('tanggal_transaksi', now()->toDateString()) }}" max="{{ now()->toDateString() }}" required>
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

<script>
    // Mengambil elemen-elemen yang diperlukan
    const idBarangSelect = document.getElementById('id_barang');
    const hargaSatuanInput = document.getElementById('harga_satuan');
    const hargaTotalInput = document.getElementById('harga_total');
    const jumlahInput = document.getElementById('jumlah');
    const nameInput = document.getElementById('name');

    // Event listener untuk ketika barang dipilih
    idBarangSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        
        if (selectedOption.value) {
            // Mengambil data name dan harga dari opsi yang dipilih
            const namaBarang = selectedOption.getAttribute('data-name');
            const hargaSatuan = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
            
            // Mengisi field nama barang dan harga satuan
            nameInput.value = namaBarang;
            hargaSatuanInput.value = hargaSatuan;

            // Menghitung total harga jika jumlah sudah ada
            calculateTotal();
        } else {
            // Jika tidak ada barang yang dipilih, kosongkan input
            nameInput.value = '';
            hargaSatuanInput.value = '';
            hargaTotalInput.value = '';
        }
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

@endsection