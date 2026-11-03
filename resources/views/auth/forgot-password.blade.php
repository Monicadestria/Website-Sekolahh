<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
        crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/forgot-password.css') }}">
    <title>sendemail</title>
    <style>
        .input-focused {
            border-color: blue !important;
        }

        .input-error {
            border-color: red !important;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-6 right-box justify-content-center align-items-center ">
                <div class="row align-items-center">
                    <div class="header-text text-center mb-4">
                        <h2>Lupa Kata Sandi?</h2>
                        <p>Ganti Kata Sandi Anda Sekarang!</p>
                    </div>

                    <form id="forgot-password-form" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-item input-group">
                            <input type="email" id="email" name="email" autocomplete="off" class="rounded-3 @error('email') input-error @enderror" value="{{ old('email') }}">
                            <label for="email">Email</label>
                            @error('email')
                            <div id="server-email-error" class="text-danger"><i class="fas fa-exclamation-circle"></i> Email tidak terdaftar</div>
                            @enderror
                            <div id="email-error" class="text-danger"></div>

                            @if (session('status'))
                            <div class="text">
                                {{ session('status') }}
                            </div>
                            @endif
                        </div>
                        <div class="input-group mb-3 justify-content-center">
                            <button class="btn btn-lg btn-primary w-40 fs-6" type="submit">Kirim Email</button>
                        </div>
                        <div class="d-flex align-items-center justify-content-center text-center">
                            <small class="d-flex align-items-center mt-2 mb-4">
                                <a href="/login" class="click-back text-decoration-none">
                                    <i class="fas fa-chevron-left mr-1"></i>
                                    <span class="ms-1">Kembali ke Halaman Masuk</span>
                                </a>
                            </small>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-center align-items-center flex-column left-box">
                <img src="{{ asset('img/gambar.jpeg') }}"
                    class="img-fluid img-sekolah rounded-4 justify-content-center align-items-center mb-3" />

            </div>
        </div>
    </div>
    <script>
        document.getElementById('forgot-password-form').addEventListener('submit', function (event) {
            event.preventDefault();
            let email = document.getElementById('email');
            let emailError = document.getElementById('email-error');
            let serverEmailError = document.getElementById('server-email-error');

            emailError.innerHTML = ''; // Clear any previous error messages
            email.classList.remove('input-error');
            if (serverEmailError) {
                serverEmailError.style.display = 'none'; // Hide server-side error message
            }

            if (email.value === '') {
                email.classList.add('input-error');
                emailError.innerHTML = '<i class="fas fa-exclamation-circle"></i> Email harus di isi'; // Add error message with icon
            } else {
                // If the form is valid, submit it
                this.submit();
            }
        });

        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function () {
                this.classList.remove('input-error');
                this.classList.add('input-focused');
                let emailError = document.getElementById('email-error');
                let serverEmailError = document.getElementById('server-email-error');
                if (emailError) {
                    emailError.innerHTML = ''; // Clear client-side error message
                }
                if (serverEmailError) {
                    serverEmailError.style.display = 'none'; // Hide server-side error message
                }
            });
            input.addEventListener('blur', function () {
                this.classList.remove('input-focused');
            });
        });
    </script>
    <script src="{{ asset('assets/vendor/local_libs/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/password.js') }}"></script>
</body>

</html>



{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
        crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/forgot-password.css') }}">
    <title>sendemail</title>
    <style>
        .input-focused {
            border-color: blue !important;
        }

        .input-error {
            border-color: red !important;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-6 right-box justify-content-center align-items-center ">
                <div class="row align-items-center">
                    <div class="header-text text-center mb-4">
                        <h2>Lupa Kata Sandi?</h2>
                        <p>Ganti Kata Sandi Anda Sekarang!</p>
                    </div>

                    <form id="forgot-password-form" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-item input-group">
                            <input type="email" id="email" name="email" autocomplete="off" class="rounded-3 @error('email') input-error @enderror" value="{{ old('email') }}">
                            <label for="email">Email</label>
                            @error('email')
                            <div id="server-email-error" class="text-danger"><i class="fas fa-exclamation-circle"></i> Email tidak terdaftar</div>
                            @enderror
                            <div id="email-error" class="text-danger"></div>

                            @if (session('status'))
                            <div class="text">
                                {{ session('status') }}
                            </div>
                            @endif
                        </div>
                        <div class="input-group mb-3 justify-content-center">
                            <button class="btn btn-lg btn-primary w-40 fs-6" type="submit">Kirim Email</button>
                        </div>
                        <div class="d-flex align-items-center justify-content-center text-center">
                            <small class="d-flex align-items-center mt-2 mb-4">
                                <a href="/login" class="click-back text-decoration-none">
                                    <i class="fas fa-chevron-left mr-1"></i>
                                    <span class="ms-1">Kembali ke Halaman Masuk</span>
                                </a>
                            </small>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-center align-items-center flex-column left-box">
                <img src="{{ asset('img/anak_register.jpg') }}"
                    class="img-fluid img-sekolah rounded-4 justify-content-center align-items-center mb-3" />

            </div>
        </div>
    </div>
    <script>
        document.getElementById('forgot-password-form').addEventListener('submit', function (event) {
            event.preventDefault();
            let email = document.getElementById('email');
            let emailError = document.getElementById('email-error');
            let serverEmailError = document.getElementById('server-email-error');

            emailError.innerHTML = ''; // Clear any previous error messages
            email.classList.remove('input-error');
            if (serverEmailError) {
                serverEmailError.style.display = 'none'; // Hide server-side error message
            }

            if (email.value === '') {
                email.classList.add('input-error');
                emailError.innerHTML = '<i class="fas fa-exclamation-circle"></i> Email harus di isi'; // Add error message with icon
            } else {
                // If the form is valid, submit it
                this.submit();
            }
        });

        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function () {
                this.classList.remove('input-error');
                this.classList.add('input-focused');
                let emailError = document.getElementById('email-error');
                let serverEmailError = document.getElementById('server-email-error');
                if (emailError) {
                    emailError.innerHTML = ''; // Clear client-side error message
                }
                if (serverEmailError) {
                    serverEmailError.style.display = 'none'; // Hide server-side error message
                }
            });
            input.addEventListener('blur', function () {
                this.classList.remove('input-focused');
            });
        });
    </script>
    <script src="{{ asset('assets/vendor/local_libs/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/password.js') }}"></script>
</body>

</html>

 --}}
