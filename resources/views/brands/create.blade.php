@extends('theme.default')

@section('title', 'Tambah Merek Baru')

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
                    <h3>Tambah Merek</h3>
                </div>
                <div class="card-body">
                <a href="{{ route('brands.index') }}" class="btn btn-md btn-secondary mb-3">KEMBALI</a>
                <form action="{{ route('brands.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Merek</label>
                        <input type="text" class="form-control" id="name" name="title" required>
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
