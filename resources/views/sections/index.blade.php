@extends('partials.main')

@section('content')
 <!-- style pratinjau -->
 @php
  $theme = App\Models\Theme::where('status', true)->first();
  // dd($theme);
 @endphp
 <link rel="stylesheet" href="{{ asset('css/style-section-user.css') }}">
 {{-- <link rel="stylesheet" href="{{ asset('assets/themes/' . (isset($theme->id) ? $theme->id : 'default') . '.css') }}"> --}}
 <!-- header -->
 <div class="content-header">
  <div class="row mt-3">
   <div class="col">
    <h4 class="m-0 ms-3">
     <span class="text-bawah-burger-menu">Section</span>
    </h4>
   </div>
   <div class="col-auto d-flex justify-content-end pe-4">
    <ol class="breadcrumb d-flex">
     <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
     <li class="breadcrumb-item active">Section</li>
    </ol>
   </div>
  </div>
 </div>

 <!-- bawah header -->

 <div class="row mt-0">
  <div class="col-12 p-2 px-3 pt-0">

   <div class="card bg-light mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
     <h5 class="card-title m-0 text-black">
      {{ $head }}
     </h5>
     <span class="d-flex">
      <button class="btn btn-warning text-white mx-2 btn-pratinjau-section" {{-- data-bs-toggle="modal" data-bs-target="#pratinjauModalLandingHomeEndUser" --}}>
       Pratinjau Tampilan
      </button>
      <a href="{{ route('section.create') }}" class="btn btn-primary">
       Tambah Section</a>
     </span>
    </div>
    <div class="table-responsive card-body shadow px-2 mt-0 pt-0" id="tabelSection">
     <table class="table table-striped table-bordered m-auto p-auto mt-0 pt-0" id="tableSection">
      <thead class="text-center">
       {{-- <tr class="align-items-start">
        <th rowspan="2" class="m-0 p-0 ps-2 pe-3 py-4 text-start align-items-center">No</th>
        <th rowspan="2" class="m-0 p-0 px-2 py-4 text-start">Nama</th>
        <th rowspan="2" class="m-0 p-0 px-2 py-4 text-start">Jenis</th>
        <th colspan="3" class="m-0 p-0 px-2 py-1 text-center">Aksi</th>
       </tr>
       <tr class="align-items-center">
        <th class="m-0 p-0 px-4 py-1 text-center" width="0">Urutan</th>
        <th class="m-0 p-0 px-4 py-1 text-center" width="0">Status</th>
        <th class="m-0 p-0 px-5 py-1 text-center" width="0">Fungsi</th>
       </tr> --}}

       {{--  --}}
       <th class="m-0 p-0 ps-2 pe-3 py-2 text-start th-no" width="60">No</th>
       <th class="m-0 p-0 px-2 py-2 text-start ">Nama</th>
       <th class="m-0 p-0 px-2 py-2 text-start th-jenis-section" width="80">Jenis</th>
       <th class="m-0 p-0 px-2 py-2 text-start th-status-aktif" width="90">Status</th>
       <th class="m-0 p-0 px-2 py-2 text-center" width="140">Aksi</th>
      </thead>
      <tbody>
       @php
        $noFirst = 0;
       @endphp
       @foreach ($section as $key => $item)
        <tr>
         <td class="text-start">{{ ++$noFirst }}</td>
         <td class="text-full-display">
          {{ $item->name }}
         </td>
         <td class="text-full-display">
          {{ $item->jenis }}
         </td>
         <td class="text-full-display">
          {{ $item->active ? 'Aktif' : 'Tidak Aktif' }}
         </td>

         {{-- <!-- posisi -->
         <td class="text-center">
          <div class="row m-0 p-0 d-flex justify-content-center align-items-center">
           <!-- Jika item bukan yang pertama -->
           @if ($noFirst != 1)
            <div class="col-md-6 col-12 p-0 m-0">
             <button type="button" class="btn btn-sm btn-secondary posisinaik btn-naik-section"
              data-id="{{ $item->id }}" data-key="{{ $key }}">
              <i class="bi bi-arrow-up"></i>
             </button>
            </div>
           @endif
           <!-- Jika item bukan yang terakhir -->
           @if ($noFirst != count($section))
            <div class="col-md-6 col-12 p-0 m-0">
             <button type="button" class="btn btn-sm btn-secondary posisiturun btn-turun-section"
              data-id="{{ $item->id }}" data-key="{{ $key }}">
              <i class="bi bi-arrow-down"></i>
             </button>
            </div>
           @endif
          </div>
         </td>

         <!-- status (Active) -->
         <td class="text-center">
          <button type="button" name="active" data-id="{{ $item->id }}" data-key="{{ $key }}"
           class="btn fw-bold m-0 btn-active-section btn-sm btn-{{ $item->active ? 'success' : 'danger' }}">{{ $item->active ? 'On' : 'Off' }}</button>
         </td> --}}

         <!-- aksi -->
         <td class="text-center aksi-3">
          <div class="row m-0 d-flex justify-content-center align-items-center p-0">
           <!-- detail -->
           <div class="col-4 p-0 m-0">
            <a href="{{ route('section.detail', ['id' => $item->id]) }}" type="button">
             <span class="btn btn-sm btn-primary text-white m-0"><i class="bi bi-eye-fill"></i></span>
            </a>
           </div>
           <!-- edit -->
           <div class="col-4 p-0 m-0">
            {{-- data-bs-toggle="modal" data-bs-target="#modalEditSection{{ $key }}" --}}
            <a><span class="btn btn-sm btn-warning text-white m-0 btn-modal-edit" data-id="{{ $item->id }}"
              data-key="{{ $key }}"><i class="bi bi-pencil-fill"></i></span></a>
           </div>
           <div class="modal fade" id="modalEditSection{{ $key }}" tabindex="-1"
            aria-labelledby="modalEditSectionLabel{{ $key }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl h-auto">
             <div class="modal-content">
              <div class="modal-header">
               <h5 class="modal-title" id="modalEditSectionLabel{{ $key }}">
                <span class="text-black">
                 Ubah Data Section
                </span>
               </h5>
               <button type="button" class="me-2 btn-close btn-close-update" data-bs-dismiss="modal"
                aria-label="Close"></button>
              </div>
              <div class="modal-body p-0 text-start" id="tampilTabel">
               @include('sections.edit')
              </div>
              <div class="modal-footer">
               <button type="button" class="me-3 btn btn-danger mx-2 btn-close-update"
                data-bs-dismiss="modal">Batal</button>
               <button type="button" class="btn btn-primary m-0 btn-update-section" data-id="{{ $item->id }}"
                data-key="{{ $key }}" id="btnSimpan{{ $key }}">Ubah</button>
              </div>
             </div>
            </div>
           </div>
           <!-- hapus -->
           <div class="col-4 p-0 m-0">
            <button class="btn btn-sm btn-danger btn-delete-section text-white m-0" type="button"
             data-id="{{ $item->id }}" data-key="{{ $key }}">
             <i class="bi bi-trash-fill"></i>
            </button>
           </div>
          </div>
         </td>
        </tr>
        <!-- script edit data ikon pensil ada di bawah-->
       @endforeach
      </tbody>
     </table>
    </div>
   </div>
  </div>
 </div>

 <!-- modal pratinjau tampilansection -->
 <div class="modal fade" id="pratinjauModalLandingHomeEndUser" tabindex="-1"
  aria-labelledby="pratinjauModalLandingHomeEndUserLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen h-auto">
   <div class="modal-content">
    <div class="modal-header">
     <h5 class="modal-title" id="pratinjauModalLandingHomeEndUserLabel">
      <span class="text-black">
       Pratinjau Tampilan Beranda
      </span>
     </h5>
     <button type="button" class="me-2 btn-close btn-close-pratinjau" data-bs-dismiss="modal"
      aria-label="Close"></button>
    </div>
    <div class="modal-body p-0 body modal-body-pratinjau">
     @foreach ($pratinjau as $no => $section)
      @includeIf("sections.partials.$section->partial", ['data' => $section, 'no' => $no])
     @endforeach
    </div>
    <div class="modal-footer">
     <button type="button" class="me-3 btn btn-secondary btn-close-pratinjau" data-bs-dismiss="modal">Tutup</button>
    </div>
   </div>
  </div>
 </div>
 <!-- script pratinjau di js/script-section.js sudah masuk di preview.blade -->
 <script>
  $(document).ready(function() {

   ////////////////////////////////
   //   script modal ubah data   //
   /////        urutan        /////
   $(document).on('input', '[id^=inputUrutan]', function() {
    var key = $(this).data('key');
    $('#hasilInputUrutan' + key).text($(this).val());
   });

   $(document).on('click', '[id^=plusUrutan]', function() {
    var key = $(this).attr('id').replace('plusUrutan', '');
    var input = $('#inputUrutan' + key);
    input.val(parseInt(input.val()) + 1);
    $('#hasilInputUrutan' + key).text(input.val());
   });

   $(document).on('click', '[id^=minusUrutan]', function() {
    var key = $(this).attr('id').replace('minusUrutan', '');
    var input = $('#inputUrutan' + key);
    input.val(parseInt(input.val()) - 1);
    $('#hasilInputUrutan' + key).text(input.val());
   });

   /////      margin top      /////
   $(document).on('input', '[id^=inputMarginTop]', function() {
    var key = $(this).data('key');
    $('#hasilInputMarginTop' + key).text($(this).val() + "px");
   });

   $(document).on('click', '[id^=plusMarginTop]', function() {
    var key = $(this).attr('id').replace('plusMarginTop', '');
    var input = $('#inputMarginTop' + key);
    input.val(parseInt(input.val()) + 1);
    $('#hasilInputMarginTop' + key).text(input.val() + "px");
   });

   $(document).on('click', '[id^=minusMarginTop]', function() {
    var key = $(this).attr('id').replace('minusMarginTop', '');
    var input = $('#inputMarginTop' + key);
    input.val(parseInt(input.val()) - 1);
    $('#hasilInputMarginTop' + key).text(input.val() + "px");
   });

   /////    margin bottom    /////
   $(document).on('input', '[id^=inputMarginBottom]', function() {
    var key = $(this).data('key');
    $('#hasilInputMarginBottom' + key).text($(this).val() + "px");
   });

   $(document).on('click', '[id^=plusMarginBottom]', function() {
    var key = $(this).attr('id').replace('plusMarginBottom', '');
    var input = $('#inputMarginBottom' + key);
    input.val(parseInt(input.val()) + 1);
    $('#hasilInputMarginBottom' + key).text(input.val() + "px");
   });

   $(document).on('click', '[id^=minusMarginBottom]', function() {
    var key = $(this).attr('id').replace('minusMarginBottom', '');
    var input = $('#inputMarginBottom' + key);
    input.val(parseInt(input.val()) - 1);
    $('#hasilInputMarginBottom' + key).text(input.val() + "px");
   });


   ///////////////////////
   //    script crud    //
   const loading = $('#loading');

   // naik
   $(document).on('click', '.btn-naik-section', function() {
    var action = 'naik';
    var id = $(this).data('id');
    var key = $(this).data('key');
    console.log('naik id = ' + id);
    $.ajax({
     url: "{{ route('section.naik', '') }}" + "/" + id,
     type: 'PUT',
     data: {
      _token: '{{ csrf_token() }}',
     },
     beforeSend: function() {
      loading.toggleClass('d-none d-flex');
     },
     success: function(response) {
      handleSuccess(response, action, key);
     },
     error: handleError,
     complete: function() {
      loading.toggleClass('d-none d-flex');
     }
    });
   });

   // turun
   $(document).on('click', '.btn-turun-section', function() {
    var action = 'turun';
    var id = $(this).data('id');
    var key = $(this).data('key');
    console.log('turun id = ' + id);
    $.ajax({
     url: "{{ route('section.turun', '') }}" + "/" + id,
     type: 'PUT',
     data: {
      _token: '{{ csrf_token() }}',
     },
     beforeSend: function() {
      loading.toggleClass('d-none d-flex');
     },
     success: function(response) {
      handleSuccess(response, action, key);
     },
     error: handleError,
     complete: function() {
      loading.toggleClass('d-none d-flex');
     }
    });
   });

   // active
   $(document).on('click', '.btn-active-section', function() {
    var action = 'active';
    var id = $(this).data('id');
    var key = $(this).data('key');
    console.log('active id = ' + id);
    $.ajax({
     url: "{{ route('section.active', '') }}" + "/" + id,
     type: 'PUT',
     data: {
      _token: '{{ csrf_token() }}',
     },
     beforeSend: function() {
      loading.toggleClass('d-none d-flex');
     },
     success: function(response) {
      handleSuccess(response, action, key);
     },
     error: handleError,
     complete: function() {
      loading.toggleClass('d-none d-flex');
     }
    });
   });

   $(document).on('click', '.btn-pratinjau-section', function() {
    reloadPratinjau();
   });

   //  show modal edit
   $(document).on('click', '.btn-modal-edit', function() {
    var key = $(this).data('key');
    var id = $(this).data('id');
    $('#modalEditSection' + key).modal('show');
    $('.modal-backdrop').remove();
    $('body').append('<div class="modal-backdrop fade show custom-backdrop"></div>');
    console.log('masuk form edit key', key, 'dan id', id);
   });

   //  validasi
   'use strict';

   function validateInputs(container) {
    const inputs = container.querySelectorAll('input');
    let isValid = true;
    inputs.forEach(input => {
     if (!input.checkValidity()) {
      isValid = false;
     }
    });
    return isValid;
   }

   //  tombol update
   $(document).on('click', '.btn-update-section', function() {
    updateSection($(this).data('id'), $(this).data('key'));
   });

   //  hanya input dengan kelas input-edit-section.
   $(document).on('keypress', 'input.input-edit-section', function(event) {
    if (event.which == 13) { // 13 adalah kode ASCII untuk Enter
     updateSection($(this).data('id'), $(this).data('key'));
     event.preventDefault();
    }
   });

   // update
   function updateSection(id, key) {
    var action = 'update';
    var jenis = $('input[name="jenis' + key + '"]:checked').val();
    var name = $('input[name="name' + key + '"]').val();
    var size = $('input[name="size' + key + '"]:checked').val();
    var urutan = $('input[name="urutan' + key + '"]').val();
    var margin_top = $('input[name="margin_top' + key + '"]').val();
    var margin_bottom = $('input[name="margin_bottom' + key + '"]').val();
    var active = $('input[name="active' + key + '"]:checked').val();
    var validationContainer = document.querySelector('.needs-validation' + key);
    console.log(id, key);
    if (!validateInputs(validationContainer)) {
     validationContainer.classList.add('was-validated');
     console.log('tidak lolos validasi');
    } else {
     validationContainer.classList.remove('was-validated');
     console.log('lolos validasi');
     $('#modalEditSection' + key).modal('hide');

     $.ajax({
      url: "{{ route('section.update', '') }}" + "/" + id,
      type: 'PUT',
      data: {
       _token: '{{ csrf_token() }}',
       id: id,
       name: name,
       jenis: jenis,
       size: size,
       urutan: urutan,
       margin_top: margin_top,
       margin_bottom: margin_bottom,
       active: active
      },
      beforeSend: function() {
       loading.toggleClass('d-none d-flex');
       // $('.modal-backdrop').add();
      },
      success: function(response) {
       handleSuccess(response, action, key);
      },
      error: handleError,
      complete: function() {
       loading.toggleClass('d-none d-flex');
       $('.modal-backdrop').remove();
      }
     });
    }
   }

   // hapus
   $(document).on('click', '.btn-delete-section', function() {
    var action = 'delete';
    var id = $(this).data('id');
    var key = $(this).data('key');
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
       url: "{{ route('section.delete', '') }}" + "/" + id,
       type: 'DELETE',
       data: {
        _token: '{{ csrf_token() }}',
       },
       beforeSend: function() {
        loading.toggleClass('d-none d-flex');
       },
       success: function(response) {
        handleSuccess(response, action, key);
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
   });

   function handleSuccess(response, action, key) {
    // console.log(response);
    let swalConfig = {
     icon: response.icon,
     title: response.title,
     text: response.message
    };
    if (response.icon == 'success') {
     if ($.fn.DataTable.isDataTable('#tableSection')) {
      $('#tableSection').DataTable().destroy();
     }
     reloadSection();
     if (action == 'update') {
      $('#modalEditSection' + key).modal('hide');
      console.log('sukses / delete, aksi update, wait modal hide');
     }
    }
    if (response.icon === 'success') {
     swalConfig.timer = 3000;
     swalConfig.timerProgressBar = true;
    }
    Swal.fire(swalConfig).then(() => {
     if (response.icon == 'error') {
      window.location.reload();
     } else if (response.icon == 'warning') {
      if (action == 'update') {
       $('#modalEditSection' + key).modal('show');
       //  $('body').append('<div class="modal-backdrop fade show custom-backdrop"></div>');
       console.log('warning aksi update');
      } else {
       reloadSection();
      }
     }
    });
   }

   $(document).on('click', '.btn-close-update', function() {
    $('.custom-backdrop').remove();
   });
   $(document).on('click', '.btn-close-pratinjau', function() {
    $('.custom-backdrop').remove();
   });
   $(document).on('click', '.custom-backdrop', function() {
    $('.custom-backdrop').remove();
   });
   $(document).on('hidden.bs.modal', '.modal', function() {
    $('.custom-backdrop').remove();
   });

   function handleError(xhr) {
    console.error(xhr.responseText);
    Swal.fire({
     icon: 'error',
     title: 'Gagal!',
     text: 'An error occurred: ' + xhr.responseText,
    });
   }

   function reloadSection() {
    $.ajax({
     type: "GET",
     url: "{{ route('section.table') }}",
     dataType: "json",
     success: function(response) {
      $('#tabelSection').html(response.data);
      $('#tableSection').DataTable({
       "columnDefs": [{
        "targets": [0, 4],
        "searchable": false
       }]
      });
     }
    });
   }

   function reloadPratinjau() {
    $.ajax({
     type: "GET",
     url: "{{ route('pratinjau.data') }}",
     dataType: "json",
     success: function(response) {
      $('.modal-body-pratinjau').html('');
      $('#pratinjauModalLandingHomeEndUser').modal('show');
      $('.modal-backdrop').remove();
      $('body').append('<div class="modal-backdrop fade show custom-backdrop"></div>');
      $('.modal-body-pratinjau').html(response.data);
     },
     error: function(xhr) {
      console.log('Error:', xhr.responseText);
     }
    });
   }

  });
 </script>
@endsection
