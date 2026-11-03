<!DOCTYPE html>
<html lang="en">
@php
 $title = Route::currentRouteName();
 $title = explode('.', $title);
 $title = ucwords($title[0]);
 $theme = App\Models\Theme::where('status', true)->first();
 $setting = App\Models\Setting::withoutGlobalScope('user_query_scope')
 ->select(['school_name', 'logo'])
 ->where('created_by', auth()->user()->id)
 ->first();
 $school = $setting['school_name'];
 $logo = $setting['logo'];
@endphp

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <meta name="csrf-token" content="{{ csrf_token() }}">
 <title>{{ $title }}</title>
 <link rel="shortcut icon" href="{{ $logo ? asset('storage/setting/' . $logo) : asset('img/logo-tutwuri.png') }}" type="image/x-icon">
 {{-- bootstrap --}}
 <link rel="stylesheet" href="{{ asset('assets/vendor/local_libs/bootstrap.min.css') }}">
 <link rel="stylesheet"
  href="{{ asset('assets/vendor/local_libs/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css') }}">

 {{-- style theme khususon section --}}
 @if (Route::is('section*'))
  {{-- @dd($theme) --}}
  <link rel="stylesheet" href="{{ asset('assets/themes/' . (isset($theme->id) ? $theme->id : 'default') . '.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style-section.css') }}">
 @endif

 <link rel="stylesheet" href="{{ asset('css/style.css') }}">

 {{-- DataTables CSS --}}
 <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.css') }}">

 {{-- Trix Editor --}}
 <link rel="stylesheet" href="{{ asset('assets/vendor/local_libs/trix.css') }}">

 {{-- Select 2 --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

 @yield('css')

 @if (file_exists(public_path('css/style-' . $title . '.css')))
  <link rel="stylesheet" href="{{ asset('css/style-' . $title . '.css') }}">
 @endif

</head>

<body class="bg-light">

 <div class="d-none position-fixed justify-content-center align-items-center h-100 w-100 z-index-1" id="loading">
  <div class="text-center shadow-sm bg-light rounded-5">
   <img class="img-fluid" src="{{ asset('/img/loading.gif') }}" alt="Loading...">
   <p class="d-block fs-5">
    <span class="text-black">
     Loading...
    </span>
   </p>
  </div>
 </div>

 <div class="container-fluid d-flex flex-column min-vh-100">
  <div class="row flex-grow-1">
   <div class="col-sendiri w-sidebar space-sidebar" id="idSidebar">
    {{-- Sidebar --}}
    @include('partials.sidebar')
    {{-- <div class="space-sidebar"></div> --}}
    <div class="div-tombol-silang shadow">
     <i class="bi-x-square fs-2 btn btn-light text-black-sendiri"></i>
    </div>
   </div>
   <div class="col d-flex flex-column w-content">
    {{-- Navbar --}}
    @include('partials.navbar')
    {{-- Content --}}
    <div class="row content flex-grow-1 mt-3">
     <div class="col-12">
      @yield('content')
     </div>
    </div>
    {{-- Footer --}}
    <div class="row">
     <div class="col-12 bg-secondary text-light text-center pb-1">
      Copyright @2024
     </div>
    </div>
   </div>
  </div>
 </div>
 <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>


 {{-- js bikin sendiri --}}
 <script src="{{ asset('js/script.js') }}"></script>
 <script src="{{ asset('js/sweetalert.js') }}"></script>
 {{-- js bootstrap --}}
 <script src="{{ asset('assets/vendor/local_libs/bootstrap.bundle.min.js') }}"></script>

 <!-- jQuery -->
 <script src="{{ asset('assets/vendor/local_libs/jquery-3.6.0.min.js') }}"></script>
 <script src="{{ asset('assets/vendor/local_libs/jquery.min.js') }}"></script>

 {{-- partial crud saya pindah ke atas karena kalau dibawah, saat klik delete pada tabel yang di pagination bukan 1 maka seperti tidak terpanggil ajaxnya, kalau yiel --}}
 @include('partials.crud-jquery')
 {{-- @yield('js') --}}

 <!-- DataTables JS -->
 <script src="{{ asset('js/jquery-3.7.1.js') }}"></script>
 <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('js/dataTables.js') }}"></script>
 <script src="{{ asset('js/dataTables.bootstrap5.js') }}"></script>

 <!-- Sweet Alert-->
 <script src="{{ asset('assets/vendor/local_libs/sweetalert2@11.js') }}"></script>
 {{-- Trix Editor --}}
 <script src="{{ asset('assets/vendor/local_libs/trix.umd.min.js') }}"></script>
 {{-- Chart JS --}}
 <script src="{{ asset('assets/vendor/local_libs/chart.js') }}"></script>
 {{-- PDF.JS JS --}}
 <script src="{{ asset('assets/vendor/local_libs/library-viewsfile/pdf.min.js') }}"></script>
 <script src="{{ asset('assets/vendor/local_libs/library-viewsfile/pdf.worker.min.js') }}"></script>
 {{-- Script Unduh JS --}}
 <script src="{{ asset('js/script-unduh.js') }}"></script>
 {{-- Select2 --}}
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

 <script>
  $(document).ready(function() {
    // Data table
   $('#myTable').DataTable({
    "columnDefs": [{
     "targets": [0], // Indeks kolom "no"
     "searchable": false // Menonaktifkan pencarian pada kolom ini
    }]
   });

   $('#tableSection').DataTable({
    "columnDefs": [{
     "targets": [0, 4], // Indeks kolom pertama dan kelima
     "searchable": false // Menonaktifkan pencarian pada kolom ini
    }]
   });
   
    // Select 2
   $('.select2').select2({
    theme: 'bootstrap-5'
   });
  });
 </script>

 @if (session('success'))
  <script>
   // Tampilkan SweetAlert untuk pesan sukses
   document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
     icon: 'success',
     title: 'Berhasil!',
     text: '{{ session('success') }}'
    });
   });
  </script>
 @endif

 @if (session('error'))
  <script>
   // Tampilkan SweetAlert untuk pesan error
   document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
     icon: 'error',
     title: 'Gagal!',
     text: '{{ session('error') }}'
    });
   });
  </script>
 @endif

 @if (session('login_success'))
  <script>
   // Tampilkan SweetAlert untuk pesan sukses
   document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
     icon: 'success',
     title: 'Login Berhasil!',
     text: '{{ session('login_success') }}',
     timer: 3000,
     timerProgressBar: true,
    });
   });
  </script>
 @endif

 @if (session('logout_success'))
  <script>
   // Tampilkan SweetAlert untuk pesan sukses
   document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
     icon: 'success',
     title: 'Logout Berhasil!',
     text: '{{ session('logout_success') }}'
    });
   });
  </script>
 @endif

 {{-- @include('partials.crud-jquery') --}}

 @yield('js')

 @if (file_exists(public_path('js/script-' . $title . '.js')))
  <script src="{{ asset('js/script-' . $title . '.js') }}"></script>
 @endif

</body>

</html>
