@extends('theme.default')

@section('title', 'Tambah Penjualan')

@section('content')

<style>
    .form-label {
        font-weight: bold;
    }

    .form-control {
        border-radius: 8px;
    }

    .card {
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #f8f9fa;
        font-size: 18px;
        font-weight: bold;
        text-align: center;
    }

    .btn {
        border-radius: 8px;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Tambah Penjualan
                </div>
                <div class="card-body">
                    <a href="{{ route('penjualan.index') }}" class="btn btn-secondary mb-3">Kembali</a>

                    <form action="{{ route('penjualan.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="tanggal_penjualan" class="form-label">Tanggal Penjualan</label>
                            <input type="date" name="tanggal_penjualan" id="tanggal_penjualan" 
                                class="form-control" 
                                value="{{ old('tanggal_penjualan', now()->toDateString()) }}" 
                                max="{{ now()->toDateString() }}" 
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" rows="3">{{ old('keterangan') }}</textarea>
                        </div>

                        <!-- Barang Dinamis -->
                        <div id="barang-container">
                            <div class="barang-item" data-index="0">
                                <div class="mb-3">
                                    <label for="id_barang_0" class="form-label">Kode Barang</label>
                                    <select name="details[0][id_barang]" class="form-control barang-select" required>
                                        <option value="">Pilih Barang</option>
                                        @foreach($barang as $item)
                                            <option value="{{ $item->id_barang }}" data-name="{{ $item->name }}" data-harga="{{ $item->harga }}">
                                                {{ $item->kode_barang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="name_0" class="form-label">Nama Barang</label>
                                    <input type="text" name="details[0][name]" class="form-control" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="harga_satuan_0" class="form-label">Harga Satuan</label>
                                    <input type="number" name="details[0][harga_satuan]" class="form-control" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="jumlah_0" class="form-label">Jumlah</label>
                                    <input type="number" name="details[0][jumlah]" class="form-control jumlah" min="1" required>
                                </div>

                                <div class="mb-3">
                                    <label for="sub_total_0" class="form-label">Subtotal</label>
                                    <input type="number" name="details[0][sub_total]" class="form-control sub_total" readonly>
                                </div>

                                <button type="button" class="btn btn-danger remove-item-btn" onclick="removeBarang(0)">Hapus Barang</button>
                                <button type="button" class="btn btn-primary" onclick="addBarang()">Tambah Barang</button>
                            </div>
                        </div>

                        <br>

                        <!-- Tombol untuk menambah barang baru -->
                        <div class="text-left">
                            <button type="submit" class="btn btn-success">SIMPAN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<br>

<script>
    let itemIndex = 1;

    // Fungsi untuk menambahkan barang baru
    function addBarang() {
        const container = document.getElementById('barang-container');
        const newBarangItem = document.createElement('div');
        newBarangItem.classList.add('barang-item');
        newBarangItem.setAttribute('data-index', itemIndex);

        newBarangItem.innerHTML = `
            <div class="mb-3">
                <label for="id_barang_${itemIndex}" class="form-label">Kode Barang</label>
                <select name="details[${itemIndex}][id_barang]" class="form-control barang-select" required>
                    <option value="">Pilih Barang</option>
                    @foreach($barang as $item)
                        <option value="{{ $item->id_barang }}" data-name="{{ $item->name }}" data-harga="{{ $item->harga }}">
                            {{ $item->kode_barang }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="name_${itemIndex}" class="form-label">Nama Barang</label>
                <input type="text" name="details[${itemIndex}][name]" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label for="harga_satuan_${itemIndex}" class="form-label">Harga Satuan</label>
                <input type="number" name="details[${itemIndex}][harga_satuan]" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label for="jumlah_${itemIndex}" class="form-label">Jumlah</label>
                <input type="number" name="details[${itemIndex}][jumlah]" class="form-control jumlah" min="1" required>
            </div>

            <div class="mb-3">
                <label for="sub_total_${itemIndex}" class="form-label">Subtotal</label>
                <input type="number" name="details[${itemIndex}][sub_total]" class="form-control sub_total" readonly>
            </div>

            <button type="button" class="btn btn-danger remove-item-btn" onclick="removeBarang(${itemIndex})">Hapus Barang</button>
        `;

        container.appendChild(newBarangItem);
        itemIndex++;
    }

    // Fungsi untuk menghapus barang
    function removeBarang(index) {
        const barangItem = document.querySelector(`.barang-item[data-index="${index}"]`);
        barangItem.remove();
        itemIndex--;
    }

    // Mengisi nama dan harga saat barang dipilih
    document.addEventListener('change', function (e) {
        if (e.target.classList.contains('barang-select')) {
            const selectedOption = e.target.options[e.target.selectedIndex];
            const name = selectedOption.getAttribute('data-name');
            const harga = selectedOption.getAttribute('data-harga');
            const index = e.target.closest('.barang-item').getAttribute('data-index');

            document.querySelector(`input[name="details[${index}][name]"]`).value = name;
            document.querySelector(`input[name="details[${index}][harga_satuan]"]`).value = harga;

            hitungSubtotal(index);
        }
    });

    // Menghitung subtotal saat jumlah diubah
    document.addEventListener('input', function (e) {
        if (e.target.classList.contains('jumlah')) {
            const index = e.target.closest('.barang-item').getAttribute('data-index');
            hitungSubtotal(index);
        }
    });

    function hitungSubtotal(index) {
        const hargaSatuan = parseFloat(document.querySelector(`input[name="details[${index}][harga_satuan]"]`).value) || 0;
        const jumlah = parseInt(document.querySelector(`input[name="details[${index}][jumlah]"]`).value) || 0;
        const subtotal = hargaSatuan * jumlah;

        document.querySelector(`input[name="details[${index}][sub_total]"]`).value = subtotal;
    }
</script>

@endsection
