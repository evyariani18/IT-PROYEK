@extends('theme.default')

@section('title', 'Tambah Kategori Baru')

@section('content')


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
                    <h3>Tambah Kategori</h3>
                </div>
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
