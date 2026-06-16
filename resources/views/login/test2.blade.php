@extends('layouts.test')

@section('content')
    <section class="login-card" role="main" aria-labelledby="login-title">
        <div class="logo-wrapper">
            <img src="{{ asset('assets/images/logos/logopoltekpel.png') }}" alt="Logo Politeknik Pelayaran Surabaya"
                loading="eager">
        </div>

        <header class="login-header">
            <div class="blu-badge" aria-label="Status Badan Layanan Umum">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2.5" aria-hidden="true">
                    <path d="M9 12l2 2 4-4"></path>
                    <path d="M12 2L4 5v6c0 5 3.5 9 8 11 4.5-2 8-6 8-11V5l-8-3z"></path>
                </svg>
                <span>Automatic CII Calculation System</span>
            </div>
            <h1 id="login-title">SIGN UP</h1>
        </header>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register.store') }}" id="login-form" novalidate autocomplete="on">
            @csrf
            <div class="form-group">
                <input type="text" name="name" id="name" placeholder="Username" autocomplete="name" required
                    aria-label="Username" autocapitalize="on" autocorrect="off" spellcheck="false">
                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    aria-hidden="true">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </div>
            <div class="form-group">
                <input type="text" name="email" id="email" placeholder="Email" autocomplete="email" required
                    aria-label="Email" autocapitalize="off" autocorrect="off" spellcheck="false">
                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    aria-hidden="true">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </div>

            <div class="form-group">
                <input type="password" name="password" id="password" placeholder="Password" autocomplete="current-password"
                    required aria-label="Password">
                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    aria-hidden="true">
                    <rect x="3" y="11" width="18" height="11" rx="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
                <button type="button" class="toggle-pwd" id="togglePwd" aria-label="Tampilkan password">
                    <svg id="iconShow" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    <svg id="iconHide" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" style="display:none">
                        <path
                            d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24">
                        </path>
                        <line x1="1" y1="1" x2="23" y2="23"></line>
                    </svg>
                </button>
            </div>
            
            <button type="submit" class="btn-submit">
                <span>
                    Daftar
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </span>
            </button>


        </form>

        <div id="balikan" aria-live="polite"></div>

        <footer class="login-footer">
            &copy; 2026 Versi 1.0 | Developed <br>
        </footer>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const password = document.getElementById('password');
            const toggle = document.getElementById('togglePwd');
            const iconShow = document.getElementById('iconShow');
            const iconHide = document.getElementById('iconHide');

            const strengthBar = document.getElementById('strength-bar');
            const strengthText = document.getElementById('strength-text');
            //     password.addEventListener('input', function () {
            //     console.log("jalan"); // cek ini muncul atau tidak
            // });
            // console.log("SCRIPT KELOAD");

            // =========================
            // TOGGLE PASSWORD
            // =========================
            toggle.addEventListener('click', function() {
                const isPassword = password.type === 'password';

                password.type = isPassword ? 'text' : 'password';

                iconShow.style.display = isPassword ? 'none' : 'block';
                iconHide.style.display = isPassword ? 'block' : 'none';
            });

            // =========================
            // PASSWORD STRENGTH
            // =========================
            password.addEventListener('input', function() {
                const val = password.value;

                const length = val.length >= 8;
                const uppercase = /[A-Z]/.test(val);
                const lowercase = /[a-z]/.test(val);
                const number = /[0-9]/.test(val);

                let score = 0;
                if (length) score++;
                if (uppercase) score++;
                if (lowercase) score++;
                if (number) score++;

                // rules indicator
                document.getElementById('length').className = length ? 'text-success' : 'text-danger';
                document.getElementById('uppercase').className = uppercase ? 'text-success' : 'text-danger';
                document.getElementById('lowercase').className = lowercase ? 'text-success' : 'text-danger';
                document.getElementById('number').className = number ? 'text-success' : 'text-danger';

                // progress bar
                let width = (score / 4) * 100;
                strengthBar.style.width = width + '%';

                // status
                strengthBar.classList.remove('bg-danger', 'bg-warning', 'bg-info', 'bg-success');

                if (score <= 1) {
                    strengthBar.classList.add('bg-danger');
                    strengthText.innerText = 'Password Lemah';
                } else if (score == 2) {
                    strengthBar.classList.add('bg-warning');
                    strengthText.innerText = 'Password Cukup';
                } else if (score == 3) {
                    strengthBar.classList.add('bg-info');
                    strengthText.innerText = 'Password Kuat';
                } else {
                    strengthBar.classList.add('bg-success');
                    strengthText.innerText = 'Password Sangat Kuat';
                }
            });

        });
    </script>
@endsection
