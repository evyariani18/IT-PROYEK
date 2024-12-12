@extends('theme.default')

@section('title', 'Data Transaksi')

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
    <h3 class="text-center my-4">Data Penjualan Barang</h3>

    <div class="card border-10 shadow-sm rounded">
        <div class="card-body">
            <a href="{{ route('transaksi.create') }}" class="btn btn-success mb-3"><i class=" fas fa-plus"></i> TAMBAH</a>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped shadow-sm" style="background-color: #f8f9fa;">
                    <thead class="thead-style">
                        <tr class="text-center">
                            <th>NO</th>
                            <th>KODE</th>
                            <th>NAMA BARANG</th>
                            <th>JUMLAH</th>
                            <th>HARGA SATUAN</th>
                            <th>HARGA TOTAL</th>
                            <th>TANGGAL</th>
                            <th>KETERANGAN</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-style">
                        @forelse ($transaksi as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->barang->kode_barang}}</td>
                                <td>{{ $item->barang->name}}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>{{ number_format($item->harga_satuan, 2) }}</td>
                                <td>{{ number_format($item->harga_total, 2) }}</td>
                                <td>{{ $item->tanggal_transaksi }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda yakin?');" action="{{ route('transaksi.destroy', $item->id_transaksi) }}" method="POST">
                                        <a href="{{ route('transaksi.edit', $item->id_transaksi) }}" class="btn btn-primary btn-sm"> <i class="fas fa-edit"></i> EDIT</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">
                                    <div class="alert alert-danger">Data Transaksi belum tersedia.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $transaksi->links() }} <!-- Pagination -->
        </div>
    </div>
</div>

@endsection
