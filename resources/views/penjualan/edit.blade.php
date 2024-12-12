@extends('theme.default')

@section('title', 'Edit Penjualan')

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
                    Edit Penjualan
                </div>
                <div class="card-body">
                    <a href="{{ route('penjualan.index') }}" class="btn btn-secondary mb-3">Kembali</a>

                    <form action="{{ route('penjualan.update', $penjualan->id_penjualan) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Tanggal Penjualan -->
                        <div class="mb-3">
                            <label for="tanggal_penjualan" class="form-label">Tanggal Penjualan</label>
                            <input type="date" name="tanggal_penjualan" id="tanggal_penjualan" 
                                class="form-control" 
                                value="{{ old('tanggal_penjualan', $penjualan->tanggal_penjualan) }}" 
                                max="{{ now()->toDateString() }}" 
                                required>
                        </div>

                        <!-- Keterangan -->
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" rows="3">{{ old('keterangan', $penjualan->keterangan) }}</textarea>
                        </div>

                        <!-- Detail Penjualan -->
                        <div id="details-container">
                            @foreach($penjualan->details as $index => $detail)
                                <div class="detail-item mb-4 border p-3 rounded">
                                    <div class="mb-3">
                                        <label for="details[{{ $index }}][id_barang]" class="form-label">Kode Barang</label>
                                        <select name="details[{{ $index }}][id_barang]" class="form-control barang-select" required>
                                            <option value="">Pilih Barang</option>
                                            @foreach($barang as $item)
                                                <option value="{{ $item->id_barang }}" 
                                                    data-name="{{ $item->name }}" 
                                                    data-harga="{{ $item->harga }}" 
                                                    {{ $detail->id_barang == $item->id_barang ? 'selected' : '' }}>
                                                    {{ $item->kode_barang }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="details[{{ $index }}][name]" class="form-label">Nama Barang</label>
                                        <input type="text" name="details[{{ $index }}][name]" 
                                            class="form-control name-input" 
                                            value="{{ $detail->barang->name }}" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label for="details[{{ $index }}][harga_satuan]" class="form-label">Harga Satuan</label>
                                        <input type="number" name="details[{{ $index }}][harga_satuan]" 
                                            class="form-control harga-input" 
                                            value="{{ $detail->harga_satuan }}" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label for="details[{{ $index }}][jumlah]" class="form-label">Jumlah</label>
                                        <input type="number" name="details[{{ $index }}][jumlah]" 
                                            class="form-control jumlah-input" 
                                            value="{{ $detail->jumlah }}" min="1" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="details[{{ $index }}][sub_total]" class="form-label">Subtotal</label>
                                        <input type="number" name="details[{{ $index }}][sub_total]" 
                                            class="form-control subtotal-input" 
                                            value="{{ $detail->sub_total }}" readonly>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="text-left">
                            <button type="submit" class="btn btn-success">SIMPAN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const detailsContainer = document.getElementById('details-container');

        // Event untuk memperbarui subtotal berdasarkan jumlah
        detailsContainer.addEventListener('input', function (e) {
            if (e.target.classList.contains('jumlah-input')) {
                const detailItem = e.target.closest('.detail-item');
                const hargaInput = detailItem.querySelector('.harga-input');
                const subtotalInput = detailItem.querySelector('.subtotal-input');

                const harga = parseFloat(hargaInput.value) || 0;
                const jumlah = parseInt(e.target.value) || 0;

                subtotalInput.value = harga * jumlah;
            }
        });

        // Event untuk memperbarui nama dan harga barang berdasarkan pilihan
        detailsContainer.addEventListener('change', function (e) {
            if (e.target.classList.contains('barang-select')) {
                const detailItem = e.target.closest('.detail-item');
                const selectedOption = e.target.options[e.target.selectedIndex];
                const nameInput = detailItem.querySelector('.name-input');
                const hargaInput = detailItem.querySelector('.harga-input');

                nameInput.value = selectedOption.getAttribute('data-name') || '';
                hargaInput.value = selectedOption.getAttribute('data-harga') || 0;

                // Trigger input event untuk menghitung ulang subtotal
                const jumlahInput = detailItem.querySelector('.jumlah-input');
                jumlahInput.dispatchEvent(new Event('input'));
            }
        });
    });
</script>

@endsection
