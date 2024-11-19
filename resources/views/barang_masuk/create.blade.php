@extends('theme.default')

@section('title', 'Tambah Barang Masuk')

@section('content')

<style>
    .card{
        margin: 30px;
    }

    .card-body{
        background-color: #E7E8D8;
    }
</style>
    <div class="container mt-5">
        <h3 class="text-center my-4">Tambah Barang Masuk</h3>
        <div class="row">
            <div class="col-md-12">
                <div>
                    <hr>
                </div>
                <div class="card border-10 shadow-m rounded">
                    <div class="card-body">
                        <a href="{{ route('barang_masuk.index') }}" class="btn btn-md btn-secondary mb-3">KEMBALI</a>
                        <form action="{{ route('barang_masuk.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                            <label for="id_barang">Nama Barang</label>
                            <select name="id_barang" class="form-control" required id="barangDropdown" onchange="toggleTambahBarang()">
                                <option value="">Pilih Barang</option>
                                @foreach($barangs as $barang)
                                    <option value="{{ $barang->id_barang }}">{{ $barang->name }}</option>
                                @endforeach
                                    <option value="tambah_baru">Tambah Barang Baru</option>
                            </select>
                        </div>

                        <div id="formTambahBarang" style="display: none;">
                            <div class="form-group mb-3">
                                <label for="nama_barang_baru">Nama Barang Baru</label>
                                <input type="text" name="nama_barang_baru" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="stok_barang_baru">Stok</label>
                                <input type="number" name="stok_barang_baru" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="harga_barang_baru">Harga</label>
                                <input type="number" name="harga_barang_baru" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="deskripsi_barang_baru">Deskripsi</label>
                                <textarea name="deskripsi_barang_baru" class="form-control"></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="image_barang_baru">Gambar</label>
                                <input type="file" name="image_barang_baru" class="form-control" accept="image/*" id="imageInput" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="id_merek">Merek</label>
                                <select name="id_merek" class="form-control">
                                    <option value="">Pilih Merek</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id_merek }}">{{ $brand->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Dropdown untuk Kategori -->
                            <div class="form-group mb-3">
                                <label for="id_kategori">Kategori</label>
                                <select name="id_kategori" class="form-control">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id_kategori}}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                            <div class="form-group mb-3">
                            <label for="stok">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" required>
                            @error('jumlah')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>

                            <div class="form-group mb-3">
                            <label for="harga">Harga Satuan</label>
                            <input type="number" name="harga_satuan" step="0.01" class="form-control" required min="0">
                            @error('harga_satuan')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>

                            <div class="form-group mb-3">
                            <label for="harga">Harga Total</label>
                            <input type="number" name="harga_total" step="0.01" class="form-control" required min="0">
                            @error('harga_total')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>

                            <div class="form-group mb-3">
                            <label for="deskripsi">Supplier</label>
                            <input type="text" name="supplier" class="form-control" rows="3">
                            </div>

                            <div class="form-group mb-3">
                            <label for="image">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" class="form-control" value="{{ old('tanggal_transaksi', now()->toDateString()) }}" max="{{ now()->toDateString() }}" required>
                            @error('tanggal_masuk')
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
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function toggleTambahBarang() {
            var dropdown = document.getElementById('barangDropdown');
            var formTambahBarang = document.getElementById('formTambahBarang');
            var imageInput = document.getElementById('imageInput');

            // Tampilkan form tambah barang jika "Tambah Barang Baru" dipilih
            formTambahBarang.style.display = (dropdown.value === 'tambah_baru') ? 'block' : 'none';
            imageInput.required = (dropdown.value === 'tambah_baru');
        }
    </script>
 @endsection