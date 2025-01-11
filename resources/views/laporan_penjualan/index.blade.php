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
            <h3 class="text-center my-4">Laporan Penjualan</h3>
        </div>

        <div class="card border-10 shadow-sm rounded">
            <div class="card-body">
                <div class="button-group">
                    <!-- Tombol Export PDF (Kiri) -->
                    <form action="{{ route('laporan_penjualan.penjualan_pdf') }}" method="GET" class="d-flex">
                        <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                        <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-file-pdf"></i> Export ke PDF
                        </button>
                    </form>

                    <!-- Filter Form (Kanan) -->
                    <form action="{{ route('laporan_penjualan.index') }}" method="GET" class="filter-form">
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
                                <th scope="col">TANGGAL</th>
                                <th scope="col">KODE BARANG</th>
                                <th scope="col">NAMA BARANG</th>
                                <th scope="col">QTY</th>
                                <th scope="col">HARGA SATUAN</th>
                                <th scope="col">SUBTOTAL</th>
                                <th scope="col">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody class="tbody-style">
                            @php $grandTotal = 0; @endphp
                            @forelse ($penjualan as $index => $item)
                                @foreach ($item->details as $detail)
                                    @php $subtotal = $detail->jumlah * $detail->harga_satuan; @endphp
                                    @php $grandTotal += $subtotal; @endphp
                                    <tr>
                                        <td>{{ $index + 1}}</td>
                                        <td>{{ $detail->id_penjualan }}</td>
                                        <td>{{  \Carbon\Carbon::parse($item->tanggal_penjualan)->format('d-m-Y') }}</td>
                                        <td>{{ $detail->barang->kode_barang }}</td>
                                        <td>{{ $detail->barang->name }}</td>
                                        <td>{{ $detail->jumlah }}</td>
                                        <td>Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($grandTotal, 0, ',', '.') }} </td>
                                    </tr>
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">
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

@endsection
