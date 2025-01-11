<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Menambahkan link ke Bootstrap untuk styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Menambahkan custom CSS jika diperlukan -->
    <style>
        body {
            background-color: #E7E8D8;
            font-family: 'Arial', sans-serif;
        }
        .form-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            color: #BC9F8B;
            font-weight: bold;
            margin-bottom: 30px;
        }
        .form-container label {
            font-weight: bold;
        }
        .form-container .btn {
            background-color: #BC9F8B;
            color: white;
            border: none;
            font-weight: bold;
        }
        .form-container .btn:hover {
            background-color: #a17e6a;
        }
        .form-container .form-group input {
            border-radius: 5px;
            border: 1px solid #BC9F8B;
        }
        .form-container .hr-custom {
            border: 0;
            border-top: 1px solid #BC9F8B;
            margin: 20px 0;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="form-container">
        <h2 class="text-center">Register</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" placeholder="Nama Lengkap" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Masukan Email anda" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Password minimal 8" id="password" class="form-control @error('password') is-invalid @enderror" required>
                    <button type="button" class="input-group-text" id="toggle-password" aria-label="Toggle password visibility">
                        <i class="bi bi-eye-slash"></i>
                    </button>
                </div>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <div class="input-group">
                    <input type="password" name="password_confirmation" placeholder="Masukkan password kembali" id="password_confirmation" class="form-control" required>
                    <button type="button" class="input-group-text" id="toggle-password-confirmation" aria-label="Toggle password confirmation visibility">
                        <i class="bi bi-eye-slash"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block mt-2">Daftar</button>
        </form>

        <hr class="hr-custom">

        <p class="text-center">Sudah punya akun? <a href="{{ route('pengguna.login') }}">Login disini</a></p>
    </div>
</div>

<script>
    // Toggle visibility for password
    document.getElementById('toggle-password').addEventListener('click', function() {
        var passwordField = document.getElementById('password');
        var icon = this.querySelector('i');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        } else {
            passwordField.type = 'password';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        }
    });

    // Toggle visibility for password confirmation
    document.getElementById('toggle-password-confirmation').addEventListener('click', function() {
        var passwordConfirmationField = document.getElementById('password_confirmation');
        var icon = this.querySelector('i');
        if (passwordConfirmationField.type === 'password') {
            passwordConfirmationField.type = 'text';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        } else {
            passwordConfirmationField.type = 'password';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            // SweetAlert message
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
