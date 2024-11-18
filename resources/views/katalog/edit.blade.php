@extends('layouts.app')

@section('content')
    <h1>Edit Produk</h1>

    <form action="{{ route('katalog.update', $katalog->id_katalog) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="nama">Nama Produk:</label>
        <input type="text" id="nama" name="nama" value="{{ old('nama', $katalog->nama) }}" required>

        <label for="deskripsi">Deskripsi:</label>
        <textarea id="deskripsi" name="deskripsi">{{ old('deskripsi', $katalog->deskripsi) }}</textarea>

        <label for="harga">Harga:</label>
        <input type="number" id="harga" name="harga" value="{{ old('harga', $katalog->harga) }}" required>

        <label for="stok">Stok:</label>
        <input type="number" id="stok" name="stok" value="{{ old('stok', $katalog->stok) }}" required>

        <label for="gambar">Gambar:</label>
        <input type="file" id="gambar" name="gambar" accept="image/*">

        <button type="submit">Update Produk</button>
    </form>
@endsection
