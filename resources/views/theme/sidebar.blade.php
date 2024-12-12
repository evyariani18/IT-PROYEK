<head> 
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
    .bg-brown-custom{
        background-color: #BC9F8B;
    }

    .sb-nav-link-icon {
        color: #543A28; /*mengubah warna ikon menjadi putih*/
    }

    .nav-link {
        color: #543A28;
    }

    .nav-link:hover {
        color: white; /* Ensure text remains white when hovering */
    }

    .sb-sidenav-menu-heading{
        color: white;
    }
</style>

</head>
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion bg-brown-custom" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="/dashboard">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link" href="/users">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    Pengguna
                </a>
                <a class="nav-link" href="/brands">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-tag"></i></div>
                    Merek
                </a>
                <a class="nav-link" href="/categories">
                    <div class="sb-nav-link-icon"><i class="fas fa-layer-group"></i></div>
                    Kategori
                </a>
                <a class="nav-link" href="/barang">
                    <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                    Barang
                </a>
        
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransaksi" aria-expanded="false" aria-controls="collapseTransaksi">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-money-check-dollar"></i></div>
                    Transaksi
                </a>
                <div class="collapse" id="collapseTransaksi" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="/pembelian">
                            <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                            Pembelian
                        </a>
                        <a class="nav-link" href="/penjualan">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                            Penjualan
                        </a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan" aria-expanded="false" aria-controls="collapseLaporan">
                    <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                    Laporan
                </a>
                <div class="collapse" id="collapseLaporan" aria-labelledby="headingLaporan" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="/laporan_pembelian">
                            <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                            Pembelian
                        </a>
                        <a class="nav-link" href="/laporan_penjualan">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                            Penjualan
                        </a>
                    </nav>
                </div>

                <a class="nav-link" href="/stock">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
                    Prioritas Stok
                </a>
            </div>
        </div>
            <div class="sb-sidenav-footer">
            @if (Auth::check())
                <div class="small">Masuk sebagai: </div>
                {{ Auth::user()->name }}
            </div>
            @else
            <div class="sb-sidenav-footer">
                <div class="small">Anda belum login</div>
            </div>
            @endif
    </nav>
</div>
