<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: #D6C0B3">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Tambah Pengguna Baru</h3>
                <div class="card border-0 shadow-sm rounded mt-4">
                    <div class="card-body">
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required> 
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input" id="show-password" onclick="togglePasswordVisibility()">
                                    <label class="form-check-label" for="show-password">Tampilkan Password</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="level" class="form-label">Level</label>
                                <select name="level" id="level" class="form-control" required>
                                    <option value="1" {{ old('level', 1) == 1 ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ old('level', 1) == 2 ? 'selected' : '' }}>2</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">SIMPAN</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">KEMBALI</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const passwordToggle = document.getElementById('show-password');
            passwordInput.type = passwordToggle.checked ? 'text' : 'password';
        }
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


