@extends('theme.default')

@section('title', 'Tambah Kategori Baru')

@section('content')

<style>
    .card{
        margin: 30px;
    }

    .card-body{
        background-color: #E7E8D8;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <h3 class="text-center my-4">Tambah Kategori Baru</h3>
        <hr>
        <div class="card border-10 shadow-sm rounded">
            <div class="card-body">
                <a href="{{ route('categories.index') }}" class="btn btn-md btn-secondary mb-3">KEMBALI</a>
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-md btn-success">SIMPAN</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
