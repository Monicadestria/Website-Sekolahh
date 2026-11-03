<div class="col-12 p-2 px-1">
 <div class="row justify-content-center">
  {{-- gambar --}}
  <div class="col-12 mb-2">
   <div class="row d-flex justify-content-around px-2">
    <div class="row m-0 p-0 px-1 justify-content-around">
     @foreach ($detailSection as $i => $item)
      <div class="card shadow align-items-center {{ $lebarImg }} p-0">
       <img src="{{ asset("storage/section/ghp/$item->file") }}" class="card border-0 w-100 h-200px src-uniq-ghp"
        alt="{{ $item->file }}">
       <div class="card-img-overlay p-0 d-flex flex-column">
        <div class="py-0 px-1 fs-6">
         <span class="badge rounded-pill text-bg-secondary">{{ ++$i }}</span>
        </div>
        <div class="text-end p-1 mt-auto">
         <button type="button" class="btn btn-sm btn-info p-0 rounded-pill" data-bs-toggle="modal"
          data-bs-target="#modalTogglelihatFotoGhp{{ $i }}">
          <span class="badge"><i class="bi bi-zoom-in"></i></span>
         </button>
         <button type="button" class="btn btn-sm btn-warning p-0 rounded-pill btn-modal-edit-img-ghp"
          {{-- data-bs-toggle="modal" data-bs-target="#modalToggleubahFotoGhp{{ $i }}" --}} data-key="{{ $i }}" data-id="{{ $item->id }}">
          <span class="badge"><i class="bi bi-pencil"></i></span>
         </button>
         <button class="btn btn-sm btn-danger p-0 rounded-pill btn-delete-ghp" data-id="{{ $item->id }}"
          data-key="{{ $section->id }}">
          <span class="badge"><i class="bi bi-trash"></i></span>
         </button>
         <a href="{{ asset("storage/section/ghp/$item->file") }}" download="{{ $item->file }}">
          <button type="button" class="btn btn-sm btn-success p-0 rounded-pill">
           <span class="badge"><i class="bi bi-floppy"></i></span>
          </button>
         </a>
        </div>
       </div>
      </div>
      {{-- modal lihat gambar --}}
      <div class="modal fade" id="modalTogglelihatFotoGhp{{ $i }}" aria-hidden="true"
       aria-labelledby="lihatFotoGhp{{ $i }}" tabindex="-1">
       <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen p-5 h-auto">
        <div class="modal-content">
         <div class="modal-header">
          <h1 class="modal-title fs-5" id="lihatFotoGhp{{ $i }}">
           <span class="text-black">Gambar GHP</span>
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body d-flex justify-content-center align-items-center">
          <img src="{{ asset("storage/section/ghp/$item->file") }}" class="src-uniq-ghp" alt="{{ $item->file }}">
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
         </div>
        </div>
       </div>
      </div>
      {{-- modal ubah gambar --}}
      <div class="modal fade modalGhp modal-ubah-img{{ $item->id }}"
       id="modalToggleubahFotoGhp{{ $i }}" aria-hidden="true"
       aria-labelledby="ubahFotoGhp{{ $i }}" tabindex="-1">
       <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg h-auto">
        <div class="modal-content needs-validation-edit-img{{ $item->id }}">
         <input type="hidden" value="ghp" name="cekSection">
         <input type="hidden" value="ubah_gambar" name="cekUpdate" class="ubah-gambar">
         <div class="modal-header">
          <h1 class="modal-title fs-5" id="ubahFotoGhp{{ $i }}">
           <span class="text-black">Ubah Gambar GHP</span>
          </h1>
          <button type="button" class="btn-close btn-close-update" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body d-flex justify-content-center align-items-center">
          <div class="col">
           <div class="form-group mt-3 row">
            <div class="col-12">
             <input type="file" name="ghp{{ $item->id }}" data-id="{{ $item->id }}"
              class="form-control cursor-pointer input-ubah-img" accept=".jpg,.jpeg,.png" required>
             <div class="invalid-feedback">
              Perlu di isi
             </div>
            </div>
           </div>
           <div class="form-group mt-3 row">
            <div class="col-12">
             <div class="tambah1Foto{{ $item->id }} text-center d-none">
              <img src="" class="foto1{{ $item->id }}" alt="..." width="300px">
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-close-update" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary btn-ubah-img-ghp" data-id="{{ $item->id }}"
           data-key="{{ $section->id }}">Ubah</button>
         </div>
        </div>
       </div>
      </div>
      {{-- script ubah gambar ada di detail --}}
     @endforeach
    </div>
   </div>
  </div>
  {{-- konten --}}
  <div class="col-12 p-0 px-2 mt-2">
   <div class="row px-3 mb-2">
    <div class="col-12 p-2 px-3 card shadow mb-2 section-content-trix section-content-trix-black text-break">
     {!! $dataGhp->content !!}
    </div>
   </div>
  </div>
 </div>
</div>

{{-- Tampilan Landing Page --}}
<div class="col-12 p-2 px-1 mb-2">
 <div class="shadow card border">
  <div class="p2 px-3 mb-2 mt-2">
   <h5 class="text-black">Tampilan Beranda</h5>
  </div>
  <div class="row ps-4">
   <div class="row px-{{ $section->size }} body mb-3">
    <div class="col-md-3 col-12 d-flex justify-content-center align-items-center text-center">
     <div class="row">
      @foreach ($detailSection as $item)
       <div class="col-12">
        <img src="{{ asset("storage/section/ghp/$item->file") }}" alt="{{ $item->file }}"
         class="section-gambaratasbawah-ghp my-2 src-uniq-ghp"
         data-margin-right="{{ $section->size == 'small' ? 'me-3' : 'kalau-null-error' }}">
       </div>
      @endforeach
     </div>
    </div>
    <div class="col-md-9 col-12 d-flex justify-content-center align-items-center text-break section-ghp-content-trix"
     data-padding-right="{{ $section->size == 'full' ? 'pe-5' : 'kalau-null-error' }}"
     data-padding-left="{{ $section->size == 'small' ? 'ps-3' : 'ps-0' }}">
     <div class="row m-0 p-0">
      <div class="section-content-trix mb-2 p">
       {!! $dataGhp->content !!}
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>

{{-- modal Ubah Kontent Ghp --}}
<div class="modal fade" id="exampleModalToggleUbahKontenGhp"
 aria-hidden="true"aria-labelledby="exampleModalToggleLabelUbahKontenGhp" tabindex="-1">
 <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen p-3 p-sm-5 h-auto">
  <div class="modal-content needs-validation-edit-data">
   <input type="hidden" value="ghp" name="cekSection">
   <input type="hidden" value="ubah_data" name="cekUpdate" class="ubah-data">
   <div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalToggleLabelUbahKontenGhp">
     <span class="text-black">Ubah Konten GHP</span>
    </h1>
    <button type="button" class="btn-close btn-close-update" data-bs-dismiss="modal" aria-label="Close"></button>
   </div>
   <div class="modal-body d-flex justify-content-center align-items-center">
    <div class="col">
     <div class="form-group mt-3 row">
      <div class="col-12 div-section-trix">
       <input id="paragraf" type="hidden" name="contentGhp" value="{{ old('contentGhp', $dataGhp->content) }}"
        class="input-edit-konten-ghp">
       <trix-editor id="trixGhp" input="paragraf" class="form-control text-break"></trix-editor>
      </div>
     </div>
    </div>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-danger btn-close-update" data-bs-dismiss="modal">Batal</button>
    <button type="button" class="btn btn-primary btn-ubah-data-ghp" data-id="{{ $section->id }}">Ubah</button>
   </div>
  </div>
 </div>
</div>

{{-- modal tambah gambar Gambar Ghp --}}
<div class="modal fade modal-tambah-img" id="exampleModalToggleTambahGambarGhp"
 aria-hidden="true"aria-labelledby="exampleModalToggleLabelTambahGambarGhp" tabindex="-1">
 <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg h-auto">
  <div class="modal-content needs-validation-add-img">
   <input type="hidden" value="ghp" name="cekSection">
   <input type="hidden" value="tambah_gambar" name="cekUpdate" class="tambah-gambar">
   <div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalToggleLabelTambahGambarGhp">
     <span class="text-black">Tambah Gambar GHP</span>
    </h1>
    <button type="button" class="btn-close btn-close-update" data-bs-dismiss="modal" aria-label="Close"></button>
   </div>
   <div class="modal-body d-flex justify-content-center align-items-center">
    <div class="col">
     <div class="form-group mt-3 row">
      <div class="col-12">
       <input type="file" name="ghp[]" id="inputFotoGhp" class="form-control cursor-pointer addImg"
        accept=".jpg,.jpeg,.png" required multiple>
       <div class="invalid-feedback">
        Perlu di isi
       </div>
      </div>
     </div>
     <div class="form-group mt-3 row">
      <div class="col-12">
       <div class="tambahFotoGhp d-none text-center tambahFoto">
       </div>
      </div>
     </div>
    </div>
   </div>
   <div class="modal-footer">
    <input type="hidden" name="maxImg" value="{{ $maxImg }}" class="maxImg">
    <button type="button" class="btn btn-danger btn-close-update" data-bs-dismiss="modal">Batal</button>
    <button type="button" class="btn btn-primary btn-tambah-img-ghp" data-id="{{ $section->id }}">Simpan</button>
   </div>
  </div>
 </div>
</div>

{{-- script tambah gambar ada di detail.blade --}}

<script>
 /////////////////////////////
 //     script trix ghp     //
 /////////////////////////////
 $(document).ready(function() {
  $('#trixGhp').on('trix-file-accept', function(event) {
   event.preventDefault(); // Membatalkan penerimaan file

   // Fungsi untuk menunggu sejumlah milidetik
   function delay(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
   }

   // Fungsi asinkron untuk menyembunyikan modal, menunggu, dan menampilkan SweetAlert
   async function hideModalAndShowAlert() {
    // Menutup modal
    $('#exampleModalToggleUbahKontenGhp').modal('hide');

    // Menunggu 100 milidetik
    await delay(100);

    // Menampilkan SweetAlert
    Swal.fire({
     icon: 'warning',
     title: 'Perhatian!',
     text: 'Tidak bisa menyisipkan file.',
    }).then((result) => {
     // Setelah SweetAlert selesai, tampilkan kembali modal
     $('#exampleModalToggleUbahKontenGhp').modal('show');
    });
   }

   // Panggil fungsi asinkron
   hideModalAndShowAlert();
  });

  //////////////////////////////////////////////////////////////
  //  script waktu size full dan size small biar tidak mepet  //
  //////////////////////////////////////////////////////////////
  $('.section-content-trix').each(function() {
   $(this).addClass($(this).data('paddingLeft'));
   const firstElement = $(this).children().first();
   console.log(firstElement.prop('tagName'));

   // Periksa apakah elemen pertama adalah <h1>
   if (firstElement.prop('tagName').toLowerCase() === 'h1') {
    firstElement.css('marginTop', '3px');
    console.log('h1 di awal ' + firstElement.css('marginTop'));
   } else {
    firstElement.css('marginTop', '19px');
    console.log('h1 tidak di awal ' + firstElement.css('marginTop'));
   }
  });

  function layarMd768Px() {
   $('.section-ghp-content-trix').each(function() {
    $(this).addClass($(this).data('paddingRight'));
    $(this).removeClass("text-center");
   });

   $('.section-gambaratasbawah-ghp').each(function() {
    $(this).addClass($(this).data('marginRight'));
   });

   $('.section-ghp-content-trix ul li, .section-ghp-content-trix ol li').each(function() {
    $(this).removeClass('text-start');
   });
  }

  function layarKurang768Px() {
   $('.section-ghp-content-trix').each(function() {
    $(this).removeClass($(this).data('paddingRight'));
    $(this).addClass("text-center");
   });

   $('.section-gambaratasbawah-ghp').each(function() {
    $(this).removeClass($(this).data('marginRight'));
   });

   $('.section-ghp-content-trix ul li, .section-ghp-content-trix ol li').each(function() {
    $(this).addClass('text-start');
   });
  }

  // col-md
  if ($(window).width() >= 768) {
   layarMd768Px();
  } else {
   layarKurang768Px();
  }

  // Event listener untuk mengeksekusi kode saat ukuran layar berubah
  $(window).on('resize', function() {
   if ($(window).width() >= 768) {
    layarMd768Px();
   } else {
    layarKurang768Px();
   }
  });
 });
</script>
