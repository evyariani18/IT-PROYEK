@extends('theme.default')

@section('title', 'Data Kategori Barang')

@section('content')

<style>
    .card{
        margin: 30px;
    }

    .thead-style {
        background-color: #BC9F8B;
        color: white;
        text-align: center;
        padding: 10px; /* Menambahkan padding pada header */
    }

    .tbody-style {
        background-color: #E7E8D8;
        padding: 8px; /* Menambahkan padding pada baris data */
    }

    .th, td{
        padding: 15px;
    }

</style>

<h3 class="text-center my-4">Data Kategori Barang</h3>
    <div class="row">
        <div class="col-md-12">
            <div>
                
                <hr>
            </div>
            <div class="card border-10 shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('categories.create') }}" class="btn btn-md btn-success mb-3"><i class="fas fa-plus"></i> TAMBAH</a>
                    <table class="table table-sm table-bordered table-striped shadow-sm" style="background-color: #f8f9fa;">
                        <thead class="thead-style">
                            <tr>
                                <th scope="col1">NO.</th>
                                <th scope="col">JENIS KATEGORI</th>
                                <th scope="col" style="width: 20%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="tbody-style">
                            @forelse ($categories as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('categories.destroy', $item->id_kategori) }}" method="POST">
                                            <a href="{{ route('categories.edit', $item->id_kategori) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>EDIT</a>
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
                                        <div class="alert alert-danger">Data kategori belum tersedia.</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
