@extends('theme.default')

@section('title', 'Prioritas Stok')

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
    <h3 class="text my-4">Hasil Normalisasi</h3>
    <div class="card border-10 shadow-sm rounded">
        <div class="card-body">
        <a href="{{ route('prioritas_stok.index') }}" class="btn btn-secondary mb-3">Kembali</a>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped shadow-sm" style="background-color: #f8f9fa;">
                    <thead class="thead-style">
                        <tr class="text-center">
                            <th>RANKING</th>
                            <th>BARANG</th>
                            <th>HARGA</th>
                            <th>STOK</th>
                            <th>PROFIT</th>
                            <th>TERJUAL</th>
                            <th>SKOR</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-style">
                        @foreach ($barangProcessed as $index => $item)
                            <tr>
                                <td>{{ $index +1}}</td>
                                <td>{{ $item->name}}</td>
                                <td>{{ number_format($item->normHarga, 4) }}</td>
                                <td>{{ number_format($item->normStok, 4) }}</td>
                                <td>{{ number_format($item->normKeuntungan, 4) }}</td>
                                <td>{{ number_format($item->normTerjual, 4) }}</td>

                                <td class="skor-saw">
                                    {{ number_format($item->skor_saw, 4) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection