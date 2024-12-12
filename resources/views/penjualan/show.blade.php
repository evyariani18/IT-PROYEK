@extends('theme.default')

@section('title', 'Detail Penjualan')

@section('content')

<style>
    .form-label {
        font-weight: bold;
    }

    .table th, .table td {
        vertical-align: middle;
    }

    .table {
        border-radius: 8px;
    }

    .card {
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #f8f9fa;
        font-size: 18px;
        font-weight: bold;
        text-align: center;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Detail Penjualan
                </div>
                <div class="card-body">
                    <a href="{{ route('penjualan.index') }}" class="btn btn-secondary mb-3">Kembali</a>

                    <!-- Tampilkan informasi Penjualan -->
                    <div class="mb-3">
                        <label for="tanggal_penjualan" class="form-label">Tanggal Penjualan</label>
                        <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($penjualan->tanggal_penjualan)->format('d/m/Y') }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" rows="3" readonly>{{ $penjualan->keterangan }}</textarea>
                    </div>

                    <!-- Tabel Daftar Barang -->
                    <h5>Daftar Barang</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Harga Satuan</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penjualan->details as $detail)
                                <tr>
                                    <td>{{ $detail->barang->kode_barang }}</td>
                                    <td>{{ $detail->barang->name }}</td>
                                    <td>{{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                    <td>{{ $detail->jumlah }}</td>
                                    <td>{{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Total Penjualan -->
                    <div class="mt-3">
                        <h5>Total Harga</h5>
                        <p><strong>Total: </strong>Rp. {{ number_format($penjualan->total_harga, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br>
@endsection
