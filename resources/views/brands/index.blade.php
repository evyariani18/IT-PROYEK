@extends('theme.default')

@section('title', 'Data Merek Barang')

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
                <h3 class="text-center my-4">Data Merek Barang</h3>
                <hr>
            </div>
            <div class="card border-10 shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('brands.create') }}" class="btn btn-md btn-success mb-3"><i class="fa fa-plus"></i> TAMBAH</a>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped shadow-sm" style="background-color: #f8f9fa;">
                            <thead class="thead-style">
                                <tr class="text-center">
                                    <th scope="col">NO</th>
                                    <th scope="col">MEREK BARANG</th>
                                    <th scope="col" style="width: 20%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody class="tbody-style">
                                @forelse ($brands as $index => $item)
                                    <tr>
                                        <td>{{ ($brands->currentPage() - 1) * $brands->perPage() + $loop->iteration }}</td>
                                        <td>{{ $item->title}}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin?');" action="{{ route('brands.destroy', $item->id_merek) }}" method="POST">
                                                <a href="{{ route('brands.edit', $item->id_merek) }}" class="btn btn-sm btn-primary">
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
                                        <div class="alert alert-danger">Data merek belum tersedia.</div>
                                        </td>
                                     </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $brands->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
