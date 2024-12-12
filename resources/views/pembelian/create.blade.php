@extends('theme.default')

@section('title', 'Tambah Pembelian')

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
                    Tambah Pembelian
                </div>
                <div class="card-body">
                    <a href="{{ route('pembelian.index') }}" class="btn btn-secondary mb-3">Kembali</a>

                    <form action="{{ route('pembelian.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="tanggal_pembelian" class="form-label">Tanggal Pembelian</label>
                            <input type="date" name="tanggal_pembelian" id="tanggal_pembelian" 
                                class="form-control" 
                                value="{{ old('tanggal_pembelian', now()->toDateString()) }}" 
                                max="{{ now()->toDateString() }}" 
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="supplier" class="form-label">Supplier</label>
                            <input type="text" name="supplier" id="supplier" class="form-control" value="{{ old('supplier') }}">
                        </div>

                        <!-- Barang Dinamis -->
                        <div id="barang-container">
                            <div class="barang-item" data-index="0">
                                <div class="mb-3">
                                    <label for="id_barang_0" class="form-label">Kode Barang</label>
                                    <select name="details[0][id_barang]" class="form-control barang-select" required>
                                        <option value="">Pilih Barang</option>
                                        @foreach($barang as $item)
                                            <option value="{{ $item->id_barang }}" data-name="{{ $item->name }}">
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
                                    <input type="number" name="details[0][harga_satuan]" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="jumlah_0" class="form-label">Jumlah</label>
                                    <input type="number" name="details[0][jumlah]" class="form-control jumlah" min="1" required>
                                </div>

                                <div class="mb-3">
                                    <label for="sub_total_0" class="form-label">Subtotal</label>
                                    <input type="number" name="details[0][sub_total]" class="form-control sub_total" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="image_0" class="form-label">Nota</label>
                                    <input type="file" name="image" class="form-control" accept="image/*" required>
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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

    function addBarang() {
        const newItem = document.createElement('div');
        newItem.classList.add('barang-item');
        newItem.setAttribute('data-index', itemIndex);

        newItem.innerHTML = `
            <div class="mb-3">
                <label for="id_barang_${itemIndex}" class="form-label">Kode Barang</label>
                <select name="details[${itemIndex}][id_barang]" class="form-control barang-select" required>
                    <option value="">Pilih Barang</option>
                    @foreach($barang as $item)
                        <option value="{{ $item->id_barang }}" data-name="{{ $item->name }}">
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
                <input type="number" name="details[${itemIndex}][harga_satuan]" class="form-control" required>
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
        document.getElementById('barang-container').appendChild(newItem);
        itemIndex++;
    }

    function removeBarang(index) {
        const item = document.querySelector(`.barang-item[data-index="${index}"]`);
        if (item) item.remove();
    }

    document.addEventListener('change', function(event) {
        if (event.target.matches('.barang-select')) {
            const index = event.target.closest('.barang-item').getAttribute('data-index');
            const selectedOption = event.target.options[event.target.selectedIndex];
            const nameInput = document.querySelector(`input[name="details[${index}][name]"]`);

            nameInput.value = selectedOption.getAttribute('data-name');
        }
    });

    document.addEventListener('input', function(event) {
        if (event.target.matches('.jumlah') || event.target.matches('[name*="[harga_satuan]"]')) {
            const barangItem = event.target.closest('.barang-item');
            if (barangItem) {
                const index = barangItem.getAttribute('data-index');
                const hargaSatuanInput = barangItem.querySelector(`[name="details[${index}][harga_satuan]"]`);
                const jumlahInput = barangItem.querySelector(`[name="details[${index}][jumlah]"]`);
                const subTotalInput = barangItem.querySelector(`[name="details[${index}][sub_total]"]`);

                const hargaSatuan = parseFloat(hargaSatuanInput.value) || 0;
                const jumlah = parseInt(jumlahInput.value) || 0;

                // Hitung subtotal
                const subTotal = hargaSatuan * jumlah;

                // Tampilkan subtotal
                subTotalInput.value = subTotal;
            }
        }
    });
</script>

@endsection
