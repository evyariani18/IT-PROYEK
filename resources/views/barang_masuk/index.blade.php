@extends('theme.default')

@section('title', 'Data Barang Masuk')

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

    <div class="container mt-5 custom">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4"> Data Pembelian Barang</h3>
                    <hr>
                </div>
                <div class="card border-10 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('barang_masuk.create') }}" class="btn btn-md btn-success mb-3"><i class="fa fa-plus"></i> TAMBAH</a>
                       <div class="table-responsive">
                       <table class="table table-sm table-bordered table-striped shadow-sm" style="background-color: #f8f9fa;">
                            <thead class="thead-style">
                                <tr class="text-center">
                                    <th scope="col">NO</th>
                                    <th scope="col">KODE</th>
                                    <th scope="col">NAMA BARANG</th>
                                    <th scope="col">JUMLAH</th>
                                    <th scope="col">HARGA SATUAN</th>
                                    <th scope="col">HARGA TOTAL</th>
                                    <th scope="col">SUPPLIER</th>
                                    <th scope="col">TANGGAL</th>
                                    <th scope="col">MEDIA</th>
                                    <th scope="col" style="width: 20%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody class="tbody-style">
                                @forelse ($barangmasuk as $index => $item)
                                    <tr>
                                        <td>{{ ($barangmasuk->currentPage() - 1) * $barangmasuk->perPage() + $loop->iteration }}</td>
                                        <td>{{ $item->barang->kode_barang }}</td>
                                        <td>{{ $item->barang->name }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>Rp {{ $item->harga_satuan}}</td>
                                        <td>Rp {{ $item->harga_total}}</td>
                                        <td>{{ $item->supplier}}</td>
                                        <td>{{ $item->tanggal_masuk }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" style="width: 50px; height: 50px;">
                                            </td>
                                        </td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin?');" action="{{ route('barang_masuk.destroy', $item->id_masuk) }}" method="POST">
                                                <a href="{{ route('barang_masuk.edit', $item->id_masuk) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i>EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i>HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            <div class="alert alert-danger">Data barang masuk belum tersedia.</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        </div>
                        {{ $barangmasuk->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
