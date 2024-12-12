@extends('theme.default')

@section('title', 'Data Penjualan')

@section('content')

<style>
    .card {
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
                <h3 class="text-center my-4">Data Penjualan</h3>
                <hr>
            </div>
            <div class="card border-10 shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('penjualan.create') }}" class="btn btn-md btn-success mb-3">
                        <i class="fa fa-plus"></i> TAMBAH
                    </a>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped shadow-sm" style="background-color: #f8f9fa;">
                            <thead class="thead-style">
                                <tr class="text-center">
                                    <th scope="col">NO</th>
                                    <th scope="col">KODE PENJUALAN</th>
                                    <th scope="col">TANGGAL PENJUALAN</th>
                                    <th scope="col">TOTAL ITEM</th>
                                    <th scope="col">TOTAL HARGA</th>
                                    <th scope="col">KETERANGAN</th>
                                    <th scope="col" style="width: 30%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody class="tbody-style">
                                @forelse ($penjualan as $index => $item)
                                    <tr>
                                        <td>{{ ($penjualan->currentPage() - 1) * $penjualan->perPage() + $loop->iteration }}</td>
                                        <td>{{ $item->id_penjualan }}</td>
                                        <td>{{ $item->tanggal_penjualan }}</td>
                                        <td>{{ $item->Details->sum('jumlah')}}</td>
                                        <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin?');" action="{{ route('penjualan.destroy', $item->id_penjualan) }}" method="POST">
                                                <a href="{{ route('penjualan.show', $item->id_penjualan) }}" class="btn btn-sm btn-success"> 
                                                    <i class="fas fa-eye"></i> DETAIL</a>
                                                <a href="{{ route('penjualan.edit', $item->id_penjualan) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-edit"></i> EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i> HAPUS
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <div class="alert alert-danger">Data penjualan belum tersedia.</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $penjualan->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
