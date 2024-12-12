@extends('theme.default')

@section('title', 'Tambah Pengguna')

@section('content')

<style>
    .form-label {
        font-weight: bold;
    }

    .form-control {
        border-radius: 8px;
    }

</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-10 shadow-sm rounded">
                <div class="card-header text-center">
                    <h3>Tambah Pembelian</h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">KEMBALI</a>
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
                            <input type="password" name="password" id="password" class="form-control" required>
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
                                <option value="1" {{ old('level', 1) == 1 ? 'selected' : '' }}>Admin</option>
                                <option value="2" {{ old('level', 1) == 2 ? 'selected' : '' }}>Karyawan</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function togglePasswordVisibility() {
    const passwordInput = document.querySelector('#password');
    const passwordToggle = document.querySelector('#show-password');
    
    if (passwordInput && passwordToggle) {
        passwordInput.type = passwordToggle.checked ? 'text' : 'password';
    } else {
        console.error('Input password atau checkbox tidak ditemukan.');
    }
}
</script>
@endpush
