<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Page Not Found</title>
    <link rel="stylesheet" href="{{ asset('css/style-error.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@100..700&display=swap" rel="stylesheet">

    </head>
<body>
    <div class="containers">
        <svg viewBox="550 -80 1200 400" width="1300" xmlns="http://www.w3.org/2000/svg">
            <!-- Sine Path 1 (Mulai dari tengah, satu gelombang atas dan satu gelombang bawah, berakhir di atas) -->
            <path class="sine-path" d="M 550 100 
                C 712.5 250, 887.5 230, 1050 100 
                S 1387.5 0, 1550 100
                C 1712.5 200, 1887.5 200, 1900 100"  
            />
                
            <!-- Sine Path 2 (Random variation, dekat dengan yang pertama) -->
            <path class="sine-path" d="M 550 110 
                C 722.5 270, 897.5 210, 1050 120 
                S 1377.5 10, 1550 90
                C 1722.5 190, 1897.5 210, 1900 110"  
            />
                
            <!-- Sine Path 3 (Random variation, dekat dengan yang pertama) -->
            <path class="sine-path" d="M 550 90 
                C 702.5 230, 877.5 250, 1050 80 
                S 1397.5 -10, 1550 110
                C 1702.5 220, 1887.5 180, 1900 90"  
            />
        </svg>
        

        <div class="left-column">
            <h1 class="title">Oops !...</h1>
            <p class="desc"> Halaman tidak ditemukan</p>
            <p class="desc-text">Mohon maaf, sepertinya halaman yang Anda cari tidak tersedia saat ini atau terdapat kesalahan dalam proses pengambilan halaman tersebut. Silakan coba lagi nanti atau periksa kembali URL yang Anda masukkan.</p>
        </div>
        <div class="right-column">
            <h1 data-texts="404">404</h1>
            <p>Halaman tidak ditemukan</p>
            <img src="{{ asset('img/404.png') }}" alt="Illustration">
        </div>
    </div>

    <script src="{{ asset('js/script-error.css') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
