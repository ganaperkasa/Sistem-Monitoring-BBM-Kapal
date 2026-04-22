@extends('layouts.login')

@section('content')
    <div class="d-flex align-items-center justify-content-center w-100" style="min-height: 100vh;">
        <div class="row justify-content-center w-100">
            <div class="col-md-8 col-lg-6 col-xxl-3">

                <div class="card mb-0">
                    <div class="card-body">

                        <a class="text-nowrap logo-img text-center d-block py-3 w-100">
                            <img src="{{ 'assets/images/logos/logopoltekpel.png' }}" width="100" alt="">
                        </a>
                        <p class="text-center mb-1 fw-bold">Sistem Monitoring BBM Kapal</p>
                        <p class="text-center text-muted mb-4" style="font-size: 13px;">
                            Silahkan masukkan email dan password
                        </p>
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login.post') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" name="password" class="form-control" id="password" required>

                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                        <i class="bi bi-eye" id="eyeIcon"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <a class="text-primary fw-bold" href="#">Forgot Password ?</a>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2 fs-5 mb-3 rounded-2">
                                Sign In
                            </button>

                            <!-- REGISTER -->
                            <div class="d-flex align-items-center justify-content-center">
                                <p class="fs-3 mb-0 fw-bold">Don't have account?</p> <a class="text-primary fw-bold ms-2"
                                    href="{{ route('register') }}">Create an account</a>
                            </div>

                            <div class="text-center mt-3">
                                <small class="text-muted">
                                    Versi 1.0 | Developed
                                </small>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <small class="text-light">
                        © 2026 Sistem Monitoring BBM Kapal. All Rights Reserved.
                    </small>
                </div>

            </div>
        </div>
    </div>

    <script>
        const password = document.getElementById('password');
        const toggle = document.getElementById('togglePassword');
        const eyeIcon = document.getElementById('eyeIcon');

        toggle.addEventListener('click', function() {
            const isPassword = password.type === 'password';

            password.type = isPassword ? 'text' : 'password';

            eyeIcon.classList.toggle('bi-eye');
            eyeIcon.classList.toggle('bi-eye-slash');
        });
    </script>
@endsection
