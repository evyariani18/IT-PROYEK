<style>
    .thead-style {
        background-color: #BC9F8B;
        color: white;
        text-align: center;
    }

    .tbody-style {
        background-color: #E7E8D8;
    }

    .card{
        margin: 30px;
    }

    .card-body {
        padding: 0; /* Removed padding */
    }

    table {
        padding: 0; /* Removed padding */
    }

    td, th {
        padding: 0; /* Optional: Customize table cell padding */
    }
</style>

@extends('theme.default')

@section('title', 'Data Merek Barang')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div>
            <h3 class="text-center my-4">Data Merek Barang</h3>
            <hr>
        </div>
        <div class="card border-10 shadow-sm rounded">
            <div class="card-body">
                <a href="{{ route('brands.create') }}" class="btn btn-md btn-success mb-3"><i class="fas fa-plus"></i> TAMBAH</a>
                <table class="table table-sm table-bordered table-striped shadow-sm" style="background-color: #f8f9fa;">
                    <thead class="thead-style">
                        <tr>
                            <th scope="col">NO</th>
                            <th scope="col">NAMA MEREK</th>
                            <th scope="col" style="width: 20%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-style">
                        @forelse ($brands as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->title }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin?');" action="{{ route('brands.destroy', $item->id_merek) }}" method="POST">
                                        <a href="{{ route('brands.edit', $item->id_merek) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i> EDIT
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> HAPUS
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">
                                        <div class="alert alert-danger">Data merek belum tersedia.</div>
                                    </td>
                                </tr>
                            @endforelse
                    </tbody>
                </table>    
                {{ $brands->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
