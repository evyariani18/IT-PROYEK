@extends('theme.default')

@section('title', 'Laporan Pembelian')

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

    .button-group {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .filter-form {
        display: flex;
        align-items: center;
    }

    .filter-form input {
        margin-right: 10px;
    }
</style>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center my-4">Laporan Pembelian</h3>
        </div>

        <div class="card border-10 shadow-sm rounded">
            <div class="card-body">
                <div class="button-group">
                    <!-- Tombol Export PDF (Kiri) -->
                    <form action="{{ route('laporan_pembelian.pembelian_pdf') }}" method="GET" class="d-flex">
                        <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                        <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-file-pdf"></i> Export ke PDF
                        </button>
                    </form>

                    <!-- Filter Form (Kanan) -->
                    <form action="{{ route('laporan_pembelian.index') }}" method="GET" class="filter-form">
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-striped shadow-sm" style="background-color: #f8f9fa;">
                        <thead class="thead-style">
                            <tr class="text-center">
                                <th scope="col">NO</th>
                                <th scope="col">KODE TRANSAKSI</th>
                                <th scope="col">TANGGAL PEMBELIAN</th>
                                <th scope="col">SUPPLIER</th>
                                <th scope="col">NAMA BARANG</th>
                                <th scope="col">QTY</th>
                                <th scope="col">HARGA SATUAN</th>
                                <th scope="col">SUB TOTAL</th>
                                <th scope="col">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody class="tbody-style">
                            @php
                                $no = 1;
                                $currentTransaction = null;
                            @endphp
                            @forelse ($pembelian as $item)
                                @foreach($item->details as $detail)
                                    <tr>
                                        @if($currentTransaction !== $item->id_pembelian)
                                            <td class="text-center" rowspan="{{ $item->details->count() }}">{{ $no++ }}</td>
                                            <td rowspan="{{ $item->details->count() }}">{{ $item->id_pembelian }}</td>
                                            <td rowspan="{{ $item->details->count() }}">{{ \Carbon\Carbon::parse($item->tanggal_pembelian)->format('d-m-Y') }}</td>
                                            <td rowspan="{{ $item->details->count() }}">{{ $item->supplier }}</td>
                                            @php
                                                $currentTransaction = $item->id_pembelian;
                                            @endphp
                                        @endif
                                        <td>{{ $detail->barang->name }}</td>
                                        <td>{{ $detail->jumlah }}</td>
                                        <td>Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">
                                        <div class="alert alert-danger">Data pembelian belum tersedia.</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $pembelian->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
