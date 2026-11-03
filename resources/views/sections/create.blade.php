@extends('partials.main')

@section('content')
 <div class="row mt-3">
  <div class="col-12 p-2 px-3">
   <div class="card shadow bg-light mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
     <h5 class="card-title m-0 text-black">
      <a href="{{ route('section.index') }}">
       <i class="bi bi-chevron-left text-black"></i>
      </a>
      Tambah Data Section
     </h5>
    </div>
    {{-- bawah heading --}}
    <form action="{{ route('section.store') }}" id="form-create" class="needs-validation" method="post"
     enctype="multipart/form-data" novalidate>
     @csrf
     <div class="card-body">

      {{-- name --}}
      <div class="form-group row">
       <label class="col-xl-2 col-sm-3 col-form-label " for="inputNamaSection">Nama</label>
       <div class="col-xl-10 col-sm-9">
        <input type="text" class="form-control" id="inputNamaSection" name="name"
         placeholder="Masukan nama section..." pattern=".*\S.*" required value="{{ old('name') }}" maxlength="150">
        <div class="invalid-feedback">
         Perlu diisi
        </div>
       </div>
      </div>

      {{-- ukuran section --}}
      <div class="form-group row mt-2">
       <div class="col-12">
        <div class="row d-flex">
         <div class="col-xl-2 col-sm-3">
          <label class="col-form-label">Ukuran</label>
         </div>
         <div class="col-xl-10 col-sm-9">
          <div class="form-check form-check-inline me-3 col-form-label mb-0">
           <input class="form-check-input cursor-pointer inputUkuran" type="radio" name="size" value="full"
            id="size1" @if (old('size') == 'full' || old('size') == null) checked @endif>
           <label class="form-check-label p-0 cursor-pointer" for="size1">
            Memenuhi Layar
           </label>
          </div>
          <div class="form-check form-check-inline me-3 col-form-label mb-0">
           <input class="form-check-input cursor-pointer inputUkuran" type="radio" name="size" value="big"
            id="size2" @if (old('size') == 'big') checked @endif>
           <label class="form-check-label p-0 cursor-pointer" for="size2">
            Besar
           </label>
          </div>
          <div class="form-check form-check-inline me-3 col-form-label mb-0">
           <input class="form-check-input cursor-pointer inputUkuran" type="radio" name="size" value="medium"
            id="size3" @if (old('size') == 'medium') checked @endif>
           <label class="form-check-label p-0 cursor-pointer" for="size3">
            Sedang
           </label>
          </div>
          <div class="form-check form-check-inline me-0 col-form-label mb-0">
           <input class="form-check-input cursor-pointer inputUkuran" type="radio" name="size" value="small"
            id="size4" @if (old('size') == 'small') checked @endif>
           <label class="form-check-label p-0 cursor-pointer" for="size4">
            Kecil
           </label>
          </div>
         </div>
        </div>
       </div>
      </div>

      {{-- urutan section --}}
      <div class="form-group row mt-2">
       <label class="col-xl-2 col-sm-3 col-form-label " for="inputUrutan">Urutan</label>
       <div class="col-xl-10 col-sm-9">
        <div class="input-group">
         <div class="col-auto d-flex">
          <div class="col-span-value-section d-flex align-items-center justify-content-center pe-2">
           <span class="input-group-text w-100 justify-content-center"
            id="hasilInputUrutan">{{ old('urutan', $urutan) }}</span>
          </div>
          <div class="col-auto d-flex align-items-center pe-2">
           <button type="button" id="minusUrutan" class="btn btn-secondary m-0 p-0 fs-4-sendiri px-2">
            <i class="bi bi-dash"></i>
           </button>
          </div>
         </div>
         <div class="col d-flex">
          <div class="col pt-2 border rounded px-3">
           <input type="range" required class="form-range" name="urutan" id="inputUrutan"
            value="{{ old('urutan', $urutan) }}" min="1" max="{{ $urutan }}">
          </div>
          <div class="col-auto p-0 m-0 d-flex align-items-center justify-content-end ps-2">
           <button type="button" id="plusUrutan" class="btn btn-secondary m-0 p-0 fs-4-sendiri px-2">
            <i class="bi bi-plus"></i>
           </button>
          </div>
         </div>
        </div>
       </div>
      </div>

      {{-- jarak atas --}}
      <div class="form-group row mt-2">
       <label class="col-xl-2 col-sm-3 col-form-label " for="inputMarginTop">Jarak Atas</label>
       <div class="col-xl-10 col-sm-9">
        <div class="input-group">
         <div class="col-auto d-flex">
          <div class="col-span-value-section d-flex align-items-center justify-content-center pe-2">
           <span class="input-group-text w-100 justify-content-center"
            id="hasilInputMarginTop">{{ old('margin_top', '0px') }}</span>
          </div>
          <div class="col-auto d-flex align-items-center pe-2">
           <button type="button" id="minusMarginTop" class="btn btn-secondary m-0 p-0 fs-4-sendiri px-2">
            <i class="bi bi-dash"></i>
           </button>
          </div>
         </div>
         <div class="col d-flex">
          <div class="col pt-2 border rounded px-3">
           <input type="range" required class="form-range" name="margin_top" id="inputMarginTop"
            value="{{ old('margin_top', 0) }}" min="0" max="999">
          </div>
          <div class="col-auto p-0 m-0 d-flex align-items-center justify-content-end ps-2">
           <button type="button" id="plusMarginTop" class="btn btn-secondary m-0 p-0 fs-4-sendiri px-2">
            <i class="bi bi-plus"></i>
           </button>
          </div>
         </div>
        </div>
       </div>
      </div>

      {{-- jarak bawah --}}
      <div class="form-group row mt-2">
       <label class="col-xl-2 col-sm-3 col-form-label " for="inputMarginBottom">Jarak Bawah</label>
       <div class="col-xl-10 col-sm-9">
        <div class="input-group ">
         <div class="col-auto d-flex">
          <div class="col-span-value-section d-flex align-items-center justify-content-center pe-2">
           <span class="input-group-text w-100 justify-content-center"
            id="hasilInputMarginBottom">{{ old('margin_bottom', '50px') }}</span>
          </div>
          <div class="col-auto d-flex align-items-center pe-2">
           <button type="button" id="minusMarginBottom" class="btn btn-secondary m-0 p-0 fs-4-sendiri px-2">
            <i class="bi bi-dash"></i>
           </button>
          </div>
         </div>
         <div class="col d-flex">
          <div class="col pt-2 border rounded px-3">
           <input type="range" required class="form-range" name="margin_bottom" id="inputMarginBottom"
            value="{{ old('margin_bottom', 50) }}" min="0" max="999">
          </div>
          <div class="col-auto p-0 m-0 d-flex align-items-center justify-content-end ps-2">
           <button type="button" id="plusMarginBottom" class="btn btn-secondary m-0 p-0 fs-4-sendiri px-2">
            <i class="bi bi-plus"></i>
           </button>
          </div>
         </div>
        </div>
       </div>
      </div>

      {{-- status --}}
      <div class="form-group row mt-2">
       <div class="col-12">
        <div class="row d-flex">
         <div class="col-xl-2 col-sm-3">
          <label class="col-form-label">Status</label>
         </div>
         <div class="col-xl-10 col-sm-9">
          <div class="form-check form-check-inline me-3 col-form-label mb-0">
           <input class="form-check-input cursor-pointer" type="radio" name="status" value="1"
            id="status1" @if (old('status') == '1' || old('status') == null) checked @endif>
           <label class="form-check-label p-0 cursor-pointer" for="status1">
            Aktif
           </label>
          </div>
          <div class="form-check form-check-inline me-0 col-form-label mb-0">
           <input class="form-check-input cursor-pointer" type="radio" name="status" value="0"
            id="status0" @if (old('status') == '0') checked @endif>
           <label class="form-check-label p-0 cursor-pointer" for="status0">
            Tidak Aktif
           </label>
          </div>
         </div>
        </div>
       </div>
      </div>

      {{-- partial --}}
      <div class="form-group row mt-2">
       <div class="col-12">
        <div class="row d-flex">
         <div class="col-xl-2 col-sm-3 col-12">
          <label class="col-form-label" for="inputPartial">Jenis</label>
         </div>
         <div class="col-xl-9 col-sm-8 col-10">
          <div class="form-check form-check-inline me-3 col-form-label mb-0">
           <input class="form-check-input cursor-pointer inputPartials" required type="radio" name="partial"
            value="tagline" id="tagline" @if (old('partial') == 'tagline') checked @endif>
           <label class="form-check-label p-0 cursor-pointer" for="tagline">
            Slogan
           </label>
          </div>
          <div class="form-check form-check-inline me-3 col-form-label mb-0">
           <input class="form-check-input cursor-pointer inputPartials" required type="radio" name="partial"
            value="peta" id="peta" @if (old('partial') == 'peta') checked @endif>
           <label class="form-check-label p-0 cursor-pointer" for="peta">
            Peta
           </label>
          </div>
          <div class="form-check form-check-inline me-3 col-form-label mb-0">
           <input class="form-check-input cursor-pointer inputPartials" required type="radio" name="partial"
            value="hero" id="hero" @if (old('partial') == 'hero') checked @endif>
           <label class="form-check-label p-0 cursor-pointer" for="hero">
            Hero
           </label>
          </div>
          <div class="form-check form-check-inline me-3 col-form-label mb-0">
           <input class="form-check-input cursor-pointer inputPartials" required type="radio" name="partial"
            value="ghp" id="ghp" @if (old('partial') == 'ghp') checked @endif>
           <label class="form-check-label p-0 cursor-pointer" for="ghp">
            Gambar Head Paragraf
           </label>
          </div>
          <div class="form-check form-check-inline me-3 col-form-label mb-0">
           <input class="form-check-input cursor-pointer inputPartials" required type="radio" name="partial"
            value="slide_show" id="slide_show" @if (old('partial') == 'slide_show') checked @endif>
           <label class="form-check-label p-0 cursor-pointer" for="slide_show">
            Slide Show
           </label>
          </div>
          <div class="form-check form-check-inline me-0 col-form-label mb-0">
           <input class="form-check-input cursor-pointer inputPartials" required type="radio" name="partial"
            value="line" id="line" @if (old('partial') == 'line') checked @endif>
           <label class="form-check-label p-0 cursor-pointer" for="line">
            Garis
           </label>
          </div>
          <input type="text" class="form-control d-none" required id="cekInputPartials">
          <div class="invalid-feedback">
           Perlu dipilih
          </div>
         </div>
         <div class="col-xl-1 col-sm-1 col-2 d-flex justify-content-end align-items-start">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal"
           data-bs-target="#exampleModalToggle11" id="btnModalPreview">
           <i class="bi bi-question-circle"></i>
          </button>
         </div>
        </div>
       </div>
      </div>

      {{-- tagline --}}
      <div class="form-tagline d-none">
       <div class="form-group row mt-2">
        <label class="col-xl-2 col-sm-3 col-form-label" for="inputTagline">Slogan</label>
        <div class="col-xl-10 col-sm-9">
         <input type="text" class="form-control" id="inputTagline" name="tagline" value="{{ old('tagline') }}"
          placeholder="Masukan slogan..." pattern=".*\S.*" required readonly maxlength="150">
         <div class="invalid-feedback">
          Perlu diisi
         </div>
        </div>
       </div>
      </div>
      {{-- peta --}}
      <div class="form-peta d-none">
       {{-- cara input --}}
       <div class="form-group row mt-2">
        <label class="col-xl-2 col-sm-3 col-form-label">Cara input</label>
        <div class="col-xl-10 col-sm-9">
         <video width="100%" height="auto" controls>
          <source src="{{ asset('video/tutorial/tutorial_tambah_peta.mp4') }}" type="video/mp4">
          Ganti browser Anda untuk melihat video tutorial
         </video>
        </div>
       </div>
       {{-- url peta --}}
       <div class="form-group row mt-2">
        <label class="col-xl-2 col-sm-3 col-12 col-form-label" for="inputPeta">Url Peta</label>
        <div class="col-xl-9 col-sm-8 col-10">
         <textarea name="peta" id="inputPeta" class="form-control" placeholder="Tempelkan url peta..." required readonly
          value="{{ old('peta') }}"></textarea>
         <div class="invalid-feedback">
          Perlu diisi
         </div>
        </div>
        <div class="col-xl-1 col-sm-1 col-2 d-flex justify-content-end align-items-start">
         <a href="https://www.google.com/maps" type="button" class="btn btn-primary" target="_blank"
          rel="noopener noreferrer"><i class="bi bi-map"></i></a>
        </div>
       </div>
      </div>
      {{-- Hero --}}
      <div class="form-hero d-none">
       <div class="form-group row mt-2">
        <label class="col-xl-2 col-sm-3 col-form-label" for="inputTextHero">Teks Hero</label>
        <div class="col-xl-10 col-sm-9">
         <input type="text" class="form-control" id="inputTextHero" name="text_hero" maxlength="150"
          placeholder="Masukan teks hero..." pattern=".*\S.*" required readonly value="{{ old('text_hero') }}">
         <div class="invalid-feedback">
          Perlu diisi
         </div>
        </div>
       </div>
       <div class="form-group row mt-2">
        <label class="col-xl-2 col-sm-3 col-form-label" for="inputTextButton">Teks Tombol</label>
        <div class="col-xl-10 col-sm-9">
         <input type="text" class="form-control" id="inputTextButton" name="text_button" maxlength="20"
          placeholder="Masukan teks tombol ..." pattern=".*\S.*" required readonly value="{{ old('text_button') }}">
         <div class="invalid-feedback">
          Perlu diisi
         </div>
        </div>
       </div>
       <div class="form-group row mt-2">
        <div class="col-12">
         <div class="row d-flex">
          <div class="col-xl-2 col-sm-3">
           <label class="col-form-label" for="inputLinkButton">Tujuan Tombol</label>
          </div>
          <div class="col-xl-10 col-sm-9">
           <div class="form-check form-check-inline me-3 col-form-label mb-0">
            <input class="form-check-input cursor-pointer" type="radio" name="link_button" value="1"
             id="link_button1" @if (old('link_button') == '1' || old('link_button') == null) checked @endif>
            <label class="form-check-label p-0 cursor-pointer" for="link_button1">
             Beranda
            </label>
           </div>
           <div class="form-check form-check-inline me-3 col-form-label mb-0">
            <input class="form-check-input cursor-pointer" type="radio" id="link_button2" name="link_button"
             value="2" @if (old('link_button') == '2') checked @endif>
            <label class="form-check-label p-0 cursor-pointer" for="link_button2">
             Staf
            </label>
           </div>
           <div class="form-check form-check-inline me-3 col-form-label mb-0">
            <input class="form-check-input cursor-pointer" type="radio" id="link_button3" name="link_button"
             value="3" @if (old('link_button') == '3') checked @endif>
            <label class="form-check-label p-0 cursor-pointer" for="link_button3">
             Berita
            </label>
           </div>
           <div class="form-check form-check-inline me-3 col-form-label mb-0">
            <input class="form-check-input cursor-pointer" type="radio" id="link_button4" name="link_button"
             value="4" @if (old('link_button') == '4') checked @endif>
            <label class="form-check-label p-0 cursor-pointer" for="link_button4">
             Galeri Gambar
            </label>
           </div>
           <div class="form-check form-check-inline me-3 col-form-label mb-0">
            <input class="form-check-input cursor-pointer" type="radio" id="link_button5" name="link_button"
             value="5" @if (old('link_button') == '5') checked @endif>
            <label class="form-check-label p-0 cursor-pointer" for="link_button5">
             Galeri Video
            </label>
           </div>
           <div class="form-check form-check-inline me-3 col-form-label mb-0">
            <input class="form-check-input cursor-pointer" type="radio" id="link_button6" name="link_button"
             value="6" @if (old('link_button') == '6') checked @endif>
            <label class="form-check-label p-0 cursor-pointer" for="link_button6">
             Unduh
            </label>
           </div>
          </div>
         </div>
        </div>
       </div>
       <div class="form-group mt-2 row">
        <label class="col-xl-2 col-sm-3 col-form-label" for="inputHero">Hero</label>
        <div class="col-xl-10 col-sm-9">
         <input type="file" name="hero[]" id="inputHero" class="form-control" accept=".jpg,.jpeg,.png" required
          multiple readonly>
         <div class="invalid-feedback">
          Perlu dipilih
         </div>
        </div>
       </div>
       <div class="form-group row">
        <div class="col-12">
         <div class="inputFotoHeroes d-none text-center mt-2">
          {{-- ... perulangan img --}}
         </div>
        </div>
       </div>
      </div>
      {{-- ghp --}}
      <div class="form-ghp d-none">
       <div class="form-group row mt-2">
        <label class="col-xl-2 col-sm-3 col-form-label" for="inputGambarGhp">Gambar</label>
        <div class="col-xl-10 col-sm-9">
         <input type="file" class="form-control" id="inputGambarGhp" name="imgGhp[]" required multiple readonly
          accept=".jpg,.jpeg,.png">
         <div class="invalid-feedback">
          Perlu dipilih
         </div>
        </div>
       </div>
       <div class="form-group row">
        <div class="col-12">
         <div class="inputFotoGhp d-none text-center mt-2">
          {{-- ... perulangan img --}}
         </div>
        </div>
       </div>
       <div class="form-group row mt-3">
        <label class="col-xl-2 col-sm-3 col-form-label pt-0" for="trixGhpSection">Teks Konten</label>
        <div class="col-xl-10 col-sm-9 div-section-trix">
         <input id="paragraf" type="hidden" name="contentGhp" value="{{ old('contentGhp') }}">
         <trix-editor id="trixGhpSection" input="paragraf" class="form-control text-break"></trix-editor>
        </div>
       </div>
      </div>
      {{-- slider --}}
      <div class="form-slider d-none">
       <div class="form-group row mt-2">
        <label class="col-xl-2 col-sm-3 col-form-label">Slide Show</label>
        <div class="col-xl-10 col-sm-9">
         <input type="file" class="form-control" id="inputSlider" name="slider[]" required multiple readonly
          accept=".jpg,.jpeg,.png">
         <div class="invalid-feedback">
          Perlu dipilih
         </div>
        </div>
       </div>
       <div class="form-group row">
        <div class="col-12">
         <div class="inputFotoSlider d-none text-center mt-2">
          {{-- ... perulangan img --}}
         </div>
        </div>
       </div>
      </div>
      {{-- Line PBWRCA posisi, tebal, lebar, tepi, warna, jumlah --}}
      <div class="form-line d-none">
       <div class="form-group row mt-2">
        <div class="col-12">
         <div class="row d-flex">
          <div class="col-xl-2 col-sm-3 col-12">
           <label class="col-form-label">Posisi</label>
          </div>
          <div class="col-xl-10 col-sm-9">
           <div class="form-check form-check-inline me-3 col-form-label mb-0">
            <input class="form-check-input cursor-pointer inputPosisiGaris" type="radio" name="position"
             value="start" id="positionstart" @if (old('position') == 'start') checked @endif>
            <label class="form-check-label p-0 cursor-pointer" for="positionstart">
             Kiri
            </label>
           </div>
           <div class="form-check form-check-inline me-3 col-form-label mb-0">
            <input class="form-check-input cursor-pointer inputPosisiGaris" type="radio" name="position"
             value="center" id="positioncenter" @if (old('position') == 'center' || old('position') == null) checked @endif>
            <label class="form-check-label p-0 cursor-pointer" for="positioncenter">
             Tengah
            </label>
           </div>
           <div class="form-check form-check-inline me-0 col-form-label mb-0">
            <input class="form-check-input cursor-pointer inputPosisiGaris" type="radio" name="position"
             value="end" id="positionend" @if (old('position') == 'end') checked @endif>
            <label class="form-check-label p-0 cursor-pointer" for="positionend">
             Kanan
            </label>
           </div>
          </div>
         </div>
        </div>
       </div>

       <div class="form-group row mt-2">
        <div class="col-12">
         <div class="row d-flex">
          <div class="col-xl-2 col-sm-3 col-12">
           <label class="col-form-label">Tepi</label>
          </div>
          <div class="col-xl-10 col-sm-9">
           <div class="form-check form-check-inline me-3 col-form-label mb-0">
            <input class="form-check-input cursor-pointer inputTepiGaris" type="radio" name="round"
             value="1" id="round1" @if (old('round') == '1' || old('round') == null) checked @endif>
            <label class="form-check-label p-0 cursor-pointer" for="round1">
             Bulat
            </label>
           </div>
           <div class="form-check form-check-inline me-0 col-form-label mb-0">
            <input class="form-check-input cursor-pointer inputTepiGaris" type="radio" name="round"
             value="0" id="round0" @if (old('round') == '0') checked @endif>
            <label class="form-check-label p-0 cursor-pointer" for="round0">
             Kotak
            </label>
           </div>
          </div>
         </div>
        </div>
       </div>

       <div class="form-group row mt-2">
        <label class="col-xl-2 col-sm-3 col-form-label" for="inputWarnaGaris">Warna</label>
        <div class="col-xl-10 col-sm-9">
         <input type="color" class="form-control form-control-color w-100" id="inputWarnaGaris"
          value="{{ old('color', '#000000') }}" name="color">
        </div>
       </div>

       <div class="form-group row mt-2">
        <label class="col-xl-2 col-sm-3 col-form-label" for="inputTebalGaris">Tebal</label>
        <div class="col-xl-10 col-sm-9 m-0 kolomInputGaris">
         <div class="input-group">
          <div class="col-auto d-flex">
           <div class="col-span-value-section d-flex align-items-center justify-content-center pe-2">
            <span class="input-group-text w-100 justify-content-center"
             id="hasilInputTebalGaris">{{ old('bold', '3px') }}</span>
           </div>
           <div class="col-auto d-flex align-items-center pe-2">
            <button type="button" id="minusTebalGaris" class="btn btn-secondary m-0 p-0 fs-4-sendiri px-2">
             <i class="bi bi-dash"></i>
            </button>
           </div>
          </div>
          <div class="col d-flex">
           <div class="col pt-2 border rounded px-3">
            <input type="range" required class="form-range" name="bold" id="inputTebalGaris" readonly
             value="{{ old('bold', 3) }}" min="1" max="100">
           </div>
           <div class="col-auto p-0 m-0 d-flex align-items-center justify-content-end ps-2">
            <button type="button" id="plusTebalGaris" class="btn btn-secondary m-0 p-0 fs-4-sendiri px-2">
             <i class="bi bi-plus"></i>
            </button>
           </div>
          </div>
         </div>
        </div>
       </div>

       <div class="form-group row mt-2">
        <label class="col-xl-2 col-sm-3 col-form-label" for="inputLebarGaris">Panjang</label>
        <div class="col-xl-10 col-sm-9 m-0 kolomInputGaris">
         <div class="input-group">
          <div class="col-auto d-flex">
           <div class="col-span-value-section d-flex align-items-center justify-content-center pe-2">
            <span class="input-group-text w-100 justify-content-center"
             id="hasilInputLebarGaris">{{ old('length', '80%') }}</span>
           </div>
           <div class="col-auto d-flex align-items-center pe-2">
            <button type="button" id="minusLebarGaris" class="btn btn-secondary m-0 p-0 fs-4-sendiri px-2">
             <i class="bi bi-dash"></i>
            </button>
           </div>
          </div>
          <div class="col d-flex">
           <div class="col pt-2 border rounded px-3">
            <input type="range" required class="form-range" name="length" id="inputLebarGaris" readonly
             value="{{ old('length', 80) }}" min="1" max="100">
           </div>
           <div class="col-auto p-0 m-0 d-flex align-items-center justify-content-end ps-2">
            <button type="button" id="plusLebarGaris" class="btn btn-secondary m-0 p-0 fs-4-sendiri px-2">
             <i class="bi bi-plus"></i>
            </button>
           </div>
          </div>
         </div>
        </div>
       </div>

       <div class="form-group row mt-2">
        <label class="col-xl-2 col-sm-3 col-form-label" for="inputJumlahGaris">Jumlah</label>
        <div class="col-xl-10 col-sm-9 m-0 kolomInputGaris">
         <div class="input-group">
          <div class="col-auto d-flex">
           <div class="col-span-value-section d-flex align-items-center justify-content-center pe-2">
            <span class="input-group-text w-100 justify-content-center"
             id="hasilInputJumlahGaris">{{ old('amount', '1') }}</span>
           </div>
           <div class="col-auto d-flex align-items-center pe-2">
            <button type="button" id="minusJumlahGaris" class="btn btn-secondary m-0 p-0 fs-4-sendiri px-2">
             <i class="bi bi-dash"></i>
            </button>
           </div>
          </div>
          <div class="col d-flex">
           <div class="col pt-2 border rounded px-3">
            <input type="range" required class="form-range" name="amount" id="inputJumlahGaris" readonly
             value="{{ old('amount', 1) }}" min="1" max="20">
           </div>
           <div class="col-auto p-0 m-0 d-flex align-items-center justify-content-end ps-2">
            <button type="button" id="plusJumlahGaris" class="btn btn-secondary m-0 p-0 fs-4-sendiri px-2">
             <i class="bi bi-plus"></i>
            </button>
           </div>
          </div>
         </div>
        </div>
       </div>

      </div>

     </div>
     <div class="card-footer bg-light py-0 row m-0 px-0">
      <div class="col-12 fw-medium py-2">
       <span id="text-pratinjau">
        Silahkan Lengkapi Data Untuk Melihat Pratinjau
       </span>
      </div>
      <div class="col-12">
       <div class="sectionPratinjau">
        <div class="pratinjauTagline mt-1 d-none">
         <div class="row">
          @include('sections.previews.tagline')
         </div>
        </div>
        <div class="pratinjauPeta mt-1 d-none">
         <div class="row">
          @include('sections.previews.peta')
         </div>
        </div>
        <div class="pratinjauHero mt-1 d-none">
         <div class="row body" id="divPreviewHeroes">
          {{-- @include('sections.previews.') --}}
         </div>
        </div>
        <div class="pratinjauGhp mt-1 d-none">
         <div class="row">
          @include('sections.previews.ghp')
         </div>
        </div>
        <div class="pratinjauSlidehow mt-1 d-none">
         <div class="row body" id="divPreviewSliders">
          {{-- @include('sections.previews.') --}}
         </div>
        </div>
        <div class="pratinjauGaris mt-1 d-none">
         <div class="row body" id="divPreviewGaris">
          {{-- @include('sections.previews.line') --}}
         </div>
        </div>
       </div>
      </div>
     </div>
     <div class="card-footer text-end">
      <button type="button" class="btn btn-danger m-0 my-2" id="btnBatal">Batal</button>
      <button type="submit" class="btn btn-primary m-0 my-2" id="btnSimpan">Simpan</button>
     </div>
    </form>
    <!-- Modal PREVIEW-->
    <div class="modal fade" id="exampleModalToggle11" aria-hidden="true" aria-labelledby="exampleModalToggleLabel11"
     tabindex="-1">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen p-5 h-auto">
      <div class="modal-content">
       <div class="modal-header">
        <h1 class="modal-title fs-5">
         <span class="text-black" id="exampleModalToggleLabel11">Contoh</span>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       {{-- PREVIEW --}}
       <div class="modal-body body">
        {{-- priview tagline --}}
        <div class="previewTagline d-none">
         <div class="col-12 p-0">
          <div
           class="theme-color-primary d-flex align-items-center text-center justify-content-center fs-1 py-5 px-2 pre">
           {{-- <b class="font-color-body">الصلاة والسلام عليك يا رسول الله</b> --}}
           <b class="font-color-body">Selamat Belajar Bagi Peserta Ujian</b>
          </div>
         </div>
        </div>
        {{-- priview line --}}
        <div class="previewLine d-none">
         <div class="col-12 p-0 py-2">
          <hr>
          <div class="text-success">
           <hr>
          </div>
          <hr class="border-danger border-2 opacity-50">
          <hr class="border-primary border-3 opacity-100">
         </div>
        </div>
        {{-- priview peta --}}
        <div class="previewPeta d-none">
         <div class="col-12 p-0">
          <iframe
           src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.7359559251254!2d107.15889847356354!3d-6.801942666522971!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68531746660c83%3A0x872f7eb20922929f!2sVetencode!5e0!3m2!1sen!2sid!4v1710854908514!5m2!1sen!2sid"
           width="100%" height="355px" style="border:0;" allowfullscreen="" loading="lazy"
           referrerpolicy="no-referrer-when-downgrade"></iframe>
         </div>
        </div>
        {{-- priview hero --}}
        <div class="previewHero d-none">
         <div class="col-12 p-0">
          {{-- <img src="{{ asset('img/hero.png') }}" alt="hero_img" class="section-hero-gambar-besar"> --}}
          <div class="bg-image-section-hero">
           <div class="text-overlay-section-hero theme-color-body-transparant pre shadow">
            <h1>Mau Belajar Dengan Nyaman & Didampingi Langsung Ahlinya?</h1>
            <a href="#" class="btn btn-light cursor-pointer theme-color-primary text-break text-start">
             <span class="font-color-body fw-semibold">Mauuu!</span>
            </a>
           </div>
           <div id="carouselExampleSlidesOnlyContohHero" class="carousel slide" data-bs-ride="carousel">
            {{-- <div class="carousel-indicators">
                   <button type="button" data-bs-target="#carouselExampleSlidesOnlyContohHero" data-bs-slide-to="0"
                    class="active" aria-current="true" aria-label="Slide 1"></button>
                   <button type="button" data-bs-target="#carouselExampleSlidesOnlyContohHero" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                   <button type="button" data-bs-target="#carouselExampleSlidesOnlyContohHero" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
                  </div> --}}
            <div class="carousel-inner">
             <div class="carousel-item carousel-item-section-hero active">
              <img src="{{ asset('img/hero-2.jpg') }}" alt="hero_img" class="d-block w-100">
             </div>
             <div class="carousel-item carousel-item-section-hero">
              <img src="{{ asset('img/hero.png') }}" alt="hero_img" class="section-hero-gambar-besar">
             </div>
            </div>
            {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleSlidesOnlyContohHero"
                   data-bs-slide="prev">
                   <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                   <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleSlidesOnlyContohHero"
                   data-bs-slide="next">
                   <span class="carousel-control-next-icon" aria-hidden="true"></span>
                   <span class="visually-hidden">Next</span>
                  </button> --}}
           </div>
          </div>
         </div>
        </div>
        {{-- priview slider --}}
        <div class="previewSlider d-none">
         <div class="col-12 p-0">
          <div class="row mb-0 p-0">
           <div class="col-2 p-0 m-0 "></div>
           <div class="col-8 m-0 p-0 shadow">
            <div id="carouselExampleIndicators0" class="carousel slide " data-bs-ride="carousel">
             <div class="carousel-indicators">

              <!-- {{-- Tombol geser slide show --}} -->
              <button type="button" data-bs-target="#carouselExampleIndicators0" data-bs-slide-to="0" class="active"
               aria-current="true"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators0" data-bs-slide-to="1"
               aria-current="true"></button>
              <!-- end button -->
             </div>
             <div class="carousel-inner">
              <!-- gambar -->
              <div class="carousel-item carousel-item-create-section active">
               <img src="{{ asset('img/hero.png') }}" class="d-block" alt="gambar slideshow">
              </div>
              <div class="carousel-item carousel-item-create-section">
               <img src="{{ asset('img/hero-2.jpg') }}" class="d-block" alt="gambar slideshow">
              </div>
              <!-- end gambar -->
             </div>
             <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators0"
              data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
             </button>
             <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators0"
              data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
             </button>
            </div>
           </div>
           <div class="col-2 p-0 m-0 "></div>
          </div>
         </div>
        </div>
        {{-- priview ghp --}}
        <div class="previewGhp d-none">
         <div class="row">
          <div class="col-md-4 d-flex justify-content-center align-items-center text-center mt-2">
           <div class="row">
            <!-- gambar -->
            <div class="col-12">
             <img src="{{ asset('img/anak.png') }}" alt="gambar slider"
              class="section-gambaratasbawah-ghp my-2 rounded-circle img-fluid">
            </div>
            <div class="col-12">
             <img src="{{ asset('img/anak-2.png') }}" alt="gambar slider"
              class="section-gambaratasbawah-ghp my-2 rounded-circle img-fluid">
            </div>
            <div class="col-12">
             <img src="{{ asset('img/anak-3.png') }}" alt="gambar slider"
              class="section-gambaratasbawah-ghp my-2 rounded-circle img-fluid">
            </div>
            <!-- end gambar -->

           </div>
          </div>
          <div class="col-md-8 d-flex align-items-center">
           <div class="row row-pe-4 pe-4">
            <!-- heading -->
            <div class="col-12">
             <h1 class="text-center">Tentang Kita</h1>
            </div>
            <div class="col-12">
             <p>Sekolah adalah institusi pendidikan yang memiliki peran penting dalam membentuk generasi muda untuk
              menjadi individu yang terdidik, berwawasan luas, dan siap menghadapi tantangan masa depan. Dalam
              lingkungan sekolah, siswa tidak hanya memperoleh pengetahuan akademis, tetapi juga mengembangkan
              keterampilan sosial, kreativitas, dan kepemimpinan yang diperlukan untuk sukses dalam kehidupan.</p>
            </div>
            <!--  end heading -->
            <!-- heading -->
            <div class="col-12">
             <h1 class="text-center">Visi Misi</h1>
            </div>
            <div class="col-12">
             <p>Visi misi sebuah sekolah adalah panduan utama yang menetapkan tujuan dan arah pendidikan. Visi adalah
              gambaran masa depan yang diinginkan oleh sekolah, sementara misi adalah pernyataan tentang bagaimana
              sekolah akan mencapai visinya. Visi dan misi yang baik membantu sekolah untuk tetap fokus pada tujuan
              akademis dan moral yang ingin dicapai, serta menginspirasi semua anggota komunitas sekolah untuk bekerja
              sama mencapainya.</p>
             <p>Menciptakan lingkungan pembelajaran yang inklusif, aman, dan mendukung.
              Memajukan prestasi akademis dan pengembangan pribadi setiap siswa.
              Membangun karakter yang kuat, nilai-nilai etika, dan rasa tanggung jawab sosial.
              Memfasilitasi kolaborasi antara siswa, guru, orang tua, dan masyarakat untuk meningkatkan kualitas
              pendidikan.
              Mengintegrasikan teknologi modern dan metode pengajaran inovatif untuk meningkatkan pembelajaran.
              Menumbuhkan semangat penelitian, kreativitas, dan kemandirian dalam siswa.
              Menyiapkan siswa untuk menjadi warga global yang terampil dan berkontribusi positif dalam masyarakat.</p>
            </div>
            <!--  end heading -->
           </div>
          </div>
         </div>
        </div>
       </div>
       {{-- END-PREVIEW --}}
       <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>

 <script>
  $(document).ready(function() {

   ///////////////////////////////////
   //     inisialisasi variabel     //
   ///////////////////////////////////
   let cekValidasi = '';
   let cekJumlahGaris = 1;
   let cekUkuranSection = 'px-full';
   let cekPosisiGaris = 'justify-content-center';
   let cekTepiGaris = 1;
   let cekInputGambarHeroSlider = 0;
   let cekInputTextHeroSlider = 0;
   let cekInputGambarGhp = 0;
   let cekInputTextGhp = 0;


   /////////////////////////////////////////
   // fungsi validasi pilih jenis section //
   /////////////////////////////////////////

   $('#btnModalPreview').prop('disabled', true);

   function readonlyForm() {
    $('#inputTagline').prop('readonly', true);
    $('#inputPeta').prop('readonly', true);
    $('#inputHero').prop('readonly', true);
    $('#inputTextHero').prop('readonly', true);
    $('#inputTextButton').prop('readonly', true);
    $('#inputSlider').prop('readonly', true);
    $('#inputGambarGhp').prop('readonly', true);
    $('#inputTebalGaris').prop('readonly', true);
    $('#inputLebarGaris').prop('readonly', true);
    $('#inputJumlahGaris').prop('readonly', true);
   }

   $('#btnBatal').click(function() {
    location.reload();
   });

   function validasiForm() {
    if (cekValidasi === 'tagline') {
     validasiFormTagline();
    } else if (cekValidasi === 'peta') {
     validasiFormPeta();
    } else if (cekValidasi === 'hero') {
     validasiFormHero();
    } else if (cekValidasi === 'ghp') {
     validasiFormGhp();
    } else if (cekValidasi === 'slide_show') {
     validasiFormSlideShow();
    } else if (cekValidasi === 'line') {
     validasiFormLine();
    }
   }

   function dNonePratinjau() {
    $('.pratinjauTagline, .pratinjauPeta, .pratinjauHero, .pratinjauGhp, .pratinjauSlidehow, .pratinjauGaris')
     .addClass('d-none');
    $('.pratinjauTagline, .pratinjauPeta, .pratinjauHero, .pratinjauGhp, .pratinjauSlidehow, .pratinjauGaris')
     .removeClass('d-block');
   }

   function validasiFormTagline() {
    dNonePratinjau();
    if ($('#inputNamaSection').val().trim() !== '' && $('#inputTagline').val().trim() !== '' && $('#cekInputPartials')
     .val() !== '') {
     $('#text-pratinjau').html('Pratinjau Beranda');
     $('.pratinjauTagline').removeClass('d-none');
    } else {
     $('#text-pratinjau').html('Silahkan Lengkapi Data Untuk Melihat Pratinjau');
     $('.pratinjauTagline').addClass('d-none');
    }
   }

   $('#inputTagline').on('input', function() {
    $('#sectionLivePriviewTextTagline').html($(this).val());
   });

   function isFrameText(text) {
    var regex = /^<iframe.*<\/iframe>$/;
    return regex.test(text);
   }

   function validasiFormPeta() {
    dNonePratinjau();
    if ($('#inputNamaSection').val().trim() !== '' && $('#inputPeta').val().trim() !== '' && $('#cekInputPartials')
     .val() !== '' &&
     isFrameText($('#inputPeta').val())) {
     $('#text-pratinjau').html('Pratinjau Beranda');
     $('.pratinjauPeta').removeClass('d-none');
    } else {
     $('#text-pratinjau').html('Silahkan Lengkapi Data Untuk Melihat Pratinjau');
     $('.pratinjauPeta').addClass('d-none');
    }
   }

   $('#inputPeta').on('input', function() {
    $('#sectionLivePriviewUrlMap').html($(this).val());
   });

   function validasiFormHero() {
    dNonePratinjau();
    if ($('#inputNamaSection').val().trim() !== '' && $('#inputHero').val().trim() !== '' && $('#inputTextHero').val()
     .trim() !== '' &&
     $('#inputTextButton').val().trim() !== '' && $('#cekInputPartials').val() !== '') {
     $('#text-pratinjau').html('Pratinjau Beranda');
     $('.pratinjauHero').removeClass('d-none');
    } else {
     $('#text-pratinjau').html('Silahkan Lengkapi Data Untuk Melihat Pratinjau');
     $('.pratinjauHero').addClass('d-none');
    }
   }

   function validasiFormSlideShow() {
    dNonePratinjau();
    if ($('#inputNamaSection').val().trim() !== '' && $('#inputSlider').val().trim() !== '' && $('#cekInputPartials')
     .val() !== '') {
     $('#text-pratinjau').html('Pratinjau Beranda');
     $('.pratinjauSlidehow').removeClass('d-none');
    } else {
     $('#text-pratinjau').html('Silahkan Lengkapi Data Untuk Melihat Pratinjau');
     $('.pratinjauSlidehow').addClass('d-none');
    }
   }

   function validateFiles(input) {
    var jumlahFoto = input.files.length;
    var maxSize = 3 * 1024 * 1024; // 3 MB dalam bytes

    for (var i = 0; i < input.files.length; i++) {
     var fileType = input.files[i].type; // Tipe file
     var fileSize = input.files[i].size; // Ukuran file dalam bytes
     if (!['image/jpeg', 'image/png', 'image/jpg'].includes(fileType)) {
      Swal.fire({
       icon: 'warning',
       title: 'Perhatian!',
       text: 'File harus berupa gambar (jpeg, png, jpg).',
      });
      input.value = '';
      return false; // Keluar dari loop jika satu file tidak sesuai tipe
     } else if (jumlahFoto > 5) {
      Swal.fire({
       icon: 'warning',
       title: 'Perhatian!',
       text: 'Maksimal hanya boleh mengunggah 5 gambar.',
      });
      input.value = '';
      return false; // Keluar dari loop jika satu file melebihi batasan
     } else if (fileSize > maxSize) {
      Swal.fire({
       icon: 'warning',
       title: 'Perhatian!',
       text: 'Ukuran Gambar tidak boleh lebih dari 3 MB.',
      });
      input.value = '';
      return false; // Keluar dari loop jika satu file melebihi batasan
     } else {
      console.log('lolos validasi img');
      return true;
     }
    }
   }

   function validasiFormGhp() {
    dNonePratinjau();
    if ($('#inputNamaSection').val().trim() !== '' && $('#cekInputPartials').val().trim() !== '' && $(
      '#inputGambarGhp').val() !== '' &&
     $('#trixGhpSection').text().trim() !== '') {
     $('#text-pratinjau').html('Pratinjau Beranda');
     $('.pratinjauGhp').removeClass('d-none');
    } else {
     $('.pratinjauGhp').addClass('d-none');
     $('#text-pratinjau').html('Silahkan Lengkapi Data Untuk Melihat Pratinjau');
    }
   }

   function validasiFormLine() {
    dNonePratinjau();
    if ($('#inputNamaSection').val().trim() !== '' &&
     $('#cekInputPartials').val() !== '') {
     $('#text-pratinjau').html('Pratinjau Beranda');
     $('#divPreviewGaris').html('');
     cekJumlahGaris = parseInt($('#inputJumlahGaris').val());
     if (cekTepiGaris) {
      var round = 'border-radius-section-line';
     } else {
      var round = 'tidak-ada';
     }
     for (var i = 0; i < cekJumlahGaris; i++) {
      // Membuat elemen div utama
      var divMain = $('<div></div>').addClass('col-12 p-0 d-flex ' + cekPosisiGaris + ' ' + cekUkuranSection);
      divMain.attr('data-margin-top', $('#inputMarginTop').val());
      divMain.attr('data-margin-bottom', $('#inputMarginBottom').val());
      divMain.css('margin-top', $('#inputMarginTop').val() + 'px');
      divMain.css('margin-bottom', $('#inputMarginBottom').val() + 'px');

      // Membuat elemen div dalam div utama
      var divChild = $('<div></div>').addClass('col-sendiri-section garis-section border-top p-0 ' + round);
      divChild.attr('data-width', $('#inputLebarGaris').val());
      divChild.attr('data-color', $('#inputWarnaGaris').val());
      divChild.attr('data-border-width', $('#inputTebalGaris').val());

      // Menambahkan elemen style sesuai dengan data-
      divChild.css('width', $('#inputLebarGaris').val() + '%');
      divChild.attr('style', function(i, style) {
       return (style || '') + 'border-width: ' + $('#inputTebalGaris').val() + 'px !important;';
      });
      divChild.css('--border-color', $('#inputWarnaGaris').val());

      // Menambahkan elemen div dalam div utama
      divMain.append(divChild);

      // Menambahkan elemen div utama ke dalam container
      $('#divPreviewGaris').append(divMain);
     }
     $('.pratinjauGaris').removeClass('d-none');
    } else {
     $('#text-pratinjau').html('Silahkan Lengkapi Data Untuk Melihat Pratinjau');
     $('.pratinjauGaris').addClass('d-none');
    }
   }

   // validasi saat input nama dll
   $(
     '#inputNamaSection, #inputTagline, #inputPeta, #inputHero, #inputTextHero, #inputTextButton, #inputSlider, #inputGambarGhp, #inputTebalGaris, #inputLebarGaris, #inputJumlahGaris, #inputWarnaGaris, #trixGhpSection'
    )
    .on('input', validasiForm);

   // RANGE
   $('#inputUrutan').on('input', function() {
    $('#hasilInputUrutan').text($(this).val());
   });

   $('#inputMarginTop').on('input', function() {
    $('#hasilInputMarginTop').text($(this).val() + "px");
    validasiForm();
   });

   $('#inputMarginBottom').on('input', function() {
    $('#hasilInputMarginBottom').text($(this).val() + "px");
    validasiForm();
   });

   $('#inputJumlahGaris').on('input', function() {
    $('#hasilInputJumlahGaris').text($(this).val());
    validasiFormLine();
   });

   $('#inputLebarGaris').on('input', function() {
    $('#hasilInputLebarGaris').text($(this).val() + "%");
    validasiFormLine();
   });

   $('#inputTebalGaris').on('input', function() {
    $('#hasilInputTebalGaris').text($(this).val() + "px");
    validasiFormLine();
   });

   $('#plusUrutan').on('click', function() {
    $('#inputUrutan').val(parseInt($('#inputUrutan').val()) + 1);
    $('#hasilInputUrutan').text($('#inputUrutan').val());
   });

   $('#minusUrutan').on('click', function() {
    $('#inputUrutan').val(parseInt($('#inputUrutan').val()) - 1);
    $('#hasilInputUrutan').text($('#inputUrutan').val());
   });

   $('#plusMarginTop').on('click', function() {
    $('#inputMarginTop').val(parseInt($('#inputMarginTop').val()) + 1);
    $('#hasilInputMarginTop').text($('#inputMarginTop').val() + "px");
    validasiForm();
   });

   $('#minusMarginTop').on('click', function() {
    $('#inputMarginTop').val(parseInt($('#inputMarginTop').val()) - 1);
    $('#hasilInputMarginTop').text($('#inputMarginTop').val() + "px");
    validasiForm();
   });

   $('#plusMarginBottom').on('click', function() {
    $('#inputMarginBottom').val(parseInt($('#inputMarginBottom').val()) + 1);
    $('#hasilInputMarginBottom').text($('#inputMarginBottom').val() + "px");
    validasiForm();
   });

   $('#minusMarginBottom').on('click', function() {
    $('#inputMarginBottom').val(parseInt($('#inputMarginBottom').val()) - 1);
    $('#hasilInputMarginBottom').text($('#inputMarginBottom').val() + "px");
    validasiForm();
   });

   $('#plusJumlahGaris').on('click', function() {
    $('#inputJumlahGaris').val(parseInt($('#inputJumlahGaris').val()) + 1);
    $('#hasilInputJumlahGaris').text($('#inputJumlahGaris').val());
    validasiFormLine();
   });

   $('#minusJumlahGaris').on('click', function() {
    $('#inputJumlahGaris').val(parseInt($('#inputJumlahGaris').val()) - 1);
    $('#hasilInputJumlahGaris').text($('#inputJumlahGaris').val());
    validasiFormLine();
   });

   $('#plusLebarGaris').on('click', function() {
    $('#inputLebarGaris').val(parseInt($('#inputLebarGaris').val()) + 1);
    $('#hasilInputLebarGaris').text($('#inputLebarGaris').val() + "%");
    validasiFormLine();
   });

   $('#minusLebarGaris').on('click', function() {
    $('#inputLebarGaris').val(parseInt($('#inputLebarGaris').val()) - 1);
    $('#hasilInputLebarGaris').text($('#inputLebarGaris').val() + "%");
    validasiFormLine();
   });

   $('#plusTebalGaris').on('click', function() {
    $('#inputTebalGaris').val(parseInt($('#inputTebalGaris').val()) + 1);
    $('#hasilInputTebalGaris').text($('#inputTebalGaris').val() + "px");
    validasiFormLine();
   });

   $('#minusTebalGaris').on('click', function() {
    $('#inputTebalGaris').val(parseInt($('#inputTebalGaris').val()) - 1);
    $('#hasilInputTebalGaris').text($('#inputTebalGaris').val() + "px");
    validasiFormLine();
   });
   // END RANGE

   $('.inputUkuran').on('change', function() {
    var ukuranValue = 'px-' + $(this).val();
    cekUkuranSection = ukuranValue;
    $('.section-partials').removeClass(function(index, className) {
     return (className.match(/(^|\s)px-\S+/g) || []).join(' ');
    }).addClass(ukuranValue);
    validasiForm();
   });

   $('.inputPosisiGaris').on('change', function() {
    cekPosisiGaris = 'justify-content-' + $(this).val();
    validasiForm();
   });

   $('.inputTepiGaris').on('change', function() {
    cekTepiGaris = parseInt($(this).val());
    validasiForm();
   });

   $('.plusMinusBtn').on('click', function() {
    var inputId = $(this).data('target');
    var currentValue = parseInt($(inputId).val());
    var operator = $(this).data('operator');
    var newValue = operator === 'plus' ? currentValue + 1 : currentValue - 1;
    $(inputId).val(newValue).trigger('input');
   });

   const forms = {
    'taglineForm': $('.form-tagline'),
    'petaForm': $('.form-peta'),
    'heroForm': $('.form-hero'),
    'ghpForm': $('.form-ghp'),
    'sliderForm': $('.form-slider'),
    'lineForm': $('.form-line'),
    'previewTagline': $('.previewTagline'),
    'previewLine': $('.previewLine'),
    'previewPeta': $('.previewPeta'),
    'previewHero': $('.previewHero'),
    'previewSlider': $('.previewSlider'),
    'previewGhp': $('.previewGhp'),
   };

   function showInputSection(jenis1, jenis2) {
    const jenisArray = [jenis1, jenis2];
    $.each(forms, function(formKey, form) {
     if (jenisArray.includes(formKey)) {
      form.removeClass('d-none');
     } else {
      form.addClass('d-none');
     }
    });
   }

   // milih jenis section
   $('.inputPartials').on('change', function() {
    var selectedValue = $(this).val();
    console.log('Nilai yang dipilih:', selectedValue);
    readonlyForm();
    $('#btnModalPreview').prop('disabled', false);

    if (selectedValue === 'tagline') {
     $('#cekInputPartials').val(selectedValue);
     cekValidasi = selectedValue;
     showInputSection('taglineForm', 'previewTagline');
     $('#exampleModalToggleLabel11').text('Contoh Tagline');
     $('#inputTagline').removeAttr('readonly');

    } else if (selectedValue === 'line') {
     $('#cekInputPartials').val(selectedValue);
     cekValidasi = selectedValue;
     showInputSection('lineForm', 'previewLine');
     $('#exampleModalToggleLabel11').text('Contoh Garis');
     $('#inputTebalGaris').removeAttr('readonly');
     $('#inputLebarGaris').removeAttr('readonly');
     $('#inputJumlahGaris').removeAttr('readonly');

    } else if (selectedValue === 'peta') {
     $('#cekInputPartials').val(selectedValue);
     cekValidasi = selectedValue;
     showInputSection('petaForm', 'previewPeta');
     $('#exampleModalToggleLabel11').text('Contoh Peta');
     $('#inputPeta').removeAttr('readonly');

    } else if (selectedValue === 'hero') {
     $('#cekInputPartials').val(selectedValue);
     cekValidasi = selectedValue;
     showInputSection('heroForm', 'previewHero');
     $('#exampleModalToggleLabel11').text('Contoh Hero');
     $('#inputHero').removeAttr('readonly');
     $('#inputTextHero').removeAttr('readonly');
     $('#inputTextButton').removeAttr('readonly');

    } else if (selectedValue === 'ghp') {
     $('#cekInputPartials').val(selectedValue);
     cekValidasi = selectedValue;
     showInputSection('ghpForm', 'previewGhp');
     $('#exampleModalToggleLabel11').text('Contoh Gambar Heading Paragraf');
     $('#inputGambarGhp').removeAttr('readonly');

    } else if (selectedValue === 'slide_show') {
     $('#cekInputPartials').val(selectedValue);
     cekValidasi = selectedValue;
     showInputSection('sliderForm', 'previewSlider');
     $('#exampleModalToggleLabel11').text('Contoh Slide Show');
     $('#inputSlider').removeAttr('readonly');
    }
    validasiForm();
   });




   ////////////////////////////////////////
   //    script tambah gambar hero     ////
   ////////////////////////////////////////
   function handleInputHeroChange() {
    const files = $('#inputHero')[0].files;
    if (!cekInputGambarHeroSlider) {
     if (cekInputTextHeroSlider) {
      $('#h1Hero').text($('#inputTextHero').val());
      $('#aHero').text($('#inputTextButton').val());
     }
    } else {
     if (files) {
      cekInputTextHeroSlider = 1;
      // Bersihkan gambar sebelumnya
      $('.inputFotoHeroes').html('');
      $('#divPreviewHeroes').html('');
      var divMain = $('<div>').addClass('col-12 p-0 section-partials ' + cekUkuranSection);

      var divChild1 = $('<div>').addClass('bg-image-section-hero');
      var divChild2a = $('<div>').addClass('text-overlay-section-hero theme-color-body-transparant pre shadow');
      var h12a = $('<h1>').text($('#inputTextHero').val()).attr('id', 'h1Hero');
      var a12a = $('<a>').addClass('btn btn-light theme-color-primary cursor-pointer text-break text-start');
      var span12a = $('<span>').addClass('font-color-body fw-semibold').attr('id', 'aHero').text($('#inputTextButton')
       .val());
      a12a.append(span12a);
      divChild2a.append(h12a);
      divChild2a.append(a12a);
      divChild1.append(divChild2a);

      var divChild2b = $('<div>').addClass('carousel slide').attr('id', 'carouselHeroLivePreviews').attr(
       'data-bs-ride', 'carousel');
      var divChild3b = $('<div>').addClass('carousel-inner');

      var widthImgHeroSlider = '33%';
      if (files.length == 4) {
       widthImgHeroSlider = '25%';
      } else if (files.length == 5) {
       widthImgHeroSlider = '20%';
      }
      for (let i = 0; i < files.length; i++) {
       const file = files[i];
       const imageURL = URL.createObjectURL(file);
       // Buat elemen img baru untuk setiap file
       const imgElement = $('<img>').addClass('hasilInputFotoHero').css({
        width: widthImgHeroSlider,
        padding: '5px',
        height: '200px',
        objectFit: 'cover',
        objectPosition: 'center'
       }).attr({
        src: imageURL,
        alt: 'Foto ' + (i + 1)
       });
       $('.inputFotoHeroes').append(imgElement);

       // buat element hero live preview
       var divChild4b = $('<div>').addClass('carousel-item carousel-item-section-hero');
       if (i == 0) {
        divChild4b.addClass('active');
       }
       const imgHeroSlider = $('<img>').addClass('d-block w-100').attr({
        src: imageURL,
        alt: 'Foto ' + (i + 1)
       });
       divChild4b.append(imgHeroSlider);
       divChild3b.append(divChild4b);
      }

      divChild2b.append(divChild3b);
      divChild1.append(divChild2b);
      divMain.append(divChild1);
      $('#divPreviewHeroes').append(divMain);

      $('.inputFotoHeroes').removeClass('d-none');
     } else {
      $('.inputFotoHeroes').addClass('d-none');
     }
    }
   }

   $('#inputHero').on('change', function() {
    var isValid = validateFiles(this);
    validasiFormHero();
    if (isValid) {
     cekInputGambarHeroSlider = 1;
     handleInputHeroChange();
    } else {
     $('.inputFotoHeroes').html('');
    }
   });

   // Listener untuk input teks pertama
   $('#inputTextHero').on('input', function() {
    cekInputGambarHeroSlider = 0;
    handleInputHeroChange();
   });

   // Listener untuk input teks kedua
   $('#inputTextButton').on('input', function() {
    cekInputGambarHeroSlider = 0;
    handleInputHeroChange();
   });



   ////////////////////////////////////
   //    script tambah gambar ghp    //
   ////////////////////////////////////
   function handleInputGhpChange() {
    const files = $('#inputGambarGhp')[0].files;
    if (!cekInputGambarGhp) {
     $('#livePreviewKontenGhp').html($('#paragraf').val());
    } else {
     if (files) {
      console.log('input gambar ghp');
      // Bersihkan gambar sebelumnya
      $('.inputFotoGhp').html('');
      $('#livePreviewImgGhp').html('');

      var widthImgGhp = '33%';
      if (files.length == 4) {
       widthImgGhp = '25%';
      } else if (files.length == 5) {
       widthImgGhp = '20%';
      }

      for (let i = 0; i < files.length; i++) {
       const file = files[i];
       const imageURL = URL.createObjectURL(file);

       // Buat elemen img baru untuk setiap file
       const imgElement = $('<img>').addClass('hasilInputFotoGhp').css({
        padding: '5px',
        width: widthImgGhp,
        padding: '5px',
        height: '200px',
        objectFit: 'cover',
        objectPosition: 'center'
       }).attr({
        src: imageURL,
        alt: 'Foto ' + (i + 1)
       });

       $('.inputFotoGhp').append(imgElement);

       // nambah element live preview
       var divMain = $('<div>').addClass('col-12');

       const imgGhpPreview = $('<img>').addClass('section-gambaratasbawah-ghp my-2').attr({
        'data-margin-right': 'small',
        src: imageURL,
        alt: 'Foto ' + (i + 1)
       });
       divMain.append(imgGhpPreview);
       $('#livePreviewImgGhp').append(divMain);

      }
      $('.inputFotoGhp').removeClass('d-none');
     } else {
      $('.inputFotoGhp').addClass('d-none');
     }
    }
   }

   $('#inputGambarGhp').on('change', function() {
    var isValid = validateFiles(this);
    validasiFormGhp();
    if (isValid) {
     cekInputGambarGhp = 1;
     handleInputGhpChange();
    } else {
     $('.inputFotoGhp').html('');
    }
   });

   $('#trixGhpSection').on('trix-change', function() {
    cekInputGambarGhp = 0;
    handleInputGhpChange();
   });

   function layarMd768PxCreateSection() {
    $('.ghp-content-live-priview').each(function() {
     $(this).addClass($(this).data('padding-right')).removeClass("text-center");
    });
    $('.ghp-content-live-priview ul li, .ghp-content-live-priview ol li').removeClass('text-start');
   };

   function layarKurang768PxCreateSection() {
    $('.ghp-content-live-priview').each(function() {
     $(this).removeClass($(this).data('padding-right')).addClass("text-center");
    });
    $('.ghp-content-live-priview ul li, .ghp-content-live-priview ol li').addClass('text-start');
   }

   if (window.innerWidth >= 768) {
    layarMd768PxCreateSection();
   } else {
    layarKurang768PxCreateSection();
   }

   $(window).on('resize', function() {
    if (window.innerWidth >= 768) {
     layarMd768PxCreateSection();
    } else {
     layarKurang768PxCreateSection();
    }
   });



   //////////////////////////////////////
   //  script tambah gambar slideshow  //
   //////////////////////////////////////
   $('#inputSlider').on('change', function(event) {
    var isValid = validateFiles(this);
    validasiFormSlideShow();
    if (isValid) {
     const files = event.target.files;
     if (files) {
      // Bersihkan gambar sebelumnya
      $('.inputFotoSlider').html('');
      $('#divPreviewSliders').html('');
      var divMain = $('<div>').addClass('col-12 p-0');
      var divChild1 = $('<div>').addClass('row m-0');
      var divChild2 = $('<div>').addClass('col-12 m-0 p-0 section-partials').addClass(cekUkuranSection);
      var divChild3 = $('<div>').addClass('carousel slide').attr({
       id: 'carouselSliderLivePreviews',
       'data-bs-ride': 'carousel'
      });
      var divChild4a = $('<div>').addClass('carousel-indicators');
      var divChild4b = $('<div>').addClass('carousel-inner');

      // perulagan img
      var widthImgSlider = '33%';
      if (files.length == 4) {
       widthImgSlider = '25%';
      } else if (files.length == 5) {
       widthImgSlider = '20%';
      }
      for (let i = 0; i < files.length; i++) {
       // buat hasil input
       const file = files[i];
       const imageURL = URL.createObjectURL(file);

       // Buat elemen img baru untuk setiap file
       const imgElement = $('<img>').addClass('hasilinputFotoSlider').css({
        width: widthImgSlider,
        padding: '5px',
        height: '200px',
        objectFit: 'cover',
        objectPosition: 'center'
       }).attr({
        src: imageURL,
        alt: 'Foto ' + (i + 1)
       });

       $('.inputFotoSlider').append(imgElement);

       //  buat live preview
       //  dalam div carousel-indicators divChild4a
       var buttonSlide = $('<button>').attr({
        type: 'button',
        'data-bs-target': '#carouselSliderLivePreviews',
        'data-bs-slide-to': i
       });
       if (i == 0) {
        buttonSlide.addClass('active').attr('aria-current', 'true');
       }
       divChild4a.append(buttonSlide);

       //  dalam div carousel-indicators divChild4b
       var divChild5b = $('<div>').addClass('carousel-item carousel-item-slideshow-partial');
       if (i == 0) {
        divChild5b.addClass('active');
       }
       const imgSlider = $('<img>').addClass('d-block').css({
        width: '100%',
        height: '350px',
        objectFit: 'cover',
        objectPosition: 'center'
       }).attr({
        src: imageURL,
        alt: 'Foto ' + (i + 1)
       });

       divChild5b.append(imgSlider);
       divChild4b.append(divChild5b);
      }
      // end perulangan img

      // button slider
      // Membuat elemen button carousel-control-prev
      var buttonPrev = $('<button>').addClass('carousel-control-prev').attr({
       type: 'button',
       'data-bs-target': '#carouselSliderLivePreviews',
       'data-bs-slide': 'prev'
      });
      var spanPrevIcon = $('<span>').addClass('carousel-control-prev-icon').attr('aria-hidden', 'true');
      var spanPrevVisuallyHidden = $('<span>').addClass('visually-hidden').text('Previous');
      buttonPrev.append(spanPrevIcon).append(spanPrevVisuallyHidden);

      // Membuat elemen button carousel-control-next
      var buttonNext = $('<button>').addClass('carousel-control-next').attr({
       type: 'button',
       'data-bs-target': '#carouselSliderLivePreviews',
       'data-bs-slide': 'next'
      });
      var spanNextIcon = $('<span>').addClass('carousel-control-next-icon').attr('aria-hidden', 'true');
      var spanNextVisuallyHidden = $('<span>').addClass('visually-hidden').text('Next');
      buttonNext.append(spanNextIcon).append(spanNextVisuallyHidden);

      // Menambahkan elemen button ke dalam dokumen
      divChild3.append(divChild4a).append(divChild4b).append(buttonPrev).append(buttonNext);
      divChild2.append(divChild3);
      divChild1.append(divChild2);
      divMain.append(divChild1);
      $('#divPreviewSliders').append(divMain);

      // end button slider

      $('.inputFotoSlider').removeClass('d-none');
     } else {
      $('.inputFotoSlider').addClass('d-none');
     }
    } else {
     $('.inputFotoSlider').html('');
    }
   });


   // 111 sini ke bawah

   /////////////////////////////////
   //       script trix ghp       //
   /////////////////////////////////
   $(document).on("trix-file-accept", function(event) {
    event.preventDefault(); // Membatalkan penerimaan file
    Swal.fire({
     icon: 'warning',
     title: 'Perhatian!',
     text: 'Tidak bisa menyisipkan file.',
    });
   });




   //////////////////////////////////////// 
   //  script row-pe-4 pada contoh ghp   // 
   //////////////////////////////////////// 
   function updateClasses() {
    $('.row-pe-4').each(function() {
     if (window.innerWidth >= 768) {
      $(this).addClass('pe-4');
     } else {
      $(this).removeClass('pe-4');
     }
     $(this).find('p').each(function() {
      if (window.innerWidth <= 767) {
       $(this).addClass('text-center');
      } else {
       $(this).removeClass('text-center');
      }
     });
    });
   }

   // Jalankan fungsi saat halaman dimuat
   updateClasses();

   // Jalankan fungsi saat ukuran jendela diubah
   $(window).resize(updateClasses);


  });
 </script>
@endsection
