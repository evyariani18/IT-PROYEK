<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <title>Login</title>
    <style>
        .left-section {
            background-color: #E7E8D8;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
            text-align: center;
            flex-direction: column;
        }
        .right-section {
            background-color: #BC9F8B;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
        }
        .btn {
            background-color: rgba(231, 232, 216, 0.5);
            color: #333;
            border: 1px solid #333;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #9DBDFF;
            color: #333;
        }
        .logo {
            width: 50px !important;
            height: auto !important;
            margin-bottom: 20px;
        }
        .input-group-text {
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Bagian Kiri (1/3) -->
        <div class="col-md-4 left-section">
            <div class="text-center">
                <!-- Logo -->
                <img src="{{ asset('storage/images/logo.png') }}" alt="Logo Toko Shadad">
                <!-- Teks Selamat Datang -->
                <h2>Selamat Datang di Toko Shadad</h2>
                <p>Kami siap membantu memenuhi kebutuhan perlengkapan rumah Anda.</p>
            </div>
        </div>

        <!-- Bagian Kanan (2/3) -->
        <div class="col-md-8 right-section">
            <div class="login-container">
                <!-- Form Login -->
                <h2 class="text-center">Login</h2>
                <h6 class="text-center">
                    Masukkan detail akun Anda untuk mengakses sistem pendataan barang Toko Shadad.
                </h6>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email" required>
                        </div>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password" required>
                            <span class="input-group-text" id="toggle-password">
                                <i class="bi bi-eye-slash"></i>
                            </span>
                        </div>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                    <p style="text-align:center;">Belum memiliki akun? <a href="/register">Daftar</a></p>
                </form>
            </div>
        </div>
    </div>
</div>

    <script>
        const togglePassword = document.getElementById('toggle-password');
        const passwordField = document.getElementById('password');
        togglePassword.addEventListener('click', function() {
            // Toggle the type attribute
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;

            // Toggle the eye icon
            this.innerHTML = type === 'password' ? '<i class="bi bi-eye-slash"></i>' : '<i class="bi bi-eye"></i>';
        });
    </script>
</body>
</html>
