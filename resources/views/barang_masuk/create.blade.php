@extends('theme.default')

@section('title', 'Tambah Barang Masuk')

@section('content')
<style>
    .card {
        margin: 30px;
    }

    .dropdown {
        position: relative;
        display: inline-block;
        margin-bottom: 20px;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }
</style>

<div class="container mt-5">
    <h3 class="text-center my-4">Tambah Data Pembelian Barang</h3>
    <div class="row">
        <div class="col-md-12">
            <hr>
            <div class="card border-10 shadow-m rounded">
                <div class="card-body">
                    <a href="{{ route('barang_masuk.index') }}" class="btn btn-md btn-secondary mb-3">KEMBALI</a>
                    <form action="{{ route('barang_masuk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Dropdown Barang -->
                        <div class="mb-3">
                            <label for="id_barang" class="form-label">Kode Barang</label>
                            <select name="id_barang" id="id_barang" class="form-control" required>
                                <option value="">Pilih Barang</option>
                                @foreach($barang as $item)
                                <option value="{{ $item->id_barang }}" data-name="{{ $item->name }}">{{ $item->kode_barang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Barang</label>
                            <input type="text" name="name" id="name" class="form-control" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="stok">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="harga_satuan">Harga Satuan</label>
                            <input type="number" name="harga_satuan" step="0.01" class="form-control" required min="0">
                        </div>
                        <div class="form-group mb-3">
                            <label for="harga_total">Harga Total</label>
                            <input type="number" name="harga_total" step="0.01" class="form-control" required min="0">
                        </div>
                        <div class="form-group mb-3">
                            <label for="supplier">Supplier</label>
                            <input type="text" name="supplier" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="tanggal_masuk">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" class="form-control" value="{{ now()->toDateString() }}" max="{{ now()->toDateString() }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="image">Media</label>
                            <input type="file" name="image" class="form-control" accept="image/*" required>
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-md btn-success">SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const idBarangSelect = document.getElementById('id_barang');
    const nameInput = document.getElementById('name');

    // Event listener untuk ketika barang dipilih
    idBarangSelect.addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    console.log(selectedOption.value); // Memastikan ID barang terpilih
    console.log(selectedOption.getAttribute('data-name')); // Memastikan data-name terambil
    
    if (selectedOption.value) {
        const namaBarang = selectedOption.getAttribute('data-name');
        nameInput.value = namaBarang;
    } else {
        nameInput.value = '';
    }
});
</script>

@endsection