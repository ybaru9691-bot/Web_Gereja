@extends('layouts.main')

@section('content')

<div class="container d-flex justify-content-center align-items-center"
     style="min-height: 80vh;">

    <div class="login-card p-4 shadow rounded"
         style="width: 420px; background:#fff;">

        <h3 class="text-center mb-4 fw-bold">
            Login Admin & Pendeta
        </h3>

        {{-- pesan status / error --}}
        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.process') }}">
    @csrf
            {{-- EMAIL --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email"
                       class="form-control rounded-pill"
                       placeholder="Email admin / pendeta"
                       required>
            </div>

            {{-- PASSWORD --}}
            <div class="mb-2">
                <label class="form-label fw-bold">Password</label>
                <input type="password" name="password"
                       class="form-control rounded-pill"
                       placeholder="Minimal 8 karakter"
                       required>
            </div>

            <div class="text-end mb-3">
                <a href="{{ route('password.request') }}" class="text-decoration-none">
                    Lupa password?
                </a>
            </div>

            {{-- BUTTON LOGIN --}}
            <button type="submit"
                    class="btn btn-primary w-100 rounded-pill">
                Login
            </button>
        </form>

    </div>

</div>

@endsection
