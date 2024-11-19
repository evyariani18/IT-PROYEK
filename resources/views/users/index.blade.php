@extends('theme.default')

@section('title', 'Data Pengguna')

@section('content')

<style>
    .card{
        margin: 30px;
    }

    .card-body{
        border-radius: 10px;
    }

    .thead-style {
        background-color: #BC9F8B;
        color: white;
        text-align: center;
        padding: 10px; /* Menambahkan padding pada header */
    }

    .tbody-style {
        background-color: #E7E8D8;
        padding: 8px; /* Menambahkan padding pada baris data */
    }

</style>

<div class="container mt-5">
    <h3 class="text-center my-4">Data Pengguna</h3>

        <div class="row">
        <div class="col-md-12">
            <hr>
            <div class="card border-10 shadow-sm rounded">
                <div class="card-body">
                <a href="{{ route('users.create') }}" class="btn btn-md btn-success mb-3">
                <i class="fas fa-plus"></i> TAMBAH</a>
                    <table class="table table-sm table-bordered table-striped shadow-sm" style="background-color: #f8f9fa;">
                        <thead class="thead-style">
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">NAMA PENGGUNA</th>
                                <th scope="col">EMAIL</th>
                                <th scope="col">USERNAME</th>
                                <th scope="col">LEVEL</th>
                                <th scope="col" style="width: 20%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="tbody-style">
                            @forelse ($users as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->level }}</td>
                                    <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('users.destroy', $item->id_user) }}" method="POST">
                                            <a href="{{ route('users.edit', $item->id_user) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i> EDIT
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i> HAPUS
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-danger">Data Pengguna belum Tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $users->links() }} <!-- Paginasi -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
