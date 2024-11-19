@extends('theme.default')

@section('title', 'Tambah Barang')

@section('content')

<style>
    .card{
        margin: 30px;
    }

    .thead-style {
        background-color: #BC9F8B;
        color: white;
        text-align: center;
    }

    .tbody-style {
        background-color: #E7E8D8;
    }

    .card-body{
        background-color: #E7E8D8;
    }

</style>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center my-4">Tambah Barang Baru</h3>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <hr>
            <div class="card border-10 shadow-sm rounded">
                <div class="card-body">
                    <form action="{{ route('barangs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <a href="{{ route('barangs.index') }}" class="btn btn-md btn-secondary mb-3">KEMBALI</a>
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
                                <option value="tambah_baru">Tambah Merek</option>
                            </select>
                        </div>

                        <div id="formTambahMerek" style="display: none;">
                            <div class="form-group mb-3">
                                <label for="nama_merek_baru">Merek Baru</label>
                                <input type="text" name="nama_merek_baru" class="form-control">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="id_kategori">Kategori</label>
                            <select name="id_kategori" id="id_kategori" class="form-control" required onchange="toggleTambahKategori()">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id_kategori }}">{{ $category->name }}</option>
                                @endforeach
                                <option value="tambah_baru">Tambah Kategori</option>
                            </select>
                        </div>

                        <div id="formTambahKategori" style="display: none;">
                            <div class="form-group mb-3">
                                <label for="nama_kategori_baru">Kategori Baru</label>
                                <input type="text" name="nama_kategori_baru" class="form-control">
                            </div>
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
