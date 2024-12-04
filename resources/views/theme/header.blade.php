<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<style>
    .bg-brown-custom {
        background-color: #BC9F8B;
    }

    .sidebarToggle {
        color: #543A28; /* mengubah warna ikon menjadi putih */
    }

    .avbarDropdown {
        color: #543A28;
    }
        /* SweetAlert ukuran lebih kecil */
    .swal2-xs {
    max-width: 300px !important; /* Lebar lebih kecil */
    font-size: 12px !important;  /* Ukuran font lebih kecil */
    padding: 10px !important;    /* Padding lebih kecil */
}

</style>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-brown-custom">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="/dashboard" style="font-weight: 600;">TOKO SHADAD</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Cari..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">Pengaturan</a></li>
                <li><a class="dropdown-item" href="#!">Aktivitas Log</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="#" id="logoutButton">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('logoutButton').addEventListener('click', function (e) {
        e.preventDefault(); // Mencegah aksi default tombol
        Swal.fire({
            title: "Apakah Anda yakin ingin logout?",
            text: "Anda harus login kembali untuk mengakses sistem!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Logout",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                // Tampilkan notifikasi logout berhasil
                Swal.fire({
                    title: "Berhasil Logout!",
                    text: "Anda telah keluar dari sistem.",
                    icon: "success",
                    timer: 2000, // Notifikasi otomatis hilang setelah 2 detik
                    showConfirmButton: false,
                }).then(() => {
                    // Redirect ke halaman login atau logout setelah notifikasi selesai
                    window.location.href = "/login"; // Sesuaikan dengan rute logout Anda
                });
            }
        });
    });
</script>
