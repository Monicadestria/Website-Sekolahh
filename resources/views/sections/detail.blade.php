@extends('partials.main')

@section('content')
 <div class="row mt-3">
  {{-- urutan section --}}
  <div class="col-12 p-2 px-3">
   <div class="card bg-light shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
     <h5 class="card-title m-0 text-black">
      <a href="{{ route('section.index') }}">
       <i class="bi bi-chevron-left text-black"></i>
      </a>
      Detail Section
     </h5>
    </div>
    <div class="card-body pb-1">
     <div class="row">
      <div class="row mb-2">
       <div class="col-sm-2 col-4">Urutan</div>
       <div class="col-auto px-0 ">:</div>
       <div class="col"><span class="section-urutan">{{ $section->urutan }}</span></div>
      </div>
      <div class="row mb-2">
       <div class="col-sm-2 col-4">Nama</div>
       <div class="col-auto px-0 ">:</div>
       <div class="col"><span class="section-name text-break">{{ $section->name }}</span></div>
      </div>
      <div class="row mb-2">
       <div class="col-sm-2 col-4">Jenis</div>
       <div class="col-auto px-0 ">:</div>
       <div class="col"><span class="section-jenis">{{ $section->jenis }}</span></div>
      </div>
      <div class="row mb-2">
       <div class="col-sm-2 col-4">Ukuran</div>
       <div class="col-auto px-0 ">:</div>
       <div class="col">
        <span class="section-size">
         @if ($section->size == 'full')
          Memenuhi layar
         @elseif ($section->size == 'big')
          Besar
         @elseif ($section->size == 'medium')
          Sedang
         @elseif ($section->size == 'small')
          Kecil
         @endif
        </span>
       </div>
      </div>
      <div class="row mb-2">
       <div class="col-sm-2 col-4">Jarak Atas</div>
       <div class="col-auto px-0 ">:</div>
       <div class="col"><span class="section-margin-top">{{ $section->margin_top }}px</span></div>
      </div>
      <div class="row mb-2">
       <div class="col-sm-2 col-4">Jarak Bawah</div>
       <div class="col-auto px-0 ">:</div>
       <div class="col"><span class="section-margin-bottom">{{ $section->margin_bottom }}px</span></div>
      </div>
      <div class="row">
       <div class="col-sm-2 col-4">Status</div>
       <div class="col-auto px-0 ">:</div>
       <div class="col">
        <span class="section-active">
         @if ($section->active == true)
          Aktif
         @else
          Tidak Aktif
         @endif
        </span>
       </div>
      </div>
     </div>

     {{-- ghp --}}
     @if ($section->partial === 'ghp')
      <div class="row mb-2 py-1">
       <div class="col"></div>
       <div class="col-auto mt-2">
        <button type="button" class="btn btn-warning text-white btn-modal-edit-data-ghp mx-1"
         data-id="{{ $dataGhp->id }}" data-key="{{ $section->id }}">
         Ubah Konten</button>
        <button type="button" class="btn btn-primary btn-modal-tambah-ghp" id="buttonModalToggleTambahGambarGhp"
         data-key="{{ $section->id }}">
         Tambah Gambar</button>
       </div>
      </div>
      {{-- modal ada di detail ghp --}}

      {{-- slideshow --}}
     @elseif ($section->partial === 'slide_show')
      <div class="row mb-2 py-1">
       <div class="col"></div>
       <div class="col-auto mt-2">
        <button type="button" id="buttonModalToggleTambahSlideShow" class="btn btn-primary btn-modal-tambah-slider"
         {{-- data-id="{{ $detailSection[0]->id }}" --}} data-key="{{ $section->id }}">
         Tambah Gambar</button>
       </div>
      </div>
      {{-- modal tambah gambar slider di detail --}}
     @elseif ($section->partial === 'peta')
      <div class="row mb-2 pb-1">
       <div class="col">
       </div>
       <div class="col-auto mt-2">
        <button type="button" class="btn btn-warning btn-modal-edit-map text-white" data-id="{{ $detailSection->id }}"
         data-key="{{ $section->id }}" {{-- data-bs-toggle="modal" data-bs-target="#modalEditUrlPeta" --}} id="ubahTulisanPeta">Ubah Peta</button>
        {{-- modal di file modal --}}
       </div>
      </div>
     @endif
    </div>

    {{-- hero --}}
    @if ($section->partial === 'hero')
     {{-- pakai ul li untuk pembatas, jika tidak pakai px-3 di row nya lalu pakai pb-1 di card-body  --}}
     {{-- <ul class="list-group list-group-flush">
      <li class="list-group-item"> --}}
     <div class="row mb-2 px-3">
      <div class="row mb-2">
       <div class="col-sm-2 col-4">Teks Hero</div>
       <div class="col-auto px-0 ">:</div>
       <div class="col hero-text-hero">{{ $dataHero->text_hero }}</div>
      </div>
      <div class="row mb-2">
       <div class="col-sm-2 col-4">Teks Tombol</div>
       <div class="col-auto px-0 ">:</div>
       <div class="col hero-text-button">{{ $dataHero->text_button }}</div>
      </div>
      <div class="row">
       <div class="col-sm-2 col-4">Tujuan Tombol</div>
       <div class="col-auto px-0 ">:</div>
       <div class="col hero-text-link-button">{{ $linkUrlButtonHero }}</div>
      </div>
     </div>
     <div class="row mb-3 px-3">
      <div class="col">
      </div>
      <div class="col-auto">
       <button type="button" class="btn btn-warning text-white btn-modal-edit-hero mx-1" data-id="{{ $dataHero->id }}"
        data-key="{{ $section->id }}">Ubah Data</button>
       <button type="button" id="buttonModalToggleTambahHero" class="btn btn-primary btn-modal-tambah-hero"
        data-key="{{ $section->id }}">
        Tambah Gambar</button>
      </div>
     </div>
     {{-- modal ada di detail hero --}}
     {{-- </li>
     </ul> --}}

     {{-- line --}}
    @elseif ($section->partial === 'line')
     <ul class="list-group list-group-flush">
      <li class="list-group-item">
       <div class="row mb-2">
        <div class="row mb-2">
         <div class="col-sm-2 col-4">Posisi</div>
         <div class="col-auto px-0 ">:</div>
         <div class="col line-position">
          @if ($detailSection->position == 'center')
           Tengah
          @elseif ($detailSection->position == 'start')
           Kiri
          @else
           Kanan
          @endif
         </div>
        </div>
        <div class="row mb-2">
         <div class="col-sm-2 col-4">Tepi</div>
         <div class="col-auto px-0 ">:</div>
         <div class="col line-round">
          @if ($detailSection->round == true)
           Bulat
          @else
           Kotak
          @endif
         </div>
        </div>
        <div class="row mb-0">
         <div class="col-sm-2 col-4 mt-1">Warna</div>
         <div class="col-auto px-0 mt-1">:</div>
         <div class="col">
          <input type="color" class="form-control form-control-color line-color" id="inputWarnGaris"
           value="{{ old('color', $detailSection->color) }}" name="color" disabled>
         </div>
        </div>
        <div class="row mb-2">
         <div class="col-sm-2 col-4">Tebal</div>
         <div class="col-auto px-0 ">:</div>
         <div class="col line-bold">{{ $detailSection->bold }}px</div>
        </div>
        <div class="row mb-2">
         <div class="col-sm-2 col-4">Panjang</div>
         <div class="col-auto px-0 ">:</div>
         <div class="col line-length">{{ $detailSection->length }}%</div>
        </div>
        <div class="row mb-2">
         <div class="col-sm-2 col-4">Jumlah</div>
         <div class="col-auto px-0 ">:</div>
         <div class="col line-amount">{{ $detailSection->amount }}</div>
        </div>
       </div>
       <div class="row">
        <div class="col">
        </div>
        <div class="col-auto">
         <button type="button" class="btn btn-warning mb-2 text-white btn-modal-edit-line"
          data-id="{{ $detailSection->id }}" data-key="{{ $section->id }}" {{-- data-bs-toggle="modal" data-bs-target="#exampleModalToggleUbahLine" --}}>Ubah Data</button>
        </div>
       </div>
       {{-- modal form edit di garis detail --}}
      </li>
     </ul>

     {{-- tagline --}}
    @elseif ($section->partial === 'tagline')
     {{-- pakai ul li untuk pembatas, jika tidak pakai px-3 di row nya lalu pakai pb-1 di card-body  --}}
     {{-- <ul class="list-group list-group-flush">
      <li class="list-group-item"> --}}
     <div class="row mb-2 px-3 ">
      <div class="row mt-1">
       <div class="col-sm-2 col-4">Slogan</div>
       <div class="col-auto px-0">:</div>
       <div class="col text-break">
        <span class="tagline-name">
         {{ $detailSection->name }}
        </span>
       </div>
      </div>
     </div>
     <div class="row mb-2 px-3">
      <div class="col"></div>
      <div class="col-auto">
       <button type="button" class="btn btn-warning mb-2 text-white btn-modal-edit-tagline"
        data-id="{{ $detailSection->id }}" data-key="{{ $section->id }}" {{-- data-bs-toggle="modal" data-bs-target="#exampleModalToggleUbahTagline" --}}>Ubah Data</button>
      </div>
     </div>
     {{-- </li>
     </ul> --}}
    @endif

   </div>
  </div>
  @php
   if ($section->partial == 'slide_show' || $section->partial == 'ghp' || $section->partial == 'hero') {
       $jumlahImg = count($detailSection);
       if ($jumlahImg == 5) {
           $lebarImg = 'w-20';
       } elseif ($jumlahImg == 4) {
           $lebarImg = 'w-25';
       } else {
           $lebarImg = 'w-33';
       }
   }
  @endphp
  <div class="isi-detail">
   @include("sections.details.$section->partial")
  </div>
 </div>

 <script>
  $(document).ready(function() {

   'use strict';
   const loading = $('#loading');
   $(document).on('click', '.btn-close-update', function() {
    $('.custom-backdrop').remove();
   });
   $(document).on('click', '.custom-backdrop', function() {
    $('.custom-backdrop').remove();
   });
   $(document).on('hidden.bs.modal', '.modal', function() {
    $('.custom-backdrop').remove();
   });

   //  validasi input gambar pada tambah gambar slider/hero/ghp
   $(document).on('change', '.addImg', function(event) {
    validationAddImg(event);
   });
   $(document).on('change', '.input-ubah-img', function(event) {
    validationEditImg(event, this);
   });

   //  show modal edit tagline
   $(document).on('click', '.btn-modal-edit-tagline', function() {
    var key = $(this).data('key');
    var id = $(this).data('id');
    $('#exampleModalToggleUbahTagline').modal('show');
    $('.modal-backdrop').remove();
    $('body').append('<div class="modal-backdrop fade show custom-backdrop"></div>');
    console.log('masuk form edit key', key, 'dan id', id);
   });
   //  show modal edit map
   $(document).on('click', '.btn-modal-edit-map', function() {
    var key = $(this).data('key');
    var id = $(this).data('id');
    $('#modalEditUrlPeta').modal('show');
    $('.modal-backdrop').remove();
    $('body').append('<div class="modal-backdrop fade show custom-backdrop"></div>');
    console.log('masuk form edit key', key, 'dan id', id);
   });
   //  show modal edit line
   $(document).on('click', '.btn-modal-edit-line', function() {
    var key = $(this).data('key');
    var id = $(this).data('id');
    $('#exampleModalToggleUbahLine').modal('show');
    $('.modal-backdrop').remove();
    $('body').append('<div class="modal-backdrop fade show custom-backdrop"></div>');
    console.log('masuk form edit key', key, 'dan id', id);
   });
   //  show modal tambah img slider
   $(document).on('click', '.btn-modal-tambah-slider', function() {
    var key = $(this).data('key');
    validasiOpenModalTambahImg(key, 'slider');
    console.log('masuk form edit key', key);
   });
   //  show modal edit img slider
   $(document).on('click', '.btn-modal-edit-slider', function() {
    var key = $(this).data('key');
    $('#modalToggleubahFotoSlider' + key).modal('show');
    $('.modal-backdrop').remove();
    $('body').append('<div class="modal-backdrop fade show custom-backdrop"></div>');
    console.log('masuk form edit key', key);
   });
   //  show modal edit data hero
   $(document).on('click', '.btn-modal-edit-hero', function() {
    var key = $(this).data('key');
    var id = $(this).data('id');
    $('#exampleModalToggleUbahHero').modal('show');
    $('.modal-backdrop').remove();
    $('body').append('<div class="modal-backdrop fade show custom-backdrop"></div>');
    console.log('masuk form edit key', key, 'dan id', id);
   });
   //  show modal tambah img hero
   $(document).on('click', '.btn-modal-tambah-hero', function() {
    var key = $(this).data('key');
    validasiOpenModalTambahImg(key, 'hero');
    console.log('masuk form edit key', key);
   });
   //  show modal edit img hero
   $(document).on('click', '.btn-modal-edit-img-hero', function() {
    var key = $(this).data('key');
    $('#modalToggleubahFotoHero' + key).modal('show');
    $('.modal-backdrop').remove();
    $('body').append('<div class="modal-backdrop fade show custom-backdrop"></div>');
    console.log('masuk form edit key', key);
   });
   //  show modal edit konten ghp
   $(document).on('click', '.btn-modal-edit-data-ghp', function() {
    var key = $(this).data('key');
    var id = $(this).data('id');
    $('#exampleModalToggleUbahKontenGhp').modal('show');
    $('.modal-backdrop').remove();
    $('body').append('<div class="modal-backdrop fade show custom-backdrop"></div>');
    console.log('masuk form edit key', key, ' dan id', id);
   });
   //  show modal tambah img ghp
   $(document).on('click', '.btn-modal-tambah-ghp', function() {
    var key = $(this).data('key');
    validasiOpenModalTambahImg(key, 'ghp');
    console.log('masuk form edit key', key);
   });
   //  show modal edit img ghp
   $(document).on('click', '.btn-modal-edit-img-ghp', function() {
    var key = $(this).data('key');
    $('#modalToggleubahFotoGhp' + key).modal('show');
    $('.modal-backdrop').remove();
    $('body').append('<div class="modal-backdrop fade show custom-backdrop"></div>');
    console.log('masuk form edit key', key);
   });

   //  aksi ubah data setiap mau kirim update-an
   $(document).on('click', '.btn-ubah-tagline', function() {
    updateTagline($(this).data('id'));
   });
   $(document).on('click', '.btn-ubah-map', function() {
    updateMap($(this).data('id'));
   });
   $(document).on('click', '.btn-ubah-line', function() {
    updateLine($(this).data('id'));
   });
   //  slider
   $(document).on('click', '.btn-tambah-slider', function() {
    addImg($(this).data('id'), 'slider');
   });
   $(document).on('click', '.btn-ubah-img-slider', function() {
    updateImg($(this).data('id'), $(this).data('key'), 'slider');
    console.log($(this).data('id'), $(this).data('key'));
   });
   $(document).on('click', '.btn-delete-slider', function() {
    deleteImg($(this).data('id'), $(this).data('key'), 'slide_show');
    console.log($(this).data('id'), $(this).data('key'));
   });
   //  hero
   $(document).on('click', '.btn-ubah-data-hero', function() {
    updateDataHero($(this).data('id'));
    console.log($(this).data('id'));
   });
   $(document).on('click', '.btn-tambah-img-hero', function() {
    console.log($(this).data('id'));
    addImg($(this).data('id'), 'hero');
   });
   $(document).on('click', '.btn-ubah-img-hero', function() {
    updateImg($(this).data('id'), $(this).data('key'), 'hero');
    console.log($(this).data('id'), $(this).data('key'));
   });
   $(document).on('click', '.btn-delete-hero', function() {
    deleteImg($(this).data('id'), $(this).data('key'), 'hero');
    console.log($(this).data('id'), $(this).data('key'));
   });
   //  ghp
   $(document).on('click', '.btn-ubah-data-ghp', function() {
    updateDataGhp($(this).data('id'));
    console.log($(this).data('id'));
   });
   $(document).on('click', '.btn-ubah-img-ghp', function() {
    updateImg($(this).data('id'), $(this).data('key'), 'ghp');
    console.log($(this).data('id'), $(this).data('key'));
   });
   $(document).on('click', '.btn-delete-ghp', function() {
    deleteImg($(this).data('id'), $(this).data('key'), 'ghp');
    console.log($(this).data('id'), $(this).data('key'));
   });
   $(document).on('click', '.btn-tambah-img-ghp', function() {
    console.log($(this).data('id'));
    addImg($(this).data('id'), 'ghp');
   });

   //  hanya input dengan kelas input-edit-tagline.
   $(document).on('keypress', 'input.input-edit-tagline', function(event) {
    if (event.which == 13) { // 13 adalah kode ASCII untuk Enter
     updateTagline($(this).data('id'));
     event.preventDefault();
    }
   });
   //  hanya input dengan kelas input-edit-map.
   $(document).on('keypress', 'textarea.input-edit-map', function(event) {
    if (event.which == 13) { // 13 adalah kode ASCII untuk Enter
     updateMap($(this).data('id'));
     event.preventDefault();
    }
   });
   //  hanya input dengan kelas input-edit-line.
   $(document).on('keypress', 'input.input-edit-line', function(event) {
    if (event.which == 13) { // 13 adalah kode ASCII untuk Enter
     updateLine($(this).data('id'));
     event.preventDefault();
    }
   });
   //  hanya input dengan kelas input-edit-data-hero.
   $(document).on('keypress', 'input.input-edit-data-hero', function(event) {
    if (event.which == 13) { // 13 adalah kode ASCII untuk Enter
     updateDataHero($(this).data('id'));
     console.log($(this).data('id'));
     event.preventDefault();
    }
   });


   //  validasi input
   function validateInputs(container, jenis) {
    let inputs = '';
    if (jenis == 'map') {
     inputs = container.querySelectorAll('textarea');
    } else {
     inputs = container.querySelectorAll('input');
    }
    let isValid = true;
    inputs.forEach(input => {
     if (!input.checkValidity()) {
      isValid = false;
     }
    });
    return isValid;
   }

   //  validasi tambah gambar di slider, hero, ghp
   function validasiOpenModalTambahImg(id, img) {
    var sisaFoto = $('input[name="maxImg"]').val();
    console.log('sisaFoto = ' + sisaFoto);
    if (sisaFoto <= 0) {
     if (img == 'slider') {
      reloadDataSlider(id);
     } else if (img == 'hero') {
      reloadDataHero(id);
     } else if (img == 'ghp') {
      reloadDataGhp(id);
     }
     Swal.fire({
      icon: 'warning',
      title: 'Perhatian!',
      text: 'Jumlah gambar sudah mencapai batas.',
     });
    } else {
     if (img == 'slider') {
      $('#exampleModalToggleTambahSlideShow').modal('show');
     } else if (img == 'hero') {
      $('#exampleModalToggleTambahHero').modal('show');
     } else if (img == 'ghp') {
      $('#exampleModalToggleTambahGambarGhp').modal('show');
     }
     $('.modal-backdrop').remove();
     $('body').append('<div class="modal-backdrop fade show custom-backdrop"></div>');
    }
   }

   function alertErrorRefreshPage() {
    Swal.fire({
     icon: 'error',
     title: 'Gagal!',
     text: 'Data gagal diubah.',
    }).then(() => {
     window.location.reload();
    });
   }

   // update tagline
   function updateTagline(id) {
    var action = 'update';
    var jenis = 'tagline';
    var tagline = $('input[name="tagline"]').val();
    var cekSection = $('input[name="cekSection"]').val();

    var validationContainer = document.querySelector('.needs-validation');
    if (!validateInputs(validationContainer, jenis)) {
     validationContainer.classList.add('was-validated');
     console.log('tidak lolos validasi');
    } else {
     validationContainer.classList.remove('was-validated');
     console.log('lolos validasi');
     $('#exampleModalToggleUbahTagline').modal('hide');

     $.ajax({
      url: "{{ route('section.updateDetail', '') }}" + "/" + id,
      type: 'PUT',
      data: {
       _token: '{{ csrf_token() }}',
       id: id,
       cekSection: cekSection,
       tagline: tagline,
      },
      beforeSend: function() {
       loading.toggleClass('d-none d-flex');
      },
      success: function(response) {
       if (response.icon == 'error') {
        alertErrorRefreshPage();
       } else {
        $('.ubah-px').each(function() {
         $(this).attr('class', 'col-12 p-0 mt-2 px-' + response.newData.section.size + ' mb-2 ubah-px body');
        });
        handleSuccess(response, action, jenis, '#exampleModalToggleUbahTagline');
       }
      },
      error: handleError,
      complete: function() {
       loading.toggleClass('d-none d-flex');
      }
     });
    }
   }

   // update map
   function updateMap(id) {
    var action = 'update';
    var jenis = 'map';
    var url = $('textarea[name="url"]').val();
    var cekSection = $('input[name="cekSection"]').val();

    var validationContainer = document.querySelector('.needs-validation');
    if (!validateInputs(validationContainer, jenis)) {
     validationContainer.classList.add('was-validated');
     console.log('tidak lolos validasi');
    } else {
     validationContainer.classList.remove('was-validated');
     console.log('lolos validasi');
     $('#modalEditUrlPeta').modal('hide');
     $.ajax({
      url: "{{ route('section.updateDetail', '') }}" + "/" + id,
      type: 'PUT',
      data: {
       _token: '{{ csrf_token() }}',
       id: id,
       cekSection: cekSection,
       url: url,
      },
      beforeSend: function() {
       loading.toggleClass('d-none d-flex');
      },
      success: function(response) {
       if (response.icon == 'error') {
        alertErrorRefreshPage();
       } else {
        $('.ubah-px').each(function() {
         $(this).attr('class', 'col-12 p-0 mt-2 px-' + response.newData.section.size +
          ' mb-2 div-iframe-peta-detail ubah-px body');
        });
        handleSuccess(response, action, jenis, '#modalEditUrlPeta');
       }
      },
      error: handleError,
      complete: function() {
       loading.toggleClass('d-none d-flex');
      }
     });
    }
   }

   // update map
   function updateLine(id) {
    var action = 'update';
    var jenis = 'line';
    var cekSection = $('input[name="cekSection"]').val();
    var position = $('input[name="position"]:checked').val();
    var round = $('input[name="round"]:checked').val();
    var color = $('input.linecolor[type="color"]').val(); // tag input, class linecolor
    var bold = $('input[name="bold"]').val();
    var length = $('input[name="length"]').val();
    var amount = $('input[name="amount"]').val();
    console.log('line selalu lolos validasi');
    $('#exampleModalToggleUbahLine').modal('hide');
    $.ajax({
     url: "{{ route('section.updateDetail', '') }}" + "/" + id,
     type: 'PUT',
     data: {
      _token: '{{ csrf_token() }}',
      id: id,
      cekSection: cekSection,
      position: position,
      round: round,
      color: color,
      bold: bold,
      length: length,
      amount: amount,
     },
     beforeSend: function() {
      loading.toggleClass('d-none d-flex');
      // $('.modal-backdrop').add();
     },
     success: function(response) {
      handleSuccess(response, action, jenis, '#exampleModalToggleUbahLine');
     },
     error: handleError,
     complete: function() {
      loading.toggleClass('d-none d-flex');
      $('.modal-backdrop').remove();
     }
    });
   }

   // update data hero
   function updateDataHero(id) {
    var action = 'update';
    var jenis = 'hero_edit_data';
    var cekSection = $('input[name="cekSection"]').val();
    var cekUpdate = $('input[name="cekUpdate"].ubah-data').val();
    var text_hero = $('input[name="text_hero"]').val();
    var text_button = $('input[name="text_button"]').val();
    var link_button = $('input[name="link_button"]:checked').val();

    var validationContainer = document.querySelector('.needs-validation-edit-data');
    if (!validateInputs(validationContainer, jenis)) {
     validationContainer.classList.add('was-validated');
     console.log('tidak lolos validasi');
    } else {
     validationContainer.classList.remove('was-validated');
     console.log('lolos validasi');
     $('#exampleModalToggleUbahHero').modal('hide');

     $.ajax({
      url: "{{ route('section.updateDetail', '') }}" + "/" + id,
      type: 'PUT',
      data: {
       _token: '{{ csrf_token() }}',
       id: id,
       cekSection: cekSection,
       cekUpdate: cekUpdate,
       text_hero: text_hero,
       text_button: text_button,
       link_button: link_button,
      },
      beforeSend: function() {
       loading.toggleClass('d-none d-flex');
      },
      success: function(response) {
       handleSuccess(response, action, jenis, '#exampleModalToggleUbahHero');
       //  untuk mengatasi input spasi semua, jika reload hero maka buat element baru di DOM lalu inputan terakhir tidak sama saat modal edit muuncul kembali. Jika ingin reload Hero tetapi data masih sama maka butuh penanganan lebih lanjut
       if (response.icon != 'warning') {
        reloadDataHero(id);
       }
      },
      error: handleError,
      complete: function() {
       loading.toggleClass('d-none d-flex');
      }
     });
    }
   }

   // update data ghp
   function updateDataGhp(id) {
    var action = 'update';
    var jenis = 'ghp_edit_data';
    var cekSection = $('input[name="cekSection"]').val();
    var cekUpdate = $('input[name="cekUpdate"].ubah-data').val();
    var contentGhp = $('input[name="contentGhp"]').val();

    var validationContainer = document.querySelector('.needs-validation-edit-data');
    if (!validateInputs(validationContainer, jenis)) {
     validationContainer.classList.add('was-validated');
     console.log('tidak lolos validasi');
    } else {
     validationContainer.classList.remove('was-validated');
     console.log('lolos validasi');
     $('#exampleModalToggleUbahKontenGhp').modal('hide');

     $.ajax({
      url: "{{ route('section.updateDetail', '') }}" + "/" + id,
      type: 'PUT',
      data: {
       _token: '{{ csrf_token() }}',
       id: id,
       cekSection: cekSection,
       cekUpdate: cekUpdate,
       contentGhp: contentGhp,
      },
      beforeSend: function() {
       loading.toggleClass('d-none d-flex');
      },
      success: function(response) {
       handleSuccess(response, action, jenis, '#exampleModalToggleUbahKontenGhp');
       //  untuk mengatasi input spasi semua, jika reload hero maka buat element baru di DOM lalu inputan terakhir tidak sama saat modal edit muuncul kembali. Jika ingin reload Hero tetapi data masih sama maka butuh penanganan lebih lanjut
       if (response.icon != 'warning') {
        reloadDataGhp(id);
       }
      },
      error: handleError,
      complete: function() {
       loading.toggleClass('d-none d-flex');
      }
     });
    }
   }

   //  add img slider/hero/ghp
   function addImg(id, partial) {
    var action = 'update';
    var jenis = partial + '_add_img';
    var hero = $('input[name="' + partial + '[]"]').val();
    var cekSection = $('input[name="cekSection"]').val();
    var cekUpdate = $('input[name="cekUpdate"].tambah-gambar').val();
    var tokenCsrf = "{{ csrf_token() }}";

    var validationContainer = document.querySelector('.needs-validation-add-img');
    if (!validateInputs(validationContainer, jenis)) {
     validationContainer.classList.add('was-validated');
     console.log('tidak lolos validasi');
    } else {
     validationContainer.classList.remove('was-validated');
     console.log('lolos validasi');
     console.log(tokenCsrf);
     // Membuat FormData object untuk mengumpulkan data
     var formData = new FormData();
     formData.append('_token', tokenCsrf);
     formData.append('id', id);
     formData.append('cekSection', cekSection);
     formData.append('cekUpdate', cekUpdate);

     // Menangkap file yang diunggah
     var files = $('.addImg')[0].files;
     for (var i = 0; i < files.length; i++) {
      formData.append(partial + '[]', files[i]);
     }
     // Logging FormData content
     // for (var pair of formData.entries()) {
     //  console.log(pair[0] + ':', pair[1]);
     // }

     $('.modal-tambah-img').modal('hide');

     $.ajax({
      url: "{{ route('section.updateDetailPost', '') }}" + "/" + id,
      type: 'POST',
      data: formData,
      processData: false, // Mengatur ini ke false karena kita mengirim data FormData
      contentType: false, // Mengatur ini ke false karena kita mengirim data FormData
      beforeSend: function() {
       loading.toggleClass('d-none d-flex');
       // $('.modal-backdrop').add();
      },
      success: function(response) {
       // window.location.reload();
       let modal = '';
       if (partial == 'slider') {
        modal = '#exampleModalToggleTambahSlideShow';
        reloadDataSlider(id);
       } else if (partial == 'hero') {
        modal = '#exampleModalToggleTambahHero';
        reloadDataHero(id);
       } else if (partial == 'ghp') {
        modal = '#exampleModalToggleTambahGambarGhp';
        reloadDataGhp(id);
       }
       handleSuccess(response, action, jenis, modal);

      },
      error: handleError,
      complete: function() {
       loading.toggleClass('d-none d-flex');
       $('.modal-backdrop').remove();
      }
     });
    }
   }

   //  update img slider/hero/ghp
   function updateImg(id, key, partial) {
    // console.log(id, key);

    var action = 'update';
    var jenis = partial + '_edit_img';
    var img = $('input[name="' + partial + id + '"]')[0];
    var cekSection = $('input[name="cekSection"]').val();
    var cekUpdate = $('input[name="cekUpdate"].ubah-gambar').val();
    var tokenCsrf = "{{ csrf_token() }}";

    var validationContainer = document.querySelector('.needs-validation-edit-img' + id);
    if (!validateInputs(validationContainer, jenis)) {
     validationContainer.classList.add('was-validated');
     console.log('tidak lolos validasi');
    } else {
     validationContainer.classList.remove('was-validated');
     console.log('lolos validasi');
     // Membuat FormData object untuk mengumpulkan data
     var formData = new FormData();
     formData.append('_token', tokenCsrf);
     formData.append('id', id);
     formData.append('cekSection', cekSection);
     formData.append('cekUpdate', cekUpdate);
     // Menangkap file yang diunggah
     if (img.files.length > 0) {
      formData.append(partial, img.files[0]);
     }

     //  Logging FormData content
     //  for (var pair of formData.entries()) {
     //   console.log(pair[0] + ':', pair[1]);
     //  }
     const modals = {
      slider: '.modalSlider',
      hero: '.modalHero',
      ghp: '.modalGhp'
     };
     const reloadFunctions = {
      slider: reloadDataSlider,
      hero: reloadDataHero,
      ghp: reloadDataGhp
     };

     $(modals[partial]).modal('hide');

     $.ajax({
      url: "{{ route('section.updateDetailPost', '') }}" + "/" + id,
      type: 'POST',
      data: formData,
      processData: false, // Mengatur ini ke false karena kita mengirim data FormData
      contentType: false, // Mengatur ini ke false karena kita mengirim data FormData
      beforeSend: function() {
       loading.toggleClass('d-none d-flex');
       // $('.modal-backdrop').add();
      },
      success: function(response) {
       //  console.log(response);
       // window.location.reload();
       var modal;
       if (partial in modals) {
        modal = modals[partial];
        reloadFunctions[partial](key);
       }
       handleSuccess(response, action, jenis, modal);
      },
      error: handleError,
      complete: function() {
       loading.toggleClass('d-none d-flex');
       $('.modal-backdrop').remove();
      }
     });
    }
   }

   //  delete img slide_show/hero/ghp
   function deleteImg(id, key, partial) {
    var action = 'update';
    var jenis = partial + '_delete_img';
    console.log('delete diklik = ' + id);
    Swal.fire({
     icon: 'warning',
     title: 'Hapus?',
     text: 'Apakah Anda yakin?',
     showCancelButton: true,
     cancelButtonColor: "#d33",
     confirmButtonText: 'Ya, yakin',
     cancelButtonText: "Batal",
     confirmButtonColor: "#3085d6",
     reverseButtons: true,
    }).then((result) => {
     if (result.isConfirmed) {
      console.log('hapus id = ' + id);
      $.ajax({
       url: "{{ route('section.deleteImg', '') }}" + "/" + id,
       type: 'DELETE',
       data: {
        _token: '{{ csrf_token() }}',
        partial: partial,
       },
       beforeSend: function() {
        loading.toggleClass('d-none d-flex');
       },
       success: function(response) {
        // window.location.reload();
        if (jenis == 'slide_show_delete_img') {
         reloadDataSlider(key);
        } else if (jenis == 'hero_delete_img') {
         reloadDataHero(key);
        } else if (jenis == 'ghp_delete_img') {
         reloadDataGhp(key);
        }
        handleSuccess(response, action, jenis, '');
       },
       error: handleError,
       complete: function() {
        loading.toggleClass('d-none d-flex');
       }
      });
     } else {
      console.log('gajadi id = ' + id);
     }
    });
   };


   function handleSuccess(response, action, jenis, modal) {
    console.log(response);
    // console.log(response.newData.detailSection.name);

    if (response.icon == 'success') {
     if (action == 'update' && jenis == 'tagline') {
      $('.tagline-name').html(response.newData.detailSection.name);
     } else if (action == 'update' && jenis == 'map') {
      $('.map-url').html(response.newData.detailSection.url);
     } else if (action == 'update' && jenis == 'line') {

      var positionLine = {
       'center': 'Tengah',
       'start': 'Kiri',
      };
      var roundLine = {
       1: 'Bulat',
      };

      var position = response.newData.detailSection.position;
      var realPosition = response.newData.detailSection.position;
      var round = response.newData.detailSection.round;
      var color = response.newData.detailSection.color;
      var bold = response.newData.detailSection.bold;
      var length = response.newData.detailSection.length;
      var amount = response.newData.detailSection.amount;
      var size = response.newData.section.size;
      var marginTop = response.newData.section.margin_top;
      var marginBottom = response.newData.section.margin_bottom;
      round = roundLine[round] || 'Kotak'; // kotak jika else
      position = positionLine[position] || 'Kanan'; // kanan jika else

      $('.line-position').html(position);
      $('.line-round').html(round);
      $('.line-color').val(color);
      $('.line-bold').html(bold + 'px');
      $('.line-length').html(length + '%');
      $('.line-amount').html(amount);

      // masukan data terbaru 
      $('.foreach-line').empty();
      // Tambahkan elemen baru berdasarkan jumlah terbaru
      for (var i = 0; i < amount; i++) {
       var newElement = `
        <div class="col-12 p-0 px-${size} d-flex justify-content-${realPosition} section-partials" data-margin-top="${marginTop}" data-margin-bottom="${marginBottom}">
            <div class="col-sendiri-section garis-section border-top p-0 ${round === 'Bulat' ? 'border-radius-section-line' : ''}"
                 data-width="${length}" data-color="${color}" data-border-width="${bold}">
            </div>
        </div>`;

       // Tambahkan elemen baru ke dalam modal-body
       $('.foreach-line').append(newElement);
      }
      styleLine();

     }
     $(modal).modal('hide');
     reloadDataSection(response, jenis);

    } else if (response.icon == 'warning') {
     reloadDataSection(response, jenis);
     if (jenis == 'slider_add_img' || jenis == 'hero_add_img' || jenis == 'ghp_add_img') {
      $(modal).modal('hide');
     }
     console.log('warning aksi update');
    }

    let swalConfig = {
     icon: response.icon,
     title: response.title,
     text: response.message
    };
    if (response.icon === 'success') {
     swalConfig.timer = 3000;
     swalConfig.timerProgressBar = true;
    }
    Swal.fire(swalConfig).then(() => {
     if (response.icon == 'error') {
      window.location.reload();
     } else if (response.icon == 'warning') {
      if (jenis == 'tagline' || jenis == 'map' || jenis == 'hero_edit_data' || jenis == 'ghp_edit_data') {
       $(modal).modal('show');
       //  $('.modal-backdrop').remove();
       //  $('body').append('<div class="modal-backdrop fade show custom-backdrop"></div>');
      }
     }
    });
   }

   function handleError(xhr) {
    console.error(xhr.responseText);
    Swal.fire({
     icon: 'error',
     title: 'Gagal!',
     text: 'An error occurred: ' + xhr.responseText,
    });
   }

   function reloadDataSection(response, jenis) {
    let jenisBaru = jenis.split('_')[0];
    var sizeMap = {
     'full': 'Memenuhi layar',
     'big': 'Besar',
     'medium': 'Sedang',
    };
    var activeMap = {
     1: 'Aktif',
    };
    var size = response.newData.section.size;
    var active = response.newData.section.active;
    size = sizeMap[size] || 'Kecil'; // Default else ke 'Kecil'
    active = activeMap[active] || 'Tidak Aktif'; // Default else ke 'Tidak Aktif'

    $('.section-urutan').html(response.newData.section.urutan);
    $('.section-name').html(response.newData.section.name);
    $('.section-jenis').html(response.newData.section.jenis);
    $('.section-size').html(size);
    $('.section-margin-top').html(response.newData.section.margin_top + 'px');
    $('.section-margin-bottom').html(response.newData.section.margin_bottom + 'px');
    $('.section-active').html(active);

    if (jenisBaru == 'hero') {
     var tujuanTombol = {
      '1': 'Beranda',
      '2': 'Staf',
      '3': 'Berita',
      '4': 'Galeri Gambar',
      '5': 'Galeri Video',
     };
     var tujuan = response.newData.dataHero.link_button;
     tujuan = tujuanTombol[tujuan] || 'Unduh'; // Default else ke 'unduh'
     $('.hero-text-hero').html(response.newData.dataHero.text_hero);
     $('.hero-text-button').html(response.newData.dataHero.text_button);
     $('.hero-text-link-button').html(tujuan);
    } else if (jenisBaru == 'ghp') {
     // harusnya untuk ubah data ghp, tetapi saat crud, data ghp (konten) sudah berubah aokwokowkaok

    }
   }

   function reloadDataSlider(id) {
    $.ajax({
     type: "GET",
     url: "{{ route('section.detail.slider', '') }}" + "/" + id,
     dataType: "json",
     success: function(response) {
      $('.isi-detail').html(response.data);
      console.log(response);
      // Menambahkan parameter unik ke URL gambar dengan kelas 'src-uniq-slider'
      $('img.src-uniq-slider').each(function() {
       var src = $(this).attr('src');
       var uniqValue = new Date().getTime(); // Atau gunakan nilai unik lain sesuai kebutuhan
       $(this).attr('src', src + '?uniq=' + uniqValue);
      });
     }
    });
   }

   function reloadDataHero(id) {
    $.ajax({
     type: "GET",
     url: "{{ route('section.detail.hero', '') }}" + "/" + id,
     dataType: "json",
     success: function(response) {
      $('.isi-detail').html(response.data);
      console.log(response);

      // Menambahkan parameter unik ke URL gambar dengan kelas 'src-uniq-hero'
      $('img.src-uniq-hero').each(function() {
       var src = $(this).attr('src');
       var uniqValue = new Date().getTime(); // Atau gunakan nilai unik lain sesuai kebutuhan
       $(this).attr('src', src + '?uniq=' + uniqValue);
      });
     }
    });
   }

   function reloadDataGhp(id) {
    $.ajax({
     type: "GET",
     url: "{{ route('section.detail.ghp', '') }}" + "/" + id,
     dataType: "json",
     success: function(response) {
      $('.isi-detail').html(response.data);
      console.log(response);

      // Menambahkan parameter unik ke URL gambar dengan kelas 'src-uniq-ghp'
      $('img.src-uniq-ghp').each(function() {
       var src = $(this).attr('src');
       var uniqValue = new Date().getTime(); // Atau gunakan nilai unik lain sesuai kebutuhan
       $(this).attr('src', src + '?uniq=' + uniqValue);
      });
     }
    });
   }

   function validationAddImg(event) {
    const files = event.target.files;
    const foto = $('.tambahFoto');
    var jumlahFoto = event.target.files.length;
    var sisaFoto = $('input[name="maxImg"]').val();
    // console.log(sisaFoto);
    var maxSize = 3 * 1024 * 1024; // 3 MB dalam bytes

    function hideResetAlert(msg) {
     console.log('input file salah');
     $('.modal-tambah-img').modal('hide');
     $(event.target).val('');
     foto.addClass('d-none');
     Swal.fire({
      icon: 'warning',
      title: 'Perhatian!',
      text: msg,
     }).then(() => {
      $('.modal-tambah-img').modal('show');
     });
    }

    if (files) {
     foto.html(''); // Menghapus konten sebelumnya

     for (let i = 0; i < jumlahFoto; i++) {
      const file = files[i];
      var fileType = file.type; // Tipe file
      var fileSize = file.size; // Ukuran file dalam bytes

      if (!['image/jpeg', 'image/png', 'image/jpg'].includes(fileType)) {
       hideResetAlert('File harus berupa gambar (jpeg, png, jpg).')
       return; // Keluar dari loop jika satu file tidak sesuai tipe
      } else if (fileSize > maxSize) {
       hideResetAlert('Ukuran Gambar tidak boleh lebih dari 3 MB.')
       return;
      } else if (jumlahFoto > sisaFoto) {
       hideResetAlert('Jumlah gambar melebihi batas.')
       return;
      } else {
       // sukses
       console.log('input file benar');

       const imageURL = URL.createObjectURL(file);

       const imgElement = $('<img>').addClass('hasilFoto')
        .css({
         'width': '30%',
         'padding': '5px'
        })
        .attr('src', imageURL)
        .attr('alt', 'Foto ' + (i + 1));

       foto.append(imgElement);
       foto.removeClass('d-none');
       //  endsukses
      }
     }
    } else {
     foto.addClass('d-none');
    }
   }

   function validationEditImg(event, element) {
    var itemId = $(element).data('id');

    function resetImg() {
     $(element).val('');
     $('.foto1' + itemId).attr('src', '');
     $('.tambah1Foto' + itemId).addClass('d-none');
    }

    function hideResetAlert(msg) {
     console.log('input file salah');

     $('.modal-ubah-img' + itemId).modal('hide');
     $(event.target).val('');
     $('.foto1' + itemId).addClass('d-none');
     Swal.fire({
      icon: 'warning',
      title: 'Perhatian!',
      text: msg,
     }).then(() => {
      $('.modal-ubah-img' + itemId).modal('show');
     });
    }

    var file = event.target.files[0];
    if (file) {
     var fileType = event.target.files[0].type;
     var maxSize = 3 * 1024 * 1024;
     var fileSize = event.target.files[0].size;
     if (!['image/jpeg', 'image/png', 'image/jpg'].includes(fileType)) {
      hideResetAlert('File harus berupa gambar (jpeg, png, jpg).');
     } else if (fileSize > maxSize) {
      hideResetAlert('Ukuran Gambar tidak boleh lebih dari 3 MB.');
     } else {
      console.log('input file benar');
      var imageURL = URL.createObjectURL(file);
      $('.foto1' + itemId).attr('src', imageURL);
      $('.tambah1Foto' + itemId).removeClass('d-none');
      $('.foto1' + itemId).removeClass('d-none');
     }

    } else {
     resetImg();
    }
   }

   // script tempel input link peta
   $(document).on('click', '.tempelUrl', function() {
    $('.input-edit-map').val('');
    $('.input-edit-map').focus();
    navigator.clipboard.readText().then(function(text) {
     $('.input-edit-map').val(text);
    }).catch(function(err) {
     console.error('Gagal membaca teks dari clipboard: ', err);
    });
   });

   // script pratinju di detail line.blade dan tombol-tombolnya
   function styleLine() {
    $('.garis-section').each(function() {
     $(this).css({
      'width': $(this).data('width') + "%",
      // 'border-width': $(this).data('borderWidth') + "px",
      '--border-color': $(this).data('color')
     });
     // Mengatur border-width dengan !important
     this.style.setProperty('border-width', $(this).data('borderWidth') + "px", 'important');
     console.log('masuk for each garis section');
    });

    // Mengatur margin atas dan bawah setiap elemen section-partials
    $('.section-partials').each(function() {
     $(this).css({
      'margin-top': $(this).data('marginTop') + "px",
      'margin-bottom': $(this).data('marginBottom') + "px"
     });
     console.log('masuk for each section partials');
    });
   }

   styleLine();

   $('#inputJumlahGaris').on('input', function() {
    $('#hasilInputJumlahGaris').text($(this).val());
   });

   $('#inputLebarGaris').on('input', function() {
    $('#hasilInputLebarGaris').text($(this).val() + "%");
   });

   $('#inputTebalGaris').on('input', function() {
    $('#hasilInputTebalGaris').text($(this).val() + "px");
   });

   $('#plusJumlahGaris').on('click', function() {
    var value = parseInt($('#inputJumlahGaris').val()) + 1;
    $('#inputJumlahGaris').val(value);
    $('#hasilInputJumlahGaris').text(value);
   });

   $('#minusJumlahGaris').on('click', function() {
    var value = parseInt($('#inputJumlahGaris').val()) - 1;
    $('#inputJumlahGaris').val(value);
    $('#hasilInputJumlahGaris').text(value);
   });

   $('#plusLebarGaris').on('click', function() {
    var value = parseInt($('#inputLebarGaris').val()) + 1;
    $('#inputLebarGaris').val(value);
    $('#hasilInputLebarGaris').text(value + "%");
   });

   $('#minusLebarGaris').on('click', function() {
    var value = parseInt($('#inputLebarGaris').val()) - 1;
    $('#inputLebarGaris').val(value);
    $('#hasilInputLebarGaris').text(value + "%");
   });

   $('#plusTebalGaris').on('click', function() {
    var value = parseInt($('#inputTebalGaris').val()) + 1;
    $('#inputTebalGaris').val(value);
    $('#hasilInputTebalGaris').text(value + "px");
   });

   $('#minusTebalGaris').on('click', function() {
    var value = parseInt($('#inputTebalGaris').val()) - 1;
    $('#inputTebalGaris').val(value);
    $('#hasilInputTebalGaris').text(value + "px");
   });
   // end detail line.blade dan tombol-tombolnya

  });
 </script>

@endsection
