@extends('layouts.register')

@section('content')
    <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
            <div class="col-md-8 col-lg-6 col-xxl-3">
                <div class="card mb-0">
                    <div class="card-body">
                        <a class="text-nowrap logo-img text-center d-block py-3 w-100">
                            <img src="{{ 'assets/images/logos/logopoltekpel.png' }}" width="100" alt="">
                        </a>
                        <p class="text-center mb-4">Sistem Monitoring BBM Kapal</p>
                        <form method="POST" action="{{ route('register.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>

                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control" required>
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                        <i class="bi bi-eye" id="eyeIcon"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Progress Bar -->
                            <div class="mb-2">
                                <div class="progress" style="height: 6px;">
                                    <div id="strength-bar" class="progress-bar" style="width: 0%;"></div>
                                </div>
                                <small id="strength-text"></small>
                            </div>

                            <!-- indikator password -->
                            <div id="password-rules" class="mb-3">
                                <small id="length" class="text-danger">• Minimal 8 karakter</small><br>
                                <small id="uppercase" class="text-danger">• Huruf besar</small><br>
                                <small id="lowercase" class="text-danger">• Huruf kecil</small><br>
                                <small id="number" class="text-danger">• Angka</small>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                            {{-- <div class="d-flex align-items-center justify-content-center">
                                <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                                <a class="text-primary fw-bold ms-2" href="./authentication-login.html">Sign In</a>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const password = document.getElementById('password');
        const toggle = document.getElementById('togglePassword');
        const eyeIcon = document.getElementById('eyeIcon');

        const strengthBar = document.getElementById('strength-bar');
        const strengthText = document.getElementById('strength-text');

        // SHOW / HIDE PASSWORD
        toggle.addEventListener('click', function() {
            const isPassword = password.type === 'password';

            password.type = isPassword ? 'text' : 'password';

            // ganti icon
            eyeIcon.classList.toggle('bi-eye');
            eyeIcon.classList.toggle('bi-eye-slash');
        });

        password.addEventListener('keyup', function() {
            const val = password.value;

            // rules
            const length = val.length >= 8;
            const uppercase = /[A-Z]/.test(val);
            const lowercase = /[a-z]/.test(val);
            const number = /[0-9]/.test(val);

            let score = 0;
            if (length) score++;
            if (uppercase) score++;
            if (lowercase) score++;
            if (number) score++;

            // indikator checklist
            document.getElementById('length').className = length ? 'text-success' : 'text-danger';
            document.getElementById('uppercase').className = uppercase ? 'text-success' : 'text-danger';
            document.getElementById('lowercase').className = lowercase ? 'text-success' : 'text-danger';
            document.getElementById('number').className = number ? 'text-success' : 'text-danger';

            // progress bar
            let width = (score / 4) * 100;
            strengthBar.style.width = width + '%';

            // warna & text
            if (score <= 1) {
                strengthBar.className = 'progress-bar bg-danger';
                strengthText.innerText = 'Password Lemah';
            } else if (score == 2) {
                strengthBar.className = 'progress-bar bg-warning';
                strengthText.innerText = 'Password Cukup';
            } else if (score == 3) {
                strengthBar.className = 'progress-bar bg-info';
                strengthText.innerText = 'Password Kuat';
            } else {
                strengthBar.className = 'progress-bar bg-success';
                strengthText.innerText = 'Password Sangat Kuat 🔥';
            }
        });
    </script>
@endsection
