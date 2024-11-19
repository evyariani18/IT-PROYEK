@extends('theme.default')

@section('title', 'Edit Data Barang')

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
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center my-4">Edit Data Barang</h3>
            <hr>
            <div class="card border-10 shadow-sm rounded">
                <div class="card-body">
                <a href="{{ route('barangs.index') }}" class="btn btn-md btn-secondary mb-3">KEMBALI</a>
                    <form action="{{ route('barangs.update', $barangs->id_barang) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')  <!-- Gunakan metode PUT untuk update -->

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $barangs->name) }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="stok">Stok</label>
                            <input type="number" name="stok" class="form-control" value="{{ old('stok', $barangs->stok) }}" required>
                            @error('stok')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="harga">Harga</label>
                            <input type="number" name="harga" step="0.01" class="form-control" value="{{ old('harga', $barangs->harga) }}" required min="0">
                            @error('harga')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3" required>{{ old('deskripsi', $barangs->deskripsi) }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="image">Gambar</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar!</small>
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="id_merek">Merek</label>
                            <select name="id_merek" class="form-control" required>
                                <option value="">Pilih Merek</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id_merek }}" {{ $barangs->id_merek == $brand->id_merek ? 'selected' : '' }}>{{ $brand->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    
                        <div class="form-group mb-3">
                            <label for="id_kategori">Kategori</label>
                            <select name="id_kategori" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id_kategori }}" {{ $barangs->id_kategori == $category->id_kategori ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

