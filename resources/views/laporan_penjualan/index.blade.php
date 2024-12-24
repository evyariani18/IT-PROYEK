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

    .header-section {
        text-align: center;
        margin-bottom: 20px;
    }

    .header-section img {
        max-width: 100px;
    }

    .header-details {
        text-align: left;
        margin-bottom: 20px;
    }


    .signature-box {
        text-align: center;
        width: 200px;
    }

    .signature-line {
        margin-top: 50px;
        border-top: 1px solid black;
        margin-bottom: 5px;
    }

    .signature-label {
        margin-top: 5px;
    }
</style>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <!-- Header Section -->
            <div class="header-section">
                <img src="{{ asset('storage/images/logo.png') }}" alt="Logo Toko Shadad" style="width: 130px; height: auto;">
                <h3>Perlengkapan Rumah Toko Shadad</h3>
                <p>Jl. Datu Daim Pasar Tapandang Berseri I Blok G No 02 Tanah Laut Kalimantan Selatan</p>
            </div>

            <!-- Export Button -->
            <div class="mb-4">

            <!-- Tabel Penjualan -->
            <div class="card border-10 shadow-sm rounded">
                <div class="card-body">
                <a href="{{ route('laporan_penjualan.penjualan_pdf') }}" class="btn btn-danger">
                    <i class="fas fa-file-pdf"></i> Export ke PDF</a>
                    <br>
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
                                            <td>{{ now()->format('d-m-Y') }}</td>
                                            <td>{{ $detail->barang->kode_barang }}</td>
                                            <td>{{ $detail->barang->name }}</td>
                                            <td>{{ $detail->jumlah }}</td>
                                            <td>Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                            <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <div class="alert alert-danger">Data penjualan belum tersedia.</div>
                                        </td>
                                    </tr>
                                @endforelse
                                <tr>
                                    <td colspan="7" class="text-right"><strong>Total:</strong></td>
                                    <td><strong>Rp {{ number_format($grandTotal, 0, ',', '.') }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
