<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
    <style>
        .left-section {
            background-color: #E7E8D8;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
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
            background-color: rgba(231, 232, 216, 0.5); /* Warna transparan */
            color: #333; /* Warna teks */
            border: 1px solid #333; /* Border */
            transition: background-color 0.3s; /* Transisi halus untuk hover */
        }
        .btn:hover {
            background-color: #9DBDFF; /* Warna solid saat hover */
            color: #333; /* Warna teks tetap */
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Bagian Kiri (1/3) -->
            <div class="col-md-4 left-section">
                <div class="text-center">
                    <h2>Selamat Datang di Toko Shadad</h2>
                    <p>Kami siap membantu memenuhi kebutuhan perlengkapan rumah Anda.</p>
                </div>
            </div>

            <!-- Bagian Kanan (2/3) -->
            <div class="col-md-8 right-section">
                <div class="login-container">
                    <h2 class="text-center">Login</h2>
                    <h6 class="text-center">Masukkan detail akun Anda untuk mengakses sistem pendataan barang Toko Shadad.</h6>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
