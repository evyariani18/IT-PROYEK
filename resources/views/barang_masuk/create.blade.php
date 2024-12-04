@extends('theme.default')

@section('title', 'Tambah Barang Masuk')

@section('content')
<style>
    .card {
        margin: 30px;
    }

    .card-body {
        background-color: #E7E8D8;
    }

    .dropdown {
        position: relative;
        display: inline-block;
        margin-bottom: 20px;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }
</style>

<div class="container mt-5">
    <h3 class="text-center my-4">Tambah Barang Masuk</h3>
    <div class="row">
        <div class="col-md-12">
            <hr>
            <div class="card border-10 shadow-m rounded">
                <div class="card-body">
                    <a href="{{ route('barang_masuk.index') }}" class="btn btn-md btn-secondary mb-3">KEMBALI</a>
                    <form action="{{ route('barang_masuk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Dropdown Barang -->
                        <div class="form-group mb-3">
                            <label for="id_barang">Nama Barang</label>
                            <select name="id_barang" class="form-control" required id="barangDropdown" onchange="toggleTambahBarang()">
                                <option value="">Pilih Barang</option>
                                @foreach($barangs as $barang)
                                    <option value="{{ $barang->id_barang }}">{{ $barang->name }}</option>
                                @endforeach
                                <option value="tambah_baru">Tambah Barang Baru</option>
                            </select>
                        </div>

                        <!-- Form Tambah Barang Baru -->
                        <div id="formTambahBarang" style="display: none;">
                            <div class="form-group mb-3">
                                <label for="nama_barang_baru">Nama Barang Baru</label>
                                <input type="text" name="nama_barang_baru" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="stok_barang_baru">Stok</label>
                                <input type="number" name="stok_barang_baru" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="harga_barang_baru">Harga</label>
                                <input type="number" name="harga_barang_baru" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="deskripsi_barang_baru">Deskripsi</label>
                                <textarea name="deskripsi_barang_baru" class="form-control"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="image_barang_baru">Gambar</label>
                                <input type="file" name="image_barang_baru" class="form-control" accept="image/*" id="imageInput" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="id_merek">Merek</label>
                                <select name="id_merek" class="form-control">
                                    <option value="">Pilih Merek</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id_merek }}">{{ $brand->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="id_kategori">Kategori</label>
                                <select name="id_kategori" class="form-control">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id_kategori }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Form Tambahan -->
                        <div class="form-group mb-3">
                            <label for="stok">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="harga_satuan">Harga Satuan</label>
                            <input type="number" name="harga_satuan" step="0.01" class="form-control" required min="0">
                        </div>
                        <div class="form-group mb-3">
                            <label for="harga_total">Harga Total</label>
                            <input type="number" name="harga_total" step="0.01" class="form-control" required min="0">
                        </div>
                        <div class="form-group mb-3">
                            <label for="supplier">Supplier</label>
                            <input type="text" name="supplier" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="tanggal_masuk">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" class="form-control" value="{{ now()->toDateString() }}" max="{{ now()->toDateString() }}" required>
                        </div>

                        <!-- Google Drive Upload -->
                        <div class="form-group mb-3">
                            <label for="fileToUpload">Pilih File</label>
                            <input type="file" name="fileToUpload" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary" id="upload-btn" style="display:none;">Upload ke Google Drive</button>

                        <!-- Google Drive Authenticate Link -->
                        <a href="{{ route('google-drive.authenticate') }}" class="btn btn-secondary">Hubungkan ke Google Drive</a>

                        <!-- Notifikasi -->
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <button type="submit" class="btn btn-md btn-success">SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://apis.google.com/js/api.js"></script>
<script>
    let googleAuth;
    const CLIENT_ID = '499843428053-rapnuc1bes5knabl0vn5lovs7k48uoe2.apps.googleusercontent.com'; // Ganti dengan CLIENT_ID yang benar
    const API_KEY = 'AIzaSyBLYc6fr9TL_VDLPBeIR7ye3DUUed84zcs'; // Ganti dengan API Key yang benar
    const SCOPES = 'https://www.googleapis.com/auth/drive.file';

    // Inisialisasi Google Client
    function loadGoogleClient() {
        gapi.load('client:auth2', initGoogleClient);
    }

    function initGoogleClient() {
        gapi.client.init({
            apiKey: API_KEY,
            clientId: CLIENT_ID,
            discoveryDocs: ['https://www.googleapis.com/discovery/v1/apis/drive/v3/rest'],
            scope: SCOPES,
        }).then(() => {
            googleAuth = gapi.auth2.getAuthInstance();
            document.getElementById('upload-btn').addEventListener('click', uploadFileToDrive);
        }, (error) => {
            console.error(error);
        });
    }

    // Fungsi untuk autentikasi
    function signInGoogle() {
        googleAuth.signIn().then(() => {
            document.getElementById('upload-btn').style.display = 'block';
        });
    }

    // Fungsi untuk mengupload file ke Google Drive
    function uploadFileToDrive(event) {
        event.preventDefault(); // Mencegah form submit default
        const fileInput = document.getElementById('fileToUpload');
        const file = fileInput.files[0];

        if (!file) {
            alert('Pilih file terlebih dahulu.');
            return;
        }

        const metadata = {
            name: file.name,
            mimeType: file.type
        };

        const formData = new FormData();
        formData.append('metadata', new Blob([JSON.stringify(metadata)], { type: 'application/json' }));
        formData.append('file', file);

        const accessToken = googleAuth.currentUser.get().getAuthResponse().access_token;

        fetch('https://www.googleapis.com/upload/drive/v3/files?uploadType=multipart', {
            method: 'POST',
            headers: new Headers({
                'Authorization': 'Bearer ' + accessToken
            }),
            body: formData
        }).then(response => response.json())
          .then(data => {
              alert('File berhasil diupload ke Google Drive: ' + data.name);
          }).catch(error => {
              alert('Terjadi kesalahan saat mengupload file: ' + error.message);
          });
    }

    loadGoogleClient();
</script>
@endsection
