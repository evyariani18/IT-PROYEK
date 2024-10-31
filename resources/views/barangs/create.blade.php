<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: #D6C0B3">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Tambah Barang Baru</h3>
                    
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('barangs.index') }}" class="btn btn-md btn-secondary mb-3">KEMBALI</a>
                        <form action="{{ route('barangs.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                 @enderror
                            </div>

                            <div class="form-group mb-3">
                            <label for="stok">Stok</label>
                            <input type="number" name="stok" class="form-control" required>
                            @error('stok')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>

                            <div class="form-group mb-3">
                            <label for="harga">Harga</label>
                            <input type="number" name="harga" step="0.01" class="form-control" required min="0">
                            @error('harga')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>

                            <div class="form-group mb-3">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="form-group mb-3">
                            <label for="image">Gambar</label>
                            <input type="file" name="image" class="form-control" accept="image/*" required>
                            @error('image')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>

                            <div class="form-group mb-3">
                            <label for="id_merek">Merek</label>
                            <select name="id_merek" id="id_merek" class="form-control" required onchange="toggleTambahMerek()">
                                <option value="">Pilih Merek</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id_merek }}">{{ $brand->title }}</option>
                                @endforeach
                                <option value="tambah_baru">Tambah Merek</option>
                            </select>
                        </div>

                        <div id="formTambahMerek" style="display: none;">
                            <div class="form-group mb-3">
                                <label for="nama_merek_baru">Merek Baru</label>
                                <input type="text" name="nama_merek_baru" class="form-control">
                            </div>
                        </div>

                        
                        <div class="form-group mb-3">
                            <label for="id_kategori">Kategori</label>
                            <select name="id_kategori" id="id_kategori" class="form-control" required onchange="toggleTambahKategori()">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id_kategori }}">{{ $category->name }}</option>
                                @endforeach
                                <option value="tambah_baru">Tambah Kategori</option>
                            </select>
                        </div>

                        <div id="formTambahKategori" style="display: none;">
                            <div class="form-group mb-3">
                                <label for="nama_kategori_baru">Kategori Baru</label>
                                <input type="text" name="nama_kategori_baru" class="form-control">
                            </div>
                        </div>

                            <button type="submit" class="btn btn-md btn-success">SIMPAN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script> 
    function toggleTambahMerek() {
        var selectMerek = document.getElementById('id_merek');
        var formTambahMerek = document.getElementById('formTambahMerek');
        formTambahMerek.style.display = (selectMerek.value === 'tambah_baru') ? 'block' : 'none';
    }

    function toggleTambahKategori() {
        var selectKategori = document.getElementById('id_kategori');
        var formTambahKategori = document.getElementById('formTambahKategori');
        formTambahKategori.style.display = (selectKategori.value === 'tambah_baru') ? 'block' : 'none';
    }
</script>

    </script>

    <script>
        //message with sweetalert
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif

    </script>

</body>
</html>
