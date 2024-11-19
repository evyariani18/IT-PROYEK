@extends('theme.default')

@section('title', 'Edit Merek Barang')

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
        <h3 class="text-center my-4">Edit Merek Barang</h3>
        <hr>
        <div class="card border-10 shadow-sm rounded">
            <div class="card-body">
                <a href="{{ route('brands.index') }}" class="btn btn-md btn-secondary mb-3">KEMBALI</a>
                <form action="{{ route('brands.update', $brands->id_merek) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">Nama Merek</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $brands->title }}" required>
                    </div>
                    <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection