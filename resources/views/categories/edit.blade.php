@extends('theme.default')

@section('title', 'Edit Kategori')

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
            <div>
                <h3 class="text-center my-4">Edit Kategori</h3>
                <hr>
            </div>
            <div class="card border-10 shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('categories.index') }}" class="btn btn-md btn-secondary mb-3">KEMBALI</a>
                    <form action="{{ route('categories.update', $categories->id_kategori) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Merek</label>
                            <input type="text" class="form-control" id="title" name="name" value="{{ $categories->name }}" required>
                        </div>
                        <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
