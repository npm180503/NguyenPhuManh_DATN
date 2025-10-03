@extends('frontend.layout')

@section('content')
    <div class="container py-5 mt-5">
        <h2 class="mb-4 text-center text-primary fw-bold">Hồ sơ cá nhân</h2>

        {{-- Flash message --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="row g-0">
                {{-- Avatar --}}
                <div class="col-md-4 d-flex justify-content-center align-items-center bg-light p-4">
                    <div class="text-center">
                        <img src="{{ asset($user->thumb) }}" alt="Avatar"
                            class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        <h5 class="fw-bold">{{ $user->name }}</h5>
                        <p class="text-muted">{{ $user->email }}</p>
                    </div>
                </div>

                {{-- Form thông tin --}}
                <div class="col-md-8 p-4">
                    <form action="{{ route('fr.user.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Họ và tên --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Họ và tên</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name) }}">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email) }}">
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Số điện thoại --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Số điện thoại</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Mật khẩu cũ --}}
                        {{-- Mật khẩu cũ --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Mật khẩu cũ</label>
                            <input type="password" name="current_password"
                                class="form-control @error('current_password') is-invalid @enderror">
                            @error('current_password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Mật khẩu mới --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Mật khẩu mới (nếu muốn thay đổi)</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Xác nhận mật khẩu --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Xác nhận mật khẩu</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>


                        {{-- Avatar upload --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Avatar</label>
                            <input type="file" name="thumb" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold">
                            <i class="bi bi-save2 me-1"></i> Cập nhật hồ sơ
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
