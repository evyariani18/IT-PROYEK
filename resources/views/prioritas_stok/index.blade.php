@extends('theme.default')

@section('title', 'Daftar Barang')

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

<div class="container mt-5">
    <h3 class="text my-4">Daftar Barang</h3>
    <div class="card border-10 shadow-sm rounded">
        <div class="card-body">
            <a href="prioritas_stok/show" class="btn btn-success" style="margin-bottom: 15px;">Hitung Prioritas</a>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped shadow-sm" style="background-color: #f8f9fa;">
                    <thead class="thead-style">
                        <tr class="text-center">
                            <th>NO</th>
                            <th>BARANG</th>
                            <th>HARGA</th>
                            <th>STOK</th>
                            <th>PROFIT</th>
                            <th>TERJUAL</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-style">
                        @foreach ($barangProcessed as $index => $item)
                            <tr>
                                <td>{{ $index +1}}</td>
                                <td>{{ $item->name}}</td>
                                <td>Rp {{ $item->harga, 2}}</td>
                                <td>{{ $item->stok }}</td>
                                <td>Rp
                                    @if($item->total_keuntungan)
                                        {{ number_format($item->total_keuntungan, 2) }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $item->jumlah_terjual }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection