<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/reset_password.css') }}">
    <title>Reset Password</title>
    <style>
        .input-error {
            border-color: red !important;
        }
        .input-active {
            border-color: blue !important;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-6 right-box justify-content-center align-items-center">
                <div class="row align-items-center">
                    <div class="header-text text-center">
                        <h2>Lupa Kata Sandi?</h2>
                        <p>Ganti Kata Sandi Anda Sekarang!</p>
                    </div>
                    <form id="resetPasswordForm" method="POST" action="{{ route('password.store') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="form-item input-group">
                            <input type="email" id="email" name="email" autocomplete="off" class="rounded-3" value="{{ old('email', $request->email) }}">
                            <label for="email">Email</label>
                            <div class="text-danger" id="emailError" style="display: none;"><i class="fas fa-exclamation-circle"></i> Isi Email Anda</div>
                            @error('email')
                                <div class="text-danger"><i class="fas fa-exclamation-circle"></i> Email Tidak valid</div>
                            @enderror
                        </div>
                        <div class="form-item password-group input-group">
                            <input type="password" id="password" name="password" autocomplete="off" class="rounded-3">
                            <label for="password">Kata Sandi</label>
                            <span class="password-toggle ptg-1" onclick="togglePassword('password')">
                                <i id="password-icon" class="fas fa-eye-slash"></i>
                            </span>
                            <div class="text-danger er-1" id="passwordError" style="display: none;"><i class="fas fa-exclamation-circle"></i> Kata sandi harus diisi.</div>
                        </div>
                        <div class="form-item password-group input-group">
                            <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="off" class="rounded-3">
                            <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                            <span class="password-toggle ptg-2" onclick="togglePassword('password_confirmation')">
                                <i id="password_confirmation-icon" class="fas fa-eye-slash"></i>
                            </span>
                            <div class="text-danger er-2" id="password_confirmation-error" style="display: none;"><i class="fas fa-exclamation-circle"></i> Konfirmasi kata sandi harus diisi.</div>
                            @error('password_confirmation')
                                <div class="text-danger er-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                            <div class="text-danger er-2" id="mismatchError" style="display: none;"><i class="fas fa-exclamation-circle"></i> Kata sandi tidak sama, isikan kata sandi baru</div>
                        </div>
                        <div class="input-group mb-3 justify-content-center">
                            <button class="btn btn-lg btn-primary w-40 fs-6" type="submit">Ubah Sandi</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-center align-items-center flex-column left-box">
                <img src="{{ asset('img/gambar.jpeg') }}" class="img-fluid img-sekolah rounded-4 justify-content-center align-items-center" />
            </div>
        </div>
    </div>
    <script src="{{ asset('js/password.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('password_confirmation');
    const formItems = document.querySelectorAll('.form-item input');

    function validateField(field, errorId) {
        if (!field.value.trim()) {
            document.getElementById(errorId).style.display = 'block';
            field.classList.add('input-error');
        } else {
            document.getElementById(errorId).style.display = 'none';
            field.classList.remove('input-error');
        }
    }

    function validatePasswordMatch() {
        if (password.value.trim() && confirmPassword.value.trim() && password.value !== confirmPassword.value) {
            document.getElementById('mismatchError').style.display = 'block';
            confirmPassword.classList.add('input-error');
        } else {
            document.getElementById('mismatchError').style.display = 'none';
            confirmPassword.classList.remove('input-error');
        }
    }

    formItems.forEach(item => {
        item.addEventListener('focus', (event) => {
            event.target.classList.add('focus-border');
        });

        item.addEventListener('input', (event) => {
            const target = event.target;
            const errorId = target.id + 'Error';
            const errorIds = target.id + '-error';

            if (target.id === 'password' || target.id === 'password_confirmation') {
                validatePasswordMatch();
            }

            if (document.getElementById(errorId)) {
                validateField(target, errorId);
            }
            if (document.getElementById(errorIds)) {
                validateField(target, errorIds);
            }

            adjustTogglePosition();
        });

        item.addEventListener('blur', (event) => {
            event.target.classList.remove('focus-border');
        });
    });

    document.getElementById('resetPasswordForm').addEventListener('submit', function(event) {
        let valid = true;
        document.getElementById('emailError').style.display = 'none';
        document.getElementById('passwordError').style.display = 'none';
        document.getElementById('password_confirmation-error').style.display = 'none';
        document.getElementById('mismatchError').style.display = 'none';

        email.classList.remove('input-error');
        password.classList.remove('input-error');
        confirmPassword.classList.remove('input-error');

        if (!email.value.trim()) {
            document.getElementById('emailError').style.display = 'block';
            email.classList.add('input-error');
            valid = false;
        }
        if (!password.value.trim()) {
            document.getElementById('passwordError').style.display = 'block';
            password.classList.add('input-error');
            valid = false;
        }
        if (!confirmPassword.value.trim()) {
            document.getElementById('password_confirmation-error').style.display = 'block';
            confirmPassword.classList.add('input-error');
            valid = false;
        }
        if (password.value.trim() && confirmPassword.value.trim() && password.value !== confirmPassword.value) {
            document.getElementById('mismatchError').style.display = 'block';
            confirmPassword.classList.add('input-error');
            valid = false;
        }

        if (!valid) {
            event.preventDefault();
        }
        adjustTogglePosition();
    });

    function adjustTogglePosition() {
        const passwordToggles1 = document.querySelectorAll('.ptg-1');
        const passwordToggles2 = document.querySelectorAll('.ptg-2');
        const passwordErrors1 = document.querySelectorAll('.er-1');
        const passwordErrors2 = document.querySelectorAll('.er-2');

        const hasPasswordError = [...passwordErrors1].some(el => el.style.display !== 'none');
        const hasPasswordConfirmationError = [...passwordErrors2].some(el => el.style.display !== 'none');

        if (hasPasswordError && hasPasswordConfirmationError) {
            passwordToggles1.forEach(toggle => toggle.style.top = '36%');
            passwordToggles2.forEach(toggle => toggle.style.top = '36%');
        } else if (hasPasswordError && !hasPasswordConfirmationError) {
            passwordToggles1.forEach(toggle => toggle.style.top = '36%');
            passwordToggles2.forEach(toggle => toggle.style.top = '47%');
        } else if (!hasPasswordError && hasPasswordConfirmationError) {
            passwordToggles1.forEach(toggle => toggle.style.top = '49%');
            passwordToggles2.forEach(toggle => toggle.style.top = '37%');
        } else {
            passwordToggles1.forEach(toggle => toggle.style.top = '50%');
            passwordToggles2.forEach(toggle => toggle.style.top = '50%');
        }
    }

    document.querySelectorAll('.toggle-password').forEach(toggle => {
        toggle.addEventListener('click', () => {
            const input = document.getElementById(toggle.dataset.toggle);
            const icon = toggle.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }

            if (!input.value.trim()) {
                input.value = '';
            }
            adjustTogglePosition();
        });
    });
});

        </script>
        
</body>
</html>


{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/reset_password.css') }}">
    <title>Reset Password</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-6 right-box justify-content-center align-items-center">
                <div class="row align-items-center">
                    <div class="header-text text-center">
                        <h2>Lupa Kata Sandi?</h2>
                        <p>Ganti Kata Sandi Anda Sekarang!</p>
                    </div>
                    <form id="resetPasswordForm" method="POST" action="{{ route('password.store') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="form-item input-group">
                            <input type="email" id="email" name="email" autocomplete="off" class="rounded-3" value="{{ old('email', $request->email) }}">
                            <label for="email">Email</label>
                            <div class="text-danger" id="emailError" style="display: none;"><i class="fas fa-exclamation-circle"></i> Isi Email Anda</div> <!-- Tambah ikon di sini -->
                            @error('email')
                                <div class="text-danger"><i class="fas fa-exclamation-circle"></i> Email Tidak Terdaftar</div> <!-- Tambah ikon di sini -->
                            @enderror
                        </div>
                        <div class="form-item password-group input-group">
                            <input type="password" id="password" name="password" autocomplete="off" class="rounded-3">
                            <label for="password">Kata Sandi</label>
                            <span class="password-toggle ptg-1" onclick="togglePassword('password')">
                                <i id="password-icon" class="fas fa-eye-slash"></i>
                            </span>
                            <div class="text-danger er-1" id="passwordError" style="display: none;"><i class="fas fa-exclamation-circle"></i> Isi Kata Sandi Anda</div> <!-- Tambah ikon di sini -->
                        </div>

                        <div class="form-item password-group input-group">
                            <input type="password" id="confirm-password" name="password_confirmation" autocomplete="off" class="rounded-3">
                            <label for="confirm-password">Konfirmasi Kata Sandi</label>
                            <span class="password-toggle ptg-2" onclick="togglePassword('confirm-password')">
                                <i id="confirm-password-icon" class="fas fa-eye-slash"></i>
                            </span>
                            <div class="text-danger er-2" id="confirmPasswordError" style="display: none;"><i class="fas fa-exclamation-circle"></i> Isi Kata Sandi Anda</div> <!-- Tambah ikon di sini -->
                            @error('password_confirmation')
                                <div class="text-danger"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div> <!-- Tambah ikon di sini -->
                            @enderror
                            <div class="text-danger er-2" id="mismatchError" style="display: none;"><i class="fas fa-exclamation-circle"></i> Kata sandi tidak sama, isikan kata sandi baru</div> <!-- Tambah ikon di sini -->
                        </div>
                        
                        <div class="input-group mb-3 justify-content-center">
                            <button class="btn btn-lg btn-primary w-40 fs-6" type="submit">Ubah Sandi</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-center align-items-center flex-column left-box">
                <img src="{{ asset('img/anak.png') }}" class="img-fluid img-sekolah rounded-4 justify-content-center align-items-center" />
                
            </div>
        </div>
    </div>
    <script src="{{ asset('js/password.js') }}"></script>
    <script>
        document.getElementById('resetPasswordForm').addEventListener('submit', function(event) {
            var valid = true;
            var email = document.getElementById('email');
            var password = document.getElementById('password');
            var confirmPassword = document.getElementById('confirm-password');
            
            document.getElementById('emailError').style.display = 'none';
            document.getElementById('passwordError').style.display = 'none';
            document.getElementById('confirmPasswordError').style.display = 'none';
            document.getElementById('mismatchError').style.display = 'none';
    
            if (!email.value) {
                document.getElementById('emailError').style.display = 'block';
                valid = false;
            }
            if (!password.value) {
                document.getElementById('passwordError').style.display = 'block';
                valid = false;
            }
            if (!confirmPassword.value) {
                document.getElementById('confirmPasswordError').style.display = 'block';
                valid = false;
            }
            if (password.value && confirmPassword.value && password.value !== confirmPassword.value) {
                document.getElementById('mismatchError').style.display = 'block';
                valid = false;
            }
            
            if (!valid) {
                event.preventDefault();
            }
            adjustTogglePosition();
        });
    
        function adjustTogglePosition() {
            const passwordToggles1 = document.querySelectorAll('.ptg-1');
            const passwordToggles2 = document.querySelectorAll('.ptg-2');
            const passwordErrors1 = document.querySelectorAll('.er-1');
            const passwordErrors2 = document.querySelectorAll('.er-2');
    
            const hasPasswordError = [...passwordErrors1].some(el => el.style.display !== 'none');
            const hasPasswordConfirmationError = [...passwordErrors2].some(el => el.style.display !== 'none');
    
            if (hasPasswordError && hasPasswordConfirmationError) {
                passwordToggles1.forEach(toggle => toggle.style.top = '36%');
                passwordToggles2.forEach(toggle => toggle.style.top = '36%');
            } else if (hasPasswordError && !hasPasswordConfirmationError) {
                passwordToggles1.forEach(toggle => toggle.style.top = '36%');
                passwordToggles2.forEach(toggle => toggle.style.top = '47%');
            } else if (!hasPasswordError && hasPasswordConfirmationError) {
                passwordToggles1.forEach(toggle => toggle.style.top = '49%');
                passwordToggles2.forEach(toggle => toggle.style.top = '37%');
            } else {
                passwordToggles1.forEach(toggle => toggle.style.top = '50%');
                passwordToggles2.forEach(toggle => toggle.style.top = '50%');
            }
        }
    
        function togglePassword(id) {
            var input = document.getElementById(id);
            var icon = document.getElementById(id + '-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }
    </script>
</body>
</html> --}}
