<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body style="background: #D6C0B3">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Toko Shadad - Pengguna</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('users.create') }}" class="btn btn-md btn-success mb-3">
                            <i class="fas fa-plus"></i> TAMBAH PENGGUNA
                        </a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">NAMA PENGGUNA</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">USERNAME</th>
                                    <th scope="col">PASSWORD</th>
                                    <th scope="col">LEVEL</th>
                                    <th scope="col" style="width: 20%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>********</td>
                                        <td>{{ $user->level }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Tampilkan pesan sukses atau gagal dengan SweetAlert
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
