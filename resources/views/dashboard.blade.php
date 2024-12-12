@extends('theme.default')

@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<style>
.bg-purple-custom {
    background-color: #6A1E55; /* Custom purple color */
}

.bg-orange-custom{
    background-color: #914F1E;
}

.bg-blue-custom{
    background-color: #1F509A;
}

.bg-yellow-custom{
    background-color: #FABC3F;
}

.bg-green-custom{
    background-color: #E36414;
}

.sb-nav-fixed{
    background-color: #E7E8D8;
}
</style>

<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard Admin Toko Shadad</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active" style="text-align: center; width: 100%;">Selamat Datang di Halaman Dashboard Toko Shadad</li>
    </ol>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body"><i class="fas fa-user"></i> Pengguna</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/users">Lihat Detail</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-yellow-custom text-white mb-4">
                <div class="card-body"><i class="fa-solid fa-tag"></i> Merek</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/brands">Lihat Detail</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-orange-custom text-white mb-4">
                <div class="card-body"><i class="fas fa-layer-group"></i> Kategori</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/categories">Lihat Detail</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body"><i class="fas fa-box"></i> Barang</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/barang">Lihat Detail</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body"><i class="fa-solid fa-money-check-dollar"></i> Transaksi</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <!-- Trigger Modal Button -->
                    <a class="small text-white stretched-link" data-toggle="modal" data-target="#pilihanModal">Lihat Detail</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!-- Modal Popup -->
        <div class="modal fade" id="pilihanModal" tabindex="-1" aria-labelledby="pilihanModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pilihanModalLabel">Pilih Jenis Transaksi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Options for Pembelian and Penjualan -->
                        <a href="{{ route('pembelian.index') }}" class="btn btn-info btn-block mb-2">Transaksi Pembelian</a>
                        <a href="{{ route('penjualan.index') }}" class="btn btn-warning btn-block">Transaksi Penjualan</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6">
            <div class="card bg-blue-custom text-white mb-4">
                <div class="card-body"><i class="fas fa-file-alt"></i> Laporan</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <!-- Tombol untuk membuka modal -->
                    <a class="small text-white stretched-link" data-toggle="modal" data-target="#laporanModal">Lihat Detail</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!-- Modal Pilihan Laporan -->
        <div class="modal fade" id="laporanModal" tabindex="-1" aria-labelledby="laporanModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="laporanModalLabel">Pilih Jenis Laporan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Opsi untuk Laporan Pembelian dan Penjualan -->
                        <a href="{{ route('laporan_pembelian.index') }}" class="btn btn-info btn-block mb-2">Laporan Pembelian</a>
                        <a href="{{ route('laporan_penjualan.index') }}" class="btn btn-warning btn-block">Laporan Penjualan</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6">
            <div class="card bg-green-custom text-white mb-4">
                <div class="card-body"><i class="fas fa-chart-line"></i> Prioritas Stok</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/laporan">Lihat Detail</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Penjualan Pada Setiap Bulan
                </div>
                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Penjualan Perbulan
                </div>
                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
    </div>
</div>
@endsection
