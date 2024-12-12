@extends('theme.default')

@section('title', 'Edit Pengguna')

@section('content')

<style>
    .card{
        margin: 30px;
    }
</style>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center">Edit Pengguna</h3>
            <div class="card border-0 shadow-sm rounded mt-4">
                <div class="card-body">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">KEMBALI</a>
                    <form action="{{ route('users.update', $user->id_user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="level" class="form-label">Level</label>
                            <select name="level" id="level" class="form-control" required>
                                <option value="1" {{ old('level', $user->level) == 1 ? 'selected' : '' }}>Admin</option>
                                <option value="2" {{ old('level', $user->level) == 2 ? 'selected' : '' }}>Karyawan</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">UPDATE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
