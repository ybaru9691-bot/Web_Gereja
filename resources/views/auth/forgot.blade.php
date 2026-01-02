@extends('layouts.main')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height:70vh;">
    <div class="login-card p-4 shadow rounded" style="width:420px;background:#fff;">
        <h3 class="text-center mb-3">Lupa Password</h3>

        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Masukkan Email Anda</label>
                <input type="email" name="email" class="form-control rounded-pill" placeholder="Email terdaftar" required>
                @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Password Baru</label>
                <input type="password" name="password" class="form-control rounded-pill" placeholder="Minimal 8 karakter" required>
                @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control rounded-pill" required>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('login') }}" class="text-decoration-none">Kembali ke Login</a>
                <button class="btn btn-primary rounded-pill">Reset Password Sekarang</button>
            </div>
        </form>

       
    </div>
</div>
@endsection