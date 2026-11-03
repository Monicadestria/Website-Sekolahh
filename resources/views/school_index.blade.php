<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Home</title>
 {{-- tailwind --}}
 {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
 <script src="{{ asset('js/tailwind3.3.5.js') }}"></script>
 {{-- @vite('resources/css/app.css') --}}
 <!-- kalo pakai vite: ketik 'npm run dev' di terminal -->

 {{-- icon bootstrap --}}
 <link rel="stylesheet"
  href="{{ asset('assets/vendor/local_libs/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css') }}">

 {{-- swiper tim kami --}}
 {{-- <link rel="stylesheet" href="{{ asset('css/swiper.css') }}"> --}}

 {{-- font poppins --}}
 <link rel="stylesheet" href="{{ asset('css/googleapis-font-style-poppins.css') }}">
 {{-- aos animation --}}
 <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
 {{-- style sendiri --}}
 <link rel="stylesheet" href="{{ asset('css/style-school-index.css') }}">

</head>

<body class="flex flex-col min-h-screen">
 <!-- Navbar -->
 <nav id="navbar" class="text-gray-700 w-full px-2 py-2 fixed top-0 z-50 text-lg">
  <div class="mx-auto flex justify-between items-center py-2">
   <div class="flex items-center ms-3">
    <a href="/">
     <img id="logo" data-logo-src-putih="{{ asset('img/vetencode2.png') }}"
      data-logo-src-warna="{{ asset('img/vetencode.png') }}" src="{{ asset('img/vetencode2.png') }}" alt="Logo"
      class="h-auto w-32 mr-2 hover:scale-105">
    </a>
    {{-- <span class="font-bold text-lg">BrandName</span> --}}
   </div>
   <div class="me-5 text-white hidden md:flex justify-center" id="navbar-href">
    <a href="#beranda" class="transition-all duration-100 hover:text-gray-700 navbar-md-ke-atas navbar-href-stay px-3">
     <div class="max-w-none border-transparent border-t-2 border-gray-700 mx-auto mt-px px-3 h-auto">
     </div>
     <div class="w-full">
      Beranda
     </div>
     <div
      class="underline-navbar w-full rounded-full border-transparent border-b-2 border-gray-700 mx-auto mt-px px-3 h-auto">
     </div>
    </a>
    <a href="#fitur" class="transition-all duration-100 hover:text-gray-700 navbar-md-ke-atas navbar-href-stay px-3">
     <div class="max-w-none border-transparent border-t-2 border-gray-700 mx-auto mt-px px-3 h-auto">
     </div>
     <div class="w-full">
      Fitur
     </div>
     <div
      class="underline-navbar w-full rounded-full border-transparent border-b-2 border-gray-700 mx-auto mt-px px-3 h-auto">
     </div>
    </a>
    <a href="#detail" class="transition-all duration-100 hover:text-gray-700 navbar-md-ke-atas navbar-href-stay px-3">
     <div class="max-w-none border-transparent border-t-2 border-gray-700 mx-auto mt-px px-3 h-auto">
     </div>
     <div class="w-full">
      Detail
     </div>
     <div
      class="underline-navbar w-full rounded-full border-transparent border-b-2 border-gray-700 mx-auto mt-px px-3 h-auto">
     </div>
    </a>
    {{-- <a href="#tim" class="transition-all duration-100 hover:text-gray-700 navbar-md-ke-atas navbar-href-stay px-3">
     <div class="max-w-none border-transparent border-t-2 border-gray-700 mx-auto mt-px px-3 h-auto">
     </div>
     <div class="w-full">
      Tim
     </div>
     <div
      class="underline-navbar w-full rounded-full border-transparent border-b-2 border-gray-700 mx-auto mt-px px-3 h-auto">
     </div>
    </a> --}}
    <a href="{{ route('login') }}" class="transition-all duration-100 hover:text-gray-700 navbar-md-ke-atas">
     {{-- <span class="ps-3">Masuk</span> --}}
     <div class="underline-navbar w-max border-transparent border-y-2 border-gray-700 mx-auto mt-px ps-3 h-auto">Masuk
     </div>
    </a>
   </div>
   <div class="md:hidden ">
    <button id="menu-toggle" class="text-gray-700 hover:text-sky-500 focus:outline-none">
     <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
     </svg>
    </button>
   </div>
  </div>
  <div class="hidden md:hidden" id="mobile-menu">
   <a href="#beranda"
    class="block max-w-min px-4 py-2 text-sm text-gray-700 hover:text-sky-500 ml-auto navbar-md-ke-atas navbar-href-stay-2">
    Beranda
    <div class="underline-navbar w-full rounded-full border-transparent border-b-2 border-gray-700 mt-px h-auto">
    </div>
   </a>
   <a href="#fitur"
    class="block max-w-min px-4 py-2 text-sm text-gray-700 hover:text-sky-500 ml-auto navbar-md-ke-atas navbar-href-stay-2">
    Fitur
    <div class="underline-navbar w-full rounded-full border-transparent border-b-2 border-gray-700 mt-px h-auto">
    </div>
   </a>
   <a href="#detail"
    class="block max-w-min px-4 py-2 text-sm text-gray-700 hover:text-sky-500 ml-auto navbar-md-ke-atas navbar-href-stay-2">
    Detail
    <div class="underline-navbar w-full rounded-full border-transparent border-b-2 border-gray-700 mt-px h-auto">
    </div>
   </a>
   {{-- <a href="#tim"
    class="block max-w-min px-4 py-2 text-sm text-gray-700 hover:text-sky-500 ml-auto navbar-md-ke-atas navbar-href-stay-2">
    Tim
    <div class="underline-navbar w-full rounded-full border-transparent border-b-2 border-gray-700 mt-px h-auto">
    </div>
   </a> --}}
   <a href="{{ route('login') }}"
    class="block max-w-min px-4 py-2 text-sm text-gray-700 hover:text-sky-500 ml-auto">Masuk</a>
  </div>
 </nav>


 {{-- controller
 
 return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses data.'); --}}
 {{-- return redirect()->route('landing_page')->with('warning', 'Website sekolah dinonaktifkan.'); --}}

 {{-- untuk memasukan session dalam view di controller --}}
 {{-- session()->flash('success', 'Data berhasil disimpan.'); --}}

 {{-- ALERT --}}
 @if (session('success'))
  <div
   class="alert alert-success fixed top-16 right-1 md:right-5 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded"
   role="alert">
   <strong class="font-bold">Berhasil!</strong>
   <span class="block sm:inline pe-0 sm:pe-6">{{ session('success') }}</span>
   <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
    <svg onclick="this.parentElement.parentElement.style.display='none'" class="fill-current h-6 w-6 text-green-500"
     role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
     <title>Close</title>
     <path
      d="M14.348 5.652a1 1 0 010 1.414L11.414 10l2.934 2.934a1 1 0 01-1.414 1.414L10 11.414l-2.934 2.934a1 1 0 01-1.414-1.414L8.586 10 5.652 7.066a1 1 0 011.414-1.414L10 8.586l2.934-2.934a1 1 0 011.414 0z" />
    </svg>
   </span>
  </div>
 @endif

 <!-- Warning Alert -->
 @if (session('warning'))
  <div
   class="alert alert-warning fixed top-16 right-1 md:right-5 bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded break-words"
   role="alert">
   <strong class="font-bold">Peringatan!</strong>
   <span class="block sm:inline pe-0 sm:pe-6">{{ session('warning') }}</span>
   <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
    <svg onclick="this.parentElement.parentElement.style.display='none'" class="fill-current h-6 w-6 text-yellow-500"
     role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
     <title>Close</title>
     <path
      d="M14.348 5.652a1 1 0 010 1.414L11.414 10l2.934 2.934a1 1 0 01-1.414 1.414L10 11.414l-2.934 2.934a1 1 0 01-1.414-1.414L8.586 10 5.652 7.066a1 1 0 011.414-1.414L10 8.586l2.934-2.934a1 1 0 011.414 0z" />
    </svg>
   </span>
  </div>
 @endif

 <!-- Error Alert -->
 @if (session('error'))
  <div
   class="alert alert-error fixed top-16 right-1 md:right-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded"
   role="alert">
   <strong class="font-bold">Gagal!</strong>
   <span class="block sm:inline pe-0 sm:pe-6">{{ session('error') }}</span>
   <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
    <svg onclick="this.parentElement.parentElement.style.display='none'" class="fill-current h-6 w-6 text-red-500"
     role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
     <title>Close</title>
     <path
      d="M14.348 5.652a1 1 0 010 1.414L11.414 10l2.934 2.934a1 1 0 01-1.414 1.414L10 11.414l-2.934 2.934a1 1 0 01-1.414-1.414L8.586 10 5.652 7.066a1 1 0 011.414-1.414L10 8.586l2.934-2.934a1 1 0 011.414 0z" />
    </svg>
   </span>
  </div>
 @endif

 <!-- Content -->
 <div id="beranda" class="bg-gradient-to-b from-sky-400 to-slate-200">
  <div
   class="container mx-auto flex-grow pt-24 lg:pt-16 xl:pt-10 2xl:pt-0 pb-3 px-7 md:px-1 flex-col md:flex-row-reverse flex items-center justify-center md:justify-end"
   id="content-top">

   <div class="keterangan md:w-1/2 text-center md:text-left md:pe-5 mb-10 md:mb-0">
    <div class="" data-aos="fade-up" data-aos-offset="0" data-aos-delay="50" data-aos-duration="700"
     data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-anchor-placement="top-center">
     <h1
      class="max-w-5xl mb-7 md:mb-4 text-5xl font-extrabold tracking-tight md:text-5xl lg:text-6xl xl:text-7xl text-slate-800 leading-snug">
      Bangun Website Sekolah Anda di Sini</h1>
     <p class="mb-11 md:mb-7 text-slate-800 text-xl leading-loose md:leading-normal">
      Mau Buat Website Sekolah GRATIS Yang Bisa Kustom Tanpa Pusing?
      <b>Daftarkan Sekolah Anda Sekarang!</b>
     </p>
     <a href="{{ route('register') }}"
      class="bg-sky-500 border border-sky-500 text-white px-10 py-3 rounded-full font-medium transition-all duration-300 hover:bg-white hover:text-sky-500 hover:border hover:border-sky-500 text-lg glow-animation">
      Daftarkan Sekolah
     </a>
    </div>
   </div>
   <div class="gambar md:w-1/2 flex px-7" data-aos="fade-up" data-aos-offset="0" data-aos-delay="50"
    data-aos-duration="700" data-aos-easing="ease-in-out" data-aos-mirror="true"
    data-aos-anchor-placement="top-center">
    <img src="{{ asset('svg/1.svg') }}" alt="Logo" class="h-auto w-27-rem mx-auto svg-shadow-white">
   </div>
  </div>

 </div>

 <!-- Section Divider -->

 <div id="fitur" class="">
  <div class="divider bg-slate-200">
   <svg class="fill-current text-sky-300" viewBox="30 -1 50 100" preserveAspectRatio="none">
    <polygon points="0,100 100,100 100,75" />
   </svg>
  </div>
  <section class="bg-sky-300 -mt-24 pb-8">
   <div class="container mx-auto px-4">
    <div class="flex flex-wrap">
     {{-- card 1 --}}
     <div class="lg:pt-12 pt-6 w-full md:w-4/12 px-4 text-center order-2 md:order-1 relative" data-aos="fade-up"
      data-aos-offset="0" data-aos-delay="500" data-aos-duration="700" data-aos-easing="ease-in-out"
      data-aos-mirror="true" data-aos-anchor-placement="top-center">
      <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg ">
       <div class="px-4 py-5 flex-auto">
        <div
         class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-sky-400">
         <i class="bi bi-star-fill text-xl"></i>
        </div>
        <h6 class="text-xl font-semibold text-gray-800">Bebas Iklan</h6>
        <p class="mt-2 mb-4 text-gray-700 ">
         Tidak terdapat iklan yang mengganggu tampilan website
        </p>
       </div>
      </div>
     </div>
     {{-- card 2 --}}
     <div class="w-full md:w-4/12 px-4 text-center order-1 md:order-2" data-aos="fade-up" data-aos-offset="0"
      data-aos-delay="50" data-aos-duration="700" data-aos-easing="ease-in-out" data-aos-mirror="true"
      data-aos-anchor-placement="top-center">
      <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg ">
       <div class="px-4 py-5 flex-auto">
        <div
         class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-green-500">
         <i class="bi bi-emoji-laughing-fill text-2xl"></i>
        </div>
        <h6 class="text-xl font-semibold text-gray-800">Informasi Sekolah</h6>
        <p class="mt-2 mb-4 text-gray-700 ">
         Kelola dan tampilkan informasi sekolah di website dengan mudah
        </p>
       </div>
      </div>
     </div>
     {{-- card 3 --}}
     <div class="pt-6 w-full md:w-4/12 px-4 text-center order-3" data-aos="fade-up" data-aos-offset="0"
      data-aos-delay="250" data-aos-duration="700" data-aos-easing="ease-in-out" data-aos-mirror="true"
      data-aos-anchor-placement="top-center">
      <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg ">
       <div class="px-4 py-5 flex-auto">
        <div
         class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-yellow-300">
         <i class="bi bi-lightbulb-fill text-xl"></i>
        </div>
        <h6 class="text-xl font-semibold text-gray-800">Kreasi Sendiri</h6>
        <p class="mt-2 mb-4 text-gray-700 ">
         Ubah warna tema dan tampilan beranda sekolah Anda sesuka hati
        </p>
       </div>
      </div>
     </div>

    </div>
   </div>
  </section>
 </div>


 <div id="detail" class="">
  <div class="bg-sky-300 pt-6">
   <div class="container mx-auto px-4 pb-16">
    <div class="flex flex-wrap items-center mt-16 md:mt32 text-center md:text-left">
     <div class="w-full md:w-5/12 px-4 mr-auto ml-auto" data-aos="fade-up" data-aos-offset="0" data-aos-delay="50"
      data-aos-duration="700" data-aos-easing="ease-in-out" data-aos-mirror="true"
      data-aos-anchor-placement="top-center">
      <div
       class="text-gray-600 p-3 text-center inline-flex items-center justify-center w-16 h-16 mb-6 shadow-lg rounded-full bg-gray-100">
       <i class="bi bi-buildings-fill text-3xl"></i>
      </div>
      <h3 class="text-3xl mb-2 font-semibold leading-normal text-gray-800">
       Kustomisasi Website Sekolah Anda
      </h3>
      <p class="text-lg leading-relaxed my-4 text-gray-700">
       Sesuaikan kehadiran online sekolah Anda dengan beberapa klik saja. Anda dapat menyesuaikan teks, gambar, warna
       dan masih banyak lagi untuk mencerminkan
       identitas unik sekolah Anda. Mulai dengan cepat dari template yang kami sediakan, dan buatlah menjadi milik
       Anda sepenuhnya.
      </p>

      <p class="font-bold text-gray-800 mt-3 mb-7">Kembangkan Imajinasi Anda</p>
     </div>
     <div class="w-full md:w-4/12 px-4 mr-auto ml-auto" data-aos="fade-up" data-aos-offset="0" data-aos-delay="50"
      data-aos-duration="700" data-aos-easing="ease-in-out" data-aos-mirror="true"
      data-aos-anchor-placement="top-center">
      <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-sky-600">
       <img alt="..." src="{{ asset('img/hero-2.jpg') }}" class="w-full align-middle rounded-t-lg">
       <blockquote class="relative p-8 mb-4">
        <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 583 95"
         class="absolute left-0 w-full block h-24 -top-24">
         <polygon points="-30,95 583,95 583,65" class="text-sky-600 fill-current"></polygon>
        </svg>
        <h4 class="text-xl font-bold text-white">
         Pelajar Sekolah
        </h4>
        <p class="text-md mt-2 text-white">
         Pelajar sekarang cenderung lebih menyukai website sekolah yang interaktif dan fresh serta berita terkini yang
         ada di sekolahnya. Anda dapat memasukan berita di dalam websitenya.
        </p>
       </blockquote>
      </div>
     </div>
    </div>
   </div>
   {{-- template ombak --}}
   <div class="relative -mt-12 lg:-mt-24">
    <svg viewBox="0 0 1428 174" version="1.1" xmlns="http://www.w3.org/2000/svg"
     xmlns:xlink="http://www.w3.org/1999/xlink">
     <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
      <g transform="translate(-2.000000, 44.000000)" fill="#FFFFFF" fill-rule="nonzero">
       <path
        d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496"
        opacity="0.100000001"></path>
       <path
        d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z"
        opacity="0.100000001"></path>
       <path
        d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z"
        id="Path-4" opacity="0.200000003"></path>
      </g>
      <g transform="translate(-4.000000, 76.000000)" fill="#FFFFFF" fill-rule="nonzero">
       <path
        d="M0.457,34.035 C57.086,53.198 98.208,65.809 123.822,71.865 C181.454,85.495 234.295,90.29 272.033,93.459 C311.355,96.759 396.635,95.801 461.025,91.663 C486.76,90.01 518.727,86.372 556.926,80.752 C595.747,74.596 622.372,70.008 636.799,66.991 C663.913,61.324 712.501,49.503 727.605,46.128 C780.47,34.317 818.839,22.532 856.324,15.904 C922.689,4.169 955.676,2.522 1011.185,0.432 C1060.705,1.477 1097.39,3.129 1121.236,5.387 C1161.703,9.219 1208.621,17.821 1235.4,22.304 C1285.855,30.748 1354.351,47.432 1440.886,72.354 L1441.191,104.352 L1.121,104.031 L0.457,34.035 Z">
       </path>
      </g>
     </g>
    </svg>
   </div>
  </div>
  <div class="relative my-10">
   <div class="">
    <div class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20"
     style="height: 80px;">
     <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"
      version="1.1" viewBox="0 0 2560 100" x="0" y="0">
      <polygon class="text-white fill-current" points="2560 0 2560 100 0 100"></polygon>
     </svg>
    </div>
    <div class="container mx-auto px-4">
     <div class="items-center flex flex-wrap">
      <div class="w-full md:w-4/12 mx-auto px-6 sm:px-4 md:px-2 lg:px-4 xl:px-8" data-aos="fade-up"
       data-aos-offset="0" data-aos-delay="50" data-aos-duration="700" data-aos-easing="ease-in-out"
       data-aos-mirror="true" data-aos-anchor-placement="top-center">
       <img src="{{ asset('svg/7.svg') }}" alt="Logo" class="h-auto w-27-rem svg-shadow-sky"
        class="gambar-anak-baca-buku">
      </div>
      <div class="w-full md:w-5/12 mx-auto" data-aos="fade-up" data-aos-offset="0" data-aos-delay="50"
       data-aos-duration="700" data-aos-easing="ease-in-out" data-aos-mirror="true"
       data-aos-anchor-placement="top-center">
       <div class="text-center md:text-left">
        <div
         class="text-slate-200 p-3 text-center inline-flex items-center justify-center w-16 h-16 mb-6 shadow-lg rounded-full bg-sky-300">
         <i class="bi bi-ui-checks text-3xl"></i>
        </div>
        <h3 class="text-3xl font-semibold text-gray-800">Kelola Informasi Dengan Fleksibel</h3>
        <p class="mt-4 text-lg leading-relaxed text-gray-600">
         Selain mengatur tampilan, Anda juga dapat mengelola informasi sekolah yang sudah kami sediakan menunya,
         terdapat
         menu staf, berita, unduh dan masih banyak lagi.
         Kelola informasi sekolah Anda sebaik mungkin dan tampilkan di halaman website Anda sekarang.
        </p>
        <p class="my-3 text-gray-500 text-sm font-extrabold">Tampilan yang baik meningkatkan jumlah penonton
        </p>

       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>

 {{-- jika pakai tim kami ga perlu ada gradien di bawah ini juga pakai py-1 bukan py-7 --}}
 <div class="py-7 bg-gradient-to-b from-white to-slate-200" class="w-full"></div>

 {{-- <div id="tim" class="pb-0 pt-12 bg-gradient-to-b from-white to-slate-200">

  <div class="slider-1 pt-16 bg-gray justify-center text-gray-700" data-aos="fade-up" data-aos-offset="0"
   data-aos-delay="50" data-aos-duration="700" data-aos-easing="ease-in-out" data-aos-mirror="true"
   data-aos-anchor-placement="top-center">
   <div class="container px-4 sm:px-8 mx-auto">
    <h2 class="mb-20 text-center lg:max-w-xl lg:mx-auto text-4xl md:text-5xl ">Tim Kami</h2>

    <!-- Card Slider -->
    <div class="slider-container">
     <div class="swiper-container card-slider">
      <div class="swiper-wrapper">

       <!-- Slide Umam -->
       <div class="swiper-slide">
        <div class="card">
         <img class="card-image object-cover shadow-lg" src="{{ asset('img/foto-umam.jpeg') }}" alt="alternative" />
         <div class="card-body py-3">
          <p class="font-semibold text-lg">Ahmad Khoirul Umam</p>
          <p class="font-light italic text-base">Fullstack Dev</p>
          <div class="mt-6 flex justify-center w-min mx-auto">
           <a href="https://www.linkedin.com/in/ahmad-khoirul-umam-16900627a/" target="_blank"
            class="bg-white shadow-inner hover:shadow-lg text-sky-600 hover:text-white hover:bg-sky-600 rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-linkedin"></i>
           </a>
           <a href="https://www.instagram.com/ryuriko_/" target="_blank"
            class="bg-white hover:bg-gradient-to-r hover:from-pink-500 hover:to-rose-500 shadow-inner hover:shadow-lg text-rose-600 hover:text-white rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-instagram"></i>
           </a>
           <a href="mailto:a.khoirul.umam032@gmail.com" target="_blank"
            class="bg-white shadow-inner hover:shadow-lg text-red-500 hover:text-white hover:bg-red-500 rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-google"></i>
           </a>
          </div>
         </div>
        </div>
       </div>

       <!-- Slide Ali-->
       <div class="swiper-slide">
        <div class="card">
         <img class="card-image object-cover shadow-lg" src="{{ asset('img/foto-ali.jpeg') }}" alt="alternative" />
         <div class="card-body py-3">
          <p class="font-semibold text-lg">Muhammad Ferdynan Ali S</p>
          <p class="font-light italic text-base">Fullstack Dev</p>
          <div class="mt-6 flex justify-center w-min mx-auto">
           <a href="https://github.com/AlyDap/" target="_blank"
            class="bg-white shadow-inner hover:shadow-lg text-gray-700 hover:text-white hover:bg-slate-700 rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-github"></i>
           </a>
           <a href="https://www.youtube.com/channel/UCLiWPTAubbFjUfbR5AUx7Sw" target="_blank"
            class="bg-white shadow-inner hover:shadow-lg text-red-500 hover:text-white hover:bg-red-500 rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-youtube"></i>
           </a>
           <a href="https://www.instagram.com/aly_dap/" target="_blank"
            class="bg-white hover:bg-gradient-to-r hover:from-pink-500 hover:to-rose-500 shadow-inner hover:shadow-lg text-rose-600 hover:text-white rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-instagram"></i>
           </a>
          </div>
         </div>
        </div>
       </div>

       <!-- Slide Rohman-->
       <div class="swiper-slide">
        <div class="card">
         <img class="card-image object-cover shadow-lg" src="{{ asset('img/foto-rohman.jpeg') }}"
          alt="alternative" />
         <div class="card-body py-3">
          <p class="font-semibold text-lg">Abdur Rohman</p>
          <p class="font-light italic text-base">Fullstack Dev</p>
          <div class="mt-6 flex justify-center w-min mx-auto">
           <a href="https://github.com/abdurrohman14" target="_blank"
            class="bg-white shadow-inner hover:shadow-lg text-gray-700 hover:text-white hover:bg-slate-700 rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-github"></i>
           </a>
           <a href="https://www.linkedin.com/in/abdur-rohman-4a00942a2/" target="_blank"
            class="bg-white shadow-inner hover:shadow-lg text-sky-600 hover:text-white hover:bg-sky-600 rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-linkedin"></i>
           </a>
           <a href="https://www.instagram.com/who.ami500/" target="_blank"
            class="bg-white hover:bg-gradient-to-r hover:from-pink-500 hover:to-rose-500 shadow-inner hover:shadow-lg text-rose-600 hover:text-white rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-instagram"></i>
           </a>
          </div>
         </div>
        </div>
       </div>

       <!-- Slide Fadhil -->
       <div class="swiper-slide">
        <div class="card">
         <img class="card-image object-cover shadow-lg" src="{{ asset('img/foto-fadil.jpg') }}" alt="alternative" />
         <div class="card-body py-3">
          <p class="font-semibold text-lg">Muhammad Fadilah</p>
          <p class="font-light italic text-base">Fullstack Web Dev</p>
          <div class="mt-6 flex justify-center w-min mx-auto">
           <a href="https://github.com/mhmdfadil/" target="_blank"
            class="bg-white shadow-inner hover:shadow-lg text-gray-700 hover:text-white hover:bg-slate-700 rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-github"></i>
           </a>
           <a href="https://www.instagram.com/muhammadfadilah034/" target="_blank"
            class="bg-white hover:bg-gradient-to-r hover:from-pink-500 hover:to-rose-500 shadow-inner hover:shadow-lg text-rose-600 hover:text-white rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-instagram"></i>
           </a>
           <a href="mailto:muhammad.210170034@mhs.unimal.ac.id" target="_blank"
            class="bg-white shadow-inner hover:shadow-lg text-red-500 hover:text-white hover:bg-red-500 rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-google"></i>
           </a>
          </div>
         </div>
        </div>
       </div>

       <!-- Slide Calvin -->
       <div class="swiper-slide">
        <div class="card">
         <img class="card-image object-cover shadow-lg" src="{{ asset('img/foto-calvin.jpg') }}"
          alt="alternative" />
         <div class="card-body py-3">
          <p class="font-semibold text-lg">Chalvin Febrian</p>
          <p class="font-light italic text-base">Backend Dev</p>
          <div class="mt-6 flex justify-center w-min mx-auto">
           <a href="https://github.com/ChalvinF06" target="_blank"
            class="bg-white shadow-inner hover:shadow-lg text-gray-700 hover:text-white hover:bg-slate-700 rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-github"></i>
           </a>
           <a href="https://www.linkedin.com/in/chalvin-febrian-935493288/" target="_blank"
            class="bg-white shadow-inner hover:shadow-lg text-sky-600 hover:text-white hover:bg-sky-600 rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-linkedin"></i>
           </a>
           <a href="https://www.instagram.com/chalvin03/" target="_blank"
            class="bg-white hover:bg-gradient-to-r hover:from-pink-500 hover:to-rose-500 shadow-inner hover:shadow-lg text-rose-600 hover:text-white rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-instagram"></i>
           </a>
          </div>
         </div>
        </div>
       </div>

       <!-- Slide Natan -->
       <div class="swiper-slide">
        <div class="card">
         <img class="card-image object-cover shadow-lg" src="{{ asset('img/foto-nathan.jpeg') }}"
          alt="alternative" />
         <div class="card-body py-3">
          <p class="font-semibold text-lg">Nathania Putri</p>
          <p class="font-light italic text-base">Backend Dev</p>
          <div class="mt-6 flex justify-center w-min mx-auto">
           <a href="https://www.instagram.com/nathaniaputri07/" target="_blank"
            class="bg-white hover:bg-gradient-to-r hover:from-pink-500 hover:to-rose-500 shadow-inner hover:shadow-lg text-rose-600 hover:text-white rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-instagram"></i>
           </a>
          </div>
         </div>
        </div>
       </div>

       <!-- Slide Monica -->
       <div class="swiper-slide">
        <div class="card">
         <img class="card-image object-cover shadow-lg" src="{{ asset('img/foto-monica.jpeg') }}"
          alt="alternative" />
         <div class="card-body py-3">
          <p class="font-semibold text-lg">Monica Destria Fajriana</p>
          <p class="font-light italic text-base">Frontend Dev</p>
          <div class="mt-6 flex justify-center w-min mx-auto">
           <a href="https://www.linkedin.com/in/monica-destria-fajriana-72b0a82a5/" target="_blank"
            class="bg-white shadow-inner hover:shadow-lg text-sky-600 hover:text-white hover:bg-sky-600 rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-linkedin"></i>
           </a>
           <a href="https://www.instagram.com/monicadef_/" target="_blank"
            class="bg-white hover:bg-gradient-to-r hover:from-pink-500 hover:to-rose-500 shadow-inner hover:shadow-lg text-rose-600 hover:text-white rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-instagram"></i>
           </a>
           <a href="mailto:monicadestria1@gmail.com" target="_blank"
            class="bg-white shadow-inner hover:shadow-lg text-red-500 hover:text-white hover:bg-red-500 rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-google"></i>
           </a>
          </div>
         </div>
        </div>
       </div>

       <!-- Slide Dea -->
       <div class="swiper-slide">
        <div class="card">
         <img class="card-image object-cover shadow-lg" src="{{ asset('img/foto-dea.jpeg') }}" alt="alternative" />
         <div class="card-body py-3">
          <p class="font-semibold text-lg">Ainun Dea Rahayu</p>
          <p class="font-light italic text-base">Frontend Dev</p>
          <div class="mt-6 flex justify-center w-min mx-auto">
           <a href="https://github.com/ainundea" target="_blank"
            class="bg-white shadow-inner hover:shadow-lg text-gray-700 hover:text-white hover:bg-slate-700 rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-github"></i>
           </a>
           <a href="https://www.instagram.com/ainundeaa/" target="_blank"
            class="bg-white hover:bg-gradient-to-r hover:from-pink-500 hover:to-rose-500 shadow-inner hover:shadow-lg text-rose-600 hover:text-white rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-instagram"></i>
           </a>
           <a href="mailto:ainundea29@gmail.com" target="_blank"
            class="bg-white shadow-inner hover:shadow-lg text-red-500 hover:text-white hover:bg-red-500 rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-google"></i>
           </a>
          </div>
         </div>
        </div>
       </div>

       <!-- Contoh Slide -->
       <!-- <div class="swiper-slide">
        <div class="card">
         <img class="card-image object-cover shadow-lg" src="{{ asset('img/anak.png') }}" alt="alternative" />
         <div class="card-body py-3">
          <p class="font-semibold text-lg">Nama Lengkap</p>
          <p class="font-light italic text-base">Posisi</p>
          <div class="mt-6 flex justify-center w-min mx-auto">
           <a href="#" target="_blank"
            class="bg-white shadow-inner hover:shadow-lg text-gray-700 hover:text-white hover:bg-slate-700 rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-github"></i>
           </a>
           <a href="#" target="_blank"
            class="bg-white shadow-inner hover:shadow-lg text-red-500 hover:text-white hover:bg-red-500 rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-youtube"></i>
           </a>
           <a href="#" target="_blank"
            class="bg-white shadow-inner hover:shadow-lg text-blue-600 hover:text-white hover:bg-blue-600 rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-facebook"></i>
           </a>
           <a href="#" target="_blank"
            class="bg-white shadow-inner hover:shadow-lg text-sky-600 hover:text-white hover:bg-sky-600 rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-linkedin"></i>
           </a>
           <a href="#" target="_blank"
            class="bg-white hover:bg-gradient-to-r hover:from-pink-500 hover:to-rose-500 shadow-inner hover:shadow-lg text-rose-600 hover:text-white rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-instagram"></i>
           </a>
          </div>

          <div class="mt-0 flex justify-center w-min mx-auto">
           <a href="#" target="_blank"
            class="bg-white shadow-inner hover:shadow-lg text-gray-800 hover:text-white hover:bg-slate-800 rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-tiktok"></i>
           </a>
           <a href="#" target="_blank"
            class="bg-white shadow-inner hover:shadow-lg text-gray-900 hover:text-white hover:bg-slate-900 rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-twitter-x"></i>
           </a>
           <a href="#" target="_blank"
            class="bg-white shadow-inner hover:shadow-lg text-sky-400 hover:text-white hover:bg-sky-400 rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-twitter"></i>
           </a>
           <a href="#" target="_blank"
            class="bg-white shadow-inner hover:shadow-lg text-green-500 hover:text-white hover:bg-green-500 rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-whatsapp"></i>
           </a>
           <a href="#" target="_blank"
            class="bg-white shadow-inner hover:shadow-lg text-red-500 hover:text-white hover:bg-red-500 rounded-full outline-none focus:outline-none m-1 text-2xl w-10 h-10 flex items-center justify-center">
            <i class="bi bi-google"></i>
           </a>
          </div>
         </div>
        </div>
       </div> -->

      </div>
      <!-- end of swiper-wrapper -->

      <!-- Add Arrows -->
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <!-- end of add arrows -->

     </div> <!-- end of swiper-container -->
    </div> <!-- end of slider-container -->
    <!-- end of card slider -->

   </div> <!-- end of container -->
  </div>

 </div> --}}

 <!-- Footer -->
 <footer class="bg-gradient-to-b from-slate-200 to-sky-400 pt-32 text-gray-700">
  <div class="container mx-auto">
   <div class="flex flex-wrap px-3 md:px-5">
    <div class="w-full py-7 md:py-12 md:w-5/12 px-4 text-center md:text-left order-2 md:order-1 relative">
     <div class="text-lg mb-3">PT.VETENCODE PRADANI ABADI</div>
     <div class="text-sm tracking-wide leading-relaxed">VETENCODE adalah perusahaan yang bergerak dibidang perdagangan
      dan jasa, yang dirintis sejak
      tahun 2019 berkedudukan di Kota Cianjur Jawa Barat. Berawal dari ketertarikan terhadap bidang teknologi informasi
      dan peternakan terutama hewan peliharaan.</div>
    </div>
    <div class="w-full py-7 md:py-12 md:w-3/12 text-center order-3 md:order-3">
     <div class="text-lg mb-3">MEDIA SOSIAL</div>
     <div class="flex justify-center w-full md:mx-0">
      <a href="https://www.instagram.com/vetencode_/?utm_source=ig_web_button_share_sheet&igshid=OGQ5ZDc2ODk2ZA%3D%3D"
       target="_blank"
       class="bg-gradient-to-r from-pink-500 to-rose-500 hover:bg-gradient-to-r hover:from-white hover:to-white shadow-lg text-white hover:text-rose-600  rounded-full outline-none focus:outline-none m-1 text-2xl w-11 h-11 flex items-center justify-center">
       <i class="bi bi-instagram"></i>
      </a>
      <a href="https://wa.me/6282118354994" target="_blank"
       class="bg-green-500 hover:bg-white shadow-lg hover:text-green-500 text-white rounded-full outline-none focus:outline-none m-1 text-2xl w-11 h-11 flex items-center justify-center">
       <i class="bi bi-whatsapp"></i>
      </a>
      <a href="https://www.facebook.com/people/Vetencode/100071363904803/" target="_blank"
       class="hover:bg-white shadow-lg hover:text-blue-600 text-white bg-blue-600 rounded-full outline-none focus:outline-none m-1 text-2xl w-11 h-11 flex items-center justify-center">
       <i class="bi bi-facebook"></i>
      </a>
     </div>
    </div>
    <div class="w-full py-7 md:py-12 md:w-4/12 px-4 text-center md:text-left order-2 md:order-2">
     <div class="text-lg">HUBUNGI KAMI</div>
     <div class="text-sm tracking-wide leading-relaxed my-3">Jalan Arwinda, Gadung Permai, Blk. E No.61, Bojong,
      Karangtengah, Kabupaten Cianjur, Jawa
      Barat 43281</div>
     <div class="text-light">
      <a href="mailto:info@vetencode.com?subject=Saya%20ingin%20bertanya%20mengenai%20layanan%20Vetencode"
       class="text-gray-700 underline hover:text-gray-600">
       info@vetencode.com
      </a>
     </div>
    </div>
   </div>
  </div>
  {{-- bagian akhir bawah sendiri --}}
  {{-- <div class="px-3">
   <hr class="border-gray-700">
  </div> --}}
  <div class="container py-3 mx-auto text-center text-gray-700 text-sm">
   Copyright &copy; 2024 All Right Reserved By PT Vetencode Pradani Abadi
  </div>
 </footer>

 {{-- 2 script jquery --}}
 <script src="{{ asset('assets/vendor/local_libs/jquery-3.6.0.min.js') }}"></script>
 <script src="{{ asset('assets/vendor/local_libs/jquery.min.js') }}"></script>

 {{-- swiper - Tim Kami --}}
 {{-- <script src="{{ asset('js/swiper.min.js') }}"></script> --}}


 {{-- script aos --}}
 <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

 <script>
  AOS.init();
 </script>

 {{-- script sendiri --}}
 <script src="{{ asset('js/script-school-index.js') }}"></script>

</body>

</html>
