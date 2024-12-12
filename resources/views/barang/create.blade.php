@extends('theme.default')

@section('title', 'Tambah Barang')

@section('content')

<style>
    .card{
        margin: 30px;
    }
</style>
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
                    <h3>Tambah Merek</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <a href="{{ route('barang.index') }}" class="btn btn-md btn-secondary mb-3">KEMBALI</a>
                        <div class="mb-3">
                            <label for="kode_barang" class="form-label">Kode</label>
                            <input type="text" class="form-control" id="kode_barang" name="kode_barang" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="stok">Stok</label>
                            <input type="number" name="stok" class="form-control" required>
                            @error('stok')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="harga">Harga</label>
                            <input type="number" name="harga" step="0.01" class="form-control" required min="0">
                            @error('harga')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="image">Gambar</label>
                            <input type="file" name="image" class="form-control" accept="image/*" required>
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="id_merek">Merek</label>
                            <select name="id_merek" id="id_merek" class="form-control" required onchange="toggleTambahMerek()">
                                <option value="">Pilih Merek</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id_merek }}">{{ $brand->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="id_kategori">Kategori</label>
                            <select name="id_kategori" id="id_kategori" class="form-control" required onchange="toggleTambahKategori()">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id_kategori }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-md btn-success">SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function toggleTambahMerek() {
        var selectMerek = document.getElementById('id_merek');
        var formTambahMerek = document.getElementById('formTambahMerek');
        formTambahMerek.style.display = (selectMerek.value === 'tambah_baru') ? 'block' : 'none';
    }

    function toggleTambahKategori() {
        var selectKategori = document.getElementById('id_kategori');
        var formTambahKategori = document.getElementById('formTambahKategori');
        formTambahKategori.style.display = (selectKategori.value === 'tambah_baru') ? 'block' : 'none';
    }
</script>
@endpush
