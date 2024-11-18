@extends('layouts.app')

@section('content')
    <h1>Tambah Produk Baru</h1>

    <form action="{{ route('katalog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="nama">Nama Produk:</label>
        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required>

        <label for="deskripsi">Deskripsi:</label>
        <textarea id="deskripsi" name="deskripsi">{{ old('deskripsi') }}</textarea>

        <label for="harga">Harga:</label>
        <input type="number" id="harga" name="harga" value="{{ old('harga') }}" required>

        <label for="stok">Stok:</label>
        <input type="number" id="stok" name="stok" value="{{ old('stok') }}" required>

        <label for="gambar">Gambar:</label>
        <input type="file" id="gambar" name="gambar" accept="image/*">

        <button type="submit">Simpan Produk</button>
    </form>
@endsection
