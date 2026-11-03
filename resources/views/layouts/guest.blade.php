<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/Login.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
    <title>Login</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-6 right-box justify-content-center align-items-center">
                <div class="row align-items-center">
                    @yield('content')
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-center align-items-center flex-column left-box">
                <img src="{{ asset('img/gambar.jpeg') }}" class="img-fluid img-sekolah rounded-4 justify-content-center align-items-center mb-2" />
                
            </div>
        </div>
    </div>
    <script src="{{ asset('js/login.js') }}"></script>
</body>
</html>
