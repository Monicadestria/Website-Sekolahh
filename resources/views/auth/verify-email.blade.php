<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/verify.css') }}">
</head>
<body>
    <div class="container">
        <div class="top-column">
            <h2 class="text-title">Silakan Verifikasi...</h2>
        </div>
        <div class="bottom-column">
            <h3 class="text-desc">Terima kasih telah mendaftar.</h3>
            <img src="{{ asset('img/img-email.png') }}" class="justify-content-center img-vektor" width="184">
            <p class="mxs">
                {{ __('Silakan periksa email Anda dan lakukan verifikasi. Jika email verifikasi belum ada, harap kirim ulang permintaan verifikasi.') }}
            </p>

            @if (session('status') == 'verification-link-sent')
                <p class="mxs" style="color: green;">
                    {{ __('Tautan verifikasi baru telah dikirim ke alamat email') }}
                </p>
            @endif

            <div>
                <form method="POST" action="{{ route('verification.send') }}" style="display: inline;">
                    @csrf
                    <input type="submit" name="confirm" class="btns btns-warning mrs mts" value="Kirim Ulang">
                </form>
                <form method="GET" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btns btns-danger mts">{{ __('Batal') }}</button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/vendor/local_libs/sweetalert2@11.js') }}"></script>
    @if (session('register_success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Register Berhasil!',
                    text: '{{ session('register_success') }}'
                });
            });
        </script>
    @endif
</body>

</html>
