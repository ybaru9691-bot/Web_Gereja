<!-- This reset view is no longer used by the simplified direct-reset flow. -->
@extends('layouts.main')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height:70vh;">
    <div class="login-card p-4 shadow rounded" style="width:420px;background:#fff;">
        <h3 class="text-center mb-3">Reset Password (Deprecated)</h3>
        <p class="small text-muted">Reset via token link is disabled. Silakan gunakan form <a href="{{ route('password.request') }}">Lupa Password</a> untuk mereset password langsung.</p>
    </div>
</div>
@endsection