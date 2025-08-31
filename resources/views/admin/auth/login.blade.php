@extends('admin.layouts.auth')

@section('content')
<div class="card shadow-lg border-0">
    <div class="card-body p-5">
        <div class="text-center mb-4">
            <h1 class="h4 text-gray-900">Selamat Datang!</h1>
            <p class="text-muted">Silakan login ke Panel Admin Gampong Udeung</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger text-sm">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Alamat Email</label>
                <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com">
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control form-control-lg" id="password" name="password" required placeholder="Password">
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Login</button>
            </div>
        </form>
    </div>
</div>
@endsection