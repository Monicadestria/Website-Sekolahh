@php
 $logo = App\Models\Setting::where('created_by', auth()->user()->id)
     ->pluck('logo')
     ->first();
@endphp
{{-- navbar --}}
<nav class="navbar navbar-expand-lg bg-body-primary theme-color-primary" id="navbar-modal">
 <div class="container-fluid">
  <div class="col-2 p-0 m-0">
   <img src="{{ $logo ? asset('storage/setting/' . $logo) : asset('img/logo-tutwuri.png') }}" class="logo"
    alt="Logo Sekolah">
  </div>

  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
   aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
   <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
   <div class="navbar-nav ms-auto">
    <a class="nav-link active link text-light font-color-body" aria-current="page" href="#">Beranda</a>
    <a class="nav-link link text-light font-color-body" href="#">Staf</a>
    <a class="nav-link link text-light font-color-body" href="#">Berita</a>
    <a class="nav-link link text-light font-color-body" href="#">Galeri</a>
    <a class="nav-link link text-light font-color-body" href="#">Unduh</a>
   </div>
  </div>
 </div>
</nav>

{{-- isi konten --}}
@foreach ($pratinjau as $no => $section)
 @includeIf("sections.partials.$section->partial", ['data' => $section, 'no' => $no])
@endforeach

{{-- footer --}}
<div class="row m-0 justify-content-between p-3 theme-color-secondary" id="footer-modal">
 <div class="col">
  <p class="h6 font-color-primary">Sekolah</p>
  <p class="font-color-secondary">Deskripsi Sekolah ...</p>
 </div>
 <div class="col">
  <p class="h6 font-color-primary">Informasi Kontak</p>
  <p class="">0812345...</p>
 </div>
 <div class="col text-center">
  <p class="h6 font-color-primary">Ikuti sosial media kami</p>
  <div class="col mx-auto text-center fs-4 d-flex justify-content-evenly">
   <i class="bi bi-instagram font-color-primary"></i>
   <i class="bi bi-facebook font-color-primary"></i>
   <i class="bi bi-twitter-x font-color-primary"></i>
   <i class="bi bi-youtube font-color-primary"></i>
  </div>
 </div>

 <hr>
 <div class="text-muted">
  @Copyright 2024
 </div>
</div>

<script src="{{ asset('js/script-section.js') }}"></script>
