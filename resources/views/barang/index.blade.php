@extends('theme.default')

@section('title', 'Data Barang')

@section('content')

<style>
    .card{
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

</style>

<div class="col-md-12">
    <div>
        <h3 class="text-center my-4">Data Barang</h3>
        <hr>
    </div>
    <div class="card border-10 shadow-sm rounded">
        <div class="card-body">
        <div class="container mt-2">
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('barang.create') }}" class="btn btn-md btn-success mb-3">
                <i class="fa fa-plus"></i> TAMBAH
            </a>
        </div>
        <div class="col-md-6">
            <div class="input-group mb-3" style="max-width: 300px; float: right;">
                <input class="form-control" type="text" id="searchInput" placeholder="Cari Barang..." aria-label="Search for..." />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button">
                        <i class="fas fa-search"></i> Cari
                    </button>
            </div>
        </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped shadow-sm" style="background-color: #f8f9fa;">
                            <thead class="thead-style">
                                <tr class="text-center">
                                    <th scope="col">NO</th>
                                    <th scope="col">KODE</th>
                                    <th scope="col">NAMA</th>
                                    <th scope="col">STOK</th>
                                    <th scope="col">HARGA</th>
                                    <th scope="col">DESKRIPSI</th>
                                    <th scope="col">GAMBAR PRODUK</th>
                                    <th scope="col">MEREK</th>
                                    <th scope="col">KATEGORI</th>
                                    <th scope="col" style="width: 20%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody class="tbody-style" id="barangTable">
                                @forelse ($barang as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->kode_barang}}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->stok }}</td>
                                        <td>Rp {{ $item->harga}}</td>
                                        <td>{{ Str::limit($item->deskripsi, 50, '...')}}</td>
                                        <td>
                                             <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" style="width: 50px; height: 50px;">
                                        </td>
                                        <td>{{ $item->brand->title }}</td> <!-- anggap setiap item memiliki relasi 'brand' -->
                                        <td>{{ $item->category->name }}</td> <!-- anggap setiap item memiliki relasi 'category' -->
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin?');" action="{{ route('barang.destroy', $item->id_barang) }}" method="POST">
                                                <a href="{{ route('barang.edit', $item->id_barang) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-edit"></i> EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i> HAPUS</button>
                                            </form>
                                        </td>
                                        </tr>
                                     @empty
                                     <tr>
                                         <td colspan="10" class="text-center">
                                        <div class="alert alert-danger">Data Barang belum tersedia.</div>
                                        </td>
                                     </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $barang->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Menangani pencarian menggunakan AJAX
    document.getElementById('searchInput').addEventListener('input', function() {
        let query = this.value;
        fetch(`/search-barang?term=${query}`)
            .then(response => response.json()) // Mengambil data dalam format JSON
            .then(data => {
                let resultHtml = '';
                if (data.length > 0) {
                    data.forEach(function(item) {
                        resultHtml += `
                            <tr>
                                <td>${item.id_barang}</td>
                                <td>${item.kode_barang}</td>
                                <td>${item.name}</td>
                                <td>${item.stok}</td>
                                <td>Rp ${item.harga}</td>
                                <td>${item.deskripsi}</td>
                                <td><img src="{{ asset('storage/') }}/${item.image}" style="width: 50px; height: 50px;" /></td>
                                <td>${item.brand_name}</td> <!-- Mengakses brand_name -->
                                <td>${item.category_name}</td> <!-- Mengakses category_name -->
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin?');" action="/barang/${item.id_barang}" method="POST">
                                        <a href="/barang/${item.id_barang}/edit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-edit"></i> EDIT</a>
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i> HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    resultHtml = '<tr><td colspan="10" class="text-center">Tidak ditemukan hasil pencarian.</td></tr>';
                }
                document.getElementById('barangTable').innerHTML = resultHtml;
            })
            .catch(err => console.error('Error:', err));
    });
</script>

@endsection
