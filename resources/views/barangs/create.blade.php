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
                            <select name="id_merek" class="form-control" required>
                                <option value="">Pilih Merek</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id_merek }}">{{ $brand->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="id_kategori">Kategori</label>
                            <select name="id_kategori" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id_kategori }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
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
