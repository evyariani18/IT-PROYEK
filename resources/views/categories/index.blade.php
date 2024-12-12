@extends('theme.default')

@section('title', 'Data Kategori Barang')

@section('content')

<style>
    .card{
        margin: 10px;
    }

    .thead-style {
        background-color: #BC9F8B;
        color: white;
        text-align: center;
    }

    .tbody-style {
        background-color: #E7E8D8;
    }

</style>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div>
                <h3 class="text-center my-4">Data Kategori Barang</h3>
                <hr>
            </div>
            <div class="card border-10 shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('categories.create') }}" class="btn btn-md btn-success mb-3"><i class="fa fa-plus"></i> TAMBAH</a>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped shadow-sm" style="background-color: #f8f9fa;">
                            <thead class="thead-style">
                                <tr class="text-center">
                                    <th scope="col">NO</th>
                                    <th scope="col">JENIS KATEGORI</th>
                                    <th scope="col" style="width: 20%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody class="tbody-style">
                                @forelse ($categories as $index => $item)
                                    <tr>
                                        <td>{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}</td>
                                        <td>{{ $item->name}}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin?');" action="{{ route('categories.destroy', $item->id_kategori) }}" method="POST">
                                                <a href="{{ route('categories.edit', $item->id_kategori) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-edit"></i> EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i> HAPUS</button>
                                            </form>
                                        </td>
                                        </tr>
                                     @empty
                                     <tr>
                                         <td colspan="8" class="text-center">
                                        <div class="alert alert-danger">Data kategori belum tersedia.</div>
                                        </td>
                                     </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
