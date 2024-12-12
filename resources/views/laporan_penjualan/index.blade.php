@extends('theme.default')

@section('title', 'Laporan Penjualan')

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
                <h3 class="text-center my-4">Laporan Penjualan</h3>
                <hr>
            </div>
            <div class="card border-10 shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('laporan_penjualan.index') }}" class="btn btn-md btn-success mb-3"><i class="fa fa-download"></i> EXPORT</a>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped shadow-sm" style="background-color: #f8f9fa;">
                            <thead class="thead-style">
                                <tr class="text-center">
                                    <th scope="col">NO</th>
                                    <th scope="col">KODE TRANSAKSI</th>
                                    <th scope="col">TANGGAL PENJUALAN</th>
                                    <th scope="col">KETERANGAN</th>
                                    <th scope="col">TOTAL HARGA</th>
                                    <th scope="col">DETAIL PENJUALAN</th>
                                </tr>
                            </thead>
                            <tbody class="tbody-style">
                                @forelse ($penjualan as $index => $item)
                                    <tr>
                                        <td>{{ ($penjualan->currentPage() - 1) * $penjualan->perPage() + $loop->iteration }}</td>
                                        <td>{{ $item->id_penjualan }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_penjualan)->format('d-m-Y') }}</td>
                                        <td>{{ $item->keterangan}}</td>
                                        <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                        <td>
                                            <table class="table table-bordered table-sm">
                                                <thead style="text-align: center;">
                                                    <tr>
                                                        <th>Nama Barang</th>
                                                        <th>Jumlah</th>
                                                        <th>Harga Satuan</th>
                                                        <th>Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($item->details as $detail)
                                                        <tr>
                                                            <td>{{ $detail->barang->name }}</td>
                                                            <td>{{ $detail->jumlah }}</td>
                                                            <td>Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                                            <td>Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <div class="alert alert-danger">Data pembelian belum tersedia.</div>
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
