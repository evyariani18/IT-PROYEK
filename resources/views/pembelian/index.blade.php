@extends('theme.default')

@section('title', 'Data Pembelian')

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

    .filter-form {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center;
    }
</style>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center my-4">Data Pembelian</h3>
            <hr>
            <div class="card border-10 shadow-sm rounded">
                <div class="card-body">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <!-- Add Button (Left) -->
                        <div>
                            <a href="{{ route('pembelian.create') }}" class="btn btn-success">
                                <i class="fa fa-plus"></i> TAMBAH
                            </a>
                        </div>

                        <!-- Filter Form (Right) -->
                        <div class="d-flex justify-content-end">
                            <form action="{{ route('pembelian.index') }}" method="GET" class="filter-form">
                                <div class="mr-2">
                                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                                </div>
                                <div class="mr-2">
                                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped shadow-sm" style="background-color: #f8f9fa;">
                            <thead class="thead-style">
                                <tr class="text-center">
                                    <th scope="col">NO</th>
                                    <th scope="col">KODE PEMBELIAN</th>
                                    <th scope="col">TANGGAL PEMBELIAN</th>
                                    <th scope="col">SUPPLIER</th>
                                    <th scope="col">TOTAL ITEM</th>
                                    <th scope="col">TOTAL HARGA</th>
                                    <th scope="col">NOTA</th>
                                    <th scope="col" style="width: 30%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody class="tbody-style">
                                @forelse ($pembelian as $index => $item)
                                    <tr>
                                        <td>{{ ($pembelian->currentPage() - 1) * $pembelian->perPage() + $loop->iteration }}</td>
                                        <td>{{ $item->id_pembelian }}</td>
                                        <td>{{ $item->tanggal_pembelian }}</td>
                                        <td>{{ $item->supplier ?? '-' }}</td>
                                        <td>{{ $item->Details->sum('jumlah')}}</td>
                                        <td>{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            @if ($item->image)
                                                <a href="{{ asset('storage/' . $item->image) }}" target="_blank">
                                                    <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                                                </a>
                                            @else
                                                Tidak Ada
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin?');" action="{{ route('pembelian.destroy', $item->id_pembelian) }}" method="POST">
                                                <a href="{{ route('pembelian.show', $item->id_pembelian) }}" class="btn btn-sm btn-success">
                                                    <i class="fas fa-eye"></i> DETAIL
                                                </a>
                                                <a href="{{ route('pembelian.edit', $item->id_pembelian) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-edit"></i> EDIT
                                                </a>
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
                                        <td colspan="8" class="text-center">
                                            <div class="alert alert-danger">Data pembelian belum tersedia.</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $pembelian->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
