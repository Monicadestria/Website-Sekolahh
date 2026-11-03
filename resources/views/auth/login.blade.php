@extends('layouts.guest')

@section('content')
    <div class="header-text text-center mb-4">
        <h2>Silahkan Masuk</h2>
        <p>Masukan Email dan Kata Sandi Akun Anda!</p>
    </div>

    <form id="loginForm" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-item input-group">
            <input type="email" id="email" name="email" value="{{ old('email') }}" autocomplete="off" class="rounded-3 @error('email') is-invalid @enderror">
            <label for="email">Email</label>
            @error('email')
                {{-- <div class="invalid-feedback">
                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                </div> --}}
            @else
                <div class="invalid-feedback" id="emailError" style="display: none;"><i class="fas fa-exclamation-circle"></i> Email harus diisi</div>
            @enderror
        </div>

        <div class="form-item password-group input-group mt-2" style="position: relative;">
            <input type="password" id="password" name="password" autocomplete="off" class="rounded-3 @error('password') is-invalid @enderror">
            <label for="password">Kata Sandi</label>
            <span id="password-toggle" class="password-toggle" onclick="togglePassword('password')" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                <i id="password-icon" class="fas fa-eye-slash"></i>
            </span>
            @error('password')
                {{-- <div class="invalid-feedback">
                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                </div> --}}
            @else
                <div class="invalid-feedback errors" id="passwordError" style="display: none;"><i class="fas fa-exclamation-circle"></i> Kata sandi harus diisi</div>
            @enderror
        </div>

        @if ($errors->any())
            <div class="text-danger mb-3">
                <i class="fas fa-exclamation-circle"></i> Email atau kata sandi salah.
            </div>
        @endif

        <div class="input-group mb-3 d-flex justify-content-between">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label for="remember" class="form-check-label text-dark">
                    <small>{{ __('ingat saya') }}</small>
                </label>
            </div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="regulasi mb-4">Lupa Kata Sandi?</a>
            @endif
        </div>

        <div class="input-group mb-3 justify-content-center">
            <button type="submit" class="btn btn-lg btn-primary w-40 fs-6">Masuk</button>
        </div>

        <div class="align-items-center text-center">
            <small class="mt-4 mb-4 align-items-center">
                Belum memiliki akun?
                <a href="{{ route('register') }}" class="regulasi mb-4">Daftar</a>
            </small>
        </div>
    </form>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            var valid = true;
            var email = document.getElementById('email');
            var password = document.getElementById('password');

            var emailError = document.getElementById('emailError');
            var passwordError = document.getElementById('passwordError');
            
            emailError.style.display = 'none';
            passwordError.style.display = 'none';

            if (!email.value) {
                emailError.style.display = 'block';
                email.classList.add('invalid-border'); // Tambahkan class invalid-border saat input kosong
                valid = false;
            } else {
                email.classList.remove('invalid-border'); // Hapus class invalid-border jika input terisi
            }
            if (!password.value) {
                passwordError.style.display = 'block';
                password.classList.add('invalid-border'); // Tambahkan class invalid-border saat input kosong
                valid = false;
            } else {
                password.classList.remove('invalid-border'); // Hapus class invalid-border jika input terisi
            }

            // Adjust the position of the password toggle icon based on password and password confirmation errors
            const passwordToggles = document.querySelectorAll('.password-toggle');
            const passwordErrors = document.querySelectorAll('.errors');
            const hasPasswordError = [...passwordErrors].some(el => el.innerText && el.id.includes('password'));

            if (!valid) {
                if (!hasPasswordError) {
                    passwordToggles.forEach(toggle => toggle.style.top = '50%');
                } else {
                    passwordToggles.forEach(toggle => toggle.style.top = '35%');
                }
            } else {
                // Form valid, set default top position
                passwordToggles.forEach(toggle => toggle.style.top = '50%');
            }

            if (!valid) {
                adjustTogglePosition();
                event.preventDefault();
            }
        });

        function togglePassword(id) {
            var input = document.getElementById(id);
            var icon = document.getElementById(id + '-icon');
            var passwordToggles = document.querySelectorAll('.password-toggle');
            var isValid = document.getElementById('loginForm').checkValidity();

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
                if (!isValid) {
                    passwordToggles.forEach(toggle => toggle.style.top = '0%');
                } else {
                    passwordToggles.forEach(toggle => toggle.style.top = '0%');
                }
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
                if (!isValid) {
                    passwordToggles.forEach(toggle => toggle.style.top = '0%');
                } else {
                    passwordToggles.forEach(toggle => toggle.style.top = '0%');
                }
            }
        }

        function adjustTogglePosition() {
            const passwordToggle = document.getElementById('password-toggle');
            const passwordError = document.getElementById('passwordError');

            if (passwordError.style.display === 'block') {
                passwordToggle.style.top = '33%'; // **Perubahan posisi ikon ketika ada kesalahan**
            } else {
                passwordToggle.style.top = '50%'; // **Posisi default**
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('loginForm');
        var email = document.getElementById('email');
        var password = document.getElementById('password');
        var emailError = document.getElementById('emailError');
        var passwordError = document.getElementById('passwordError');

        function validateInputs() {
            var isValid = true;

            // Validate email
            if (!email.value.trim()) {
                emailError.style.display = 'block';
                email.classList.add('invalid-border');
                isValid = false;
            } else {
                emailError.style.display = 'none';
                email.classList.remove('invalid-border');
            }

            // Validate password
            if (!password.value.trim()) {
                passwordError.style.display = 'block';
                password.classList.add('invalid-border');
                isValid = false;
            } else {
                passwordError.style.display = 'none';
                password.classList.remove('invalid-border');
            }
            adjustTogglePosition();
            return isValid;
        }

        // Handle form submission
        form.addEventListener('submit', function(event) {
            if (!validateInputs()) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });

        // Handle input focus
        email.addEventListener('focus', function() {
            if (!email.value.trim()) {
                emailError.style.display = 'none';
                email.classList.remove('invalid-border');
            }
        });

        password.addEventListener('focus', function() {
            if (!password.value.trim()) {
                passwordError.style.display = 'none';
                password.classList.remove('invalid-border');
            }
            adjustTogglePosition();
        });

        // Handle input and validate on change
        email.addEventListener('input', function() {
            if (email.value.trim()) {
                emailError.style.display = 'none';
                email.classList.remove('invalid-border');
            }
        });

        password.addEventListener('input', function() {
            if (password.value.trim()) {
                passwordError.style.display = 'none';
                password.classList.remove('invalid-border');
            }
            adjustTogglePosition();
        });
        });
    </script>

    <script src="{{ asset('assets/vendor/local_libs/sweetalert2@11.js') }}"></script>
    @if (session('register_success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('register_success') }}'
                });
            });
        </script>
    @endif
@endsection
