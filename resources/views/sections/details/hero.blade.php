<div class="col-12 p-2 px-1">
 <div class="row d-flex justify-content-center px-2">
  <div class="row m-0 p-0 px-1 justify-content-around">
   @foreach ($detailSection as $i => $item)

   {{-- gambar hero --}}
    <div class="card shadow align-items-center {{ $lebarImg }} px-0">
     <img src="{{ asset("storage/section/hero/$item->file") }}" class="card border-0 w-100 h-200px src-uniq-hero"
      alt="{{ $item->file }}">
     <div class="card-img-overlay p-0 d-flex flex-column">
      <div class="py-0 px-1 fs-6">
       <span class="badge rounded-pill text-bg-secondary">{{ ++$i }}</span>
      </div>
      <div class="text-end p-1 mt-auto">
       <button type="button" class="btn btn-sm btn-info p-0 rounded-pill" data-bs-toggle="modal"
        data-bs-target="#modalTogglelihatFotoHero{{ $i }}">
        <span class="badge"><i class="bi bi-zoom-in"></i></span>
       </button>
       <button type="button" class="btn btn-sm btn-warning p-0 rounded-pill btn-modal-edit-img-hero"
        data-key="{{ $i }}" data-id="{{ $item->id }}">
        <span class="badge"><i class="bi bi-pencil"></i></span>
       </button>
       <button class="btn btn-sm btn-danger p-0 rounded-pill btn-delete-hero" data-id="{{ $item->id }}"
        data-key="{{ $section->id }}">
        <span class="badge"><i class="bi bi-trash"></i></span>
       </button>
       <a href="{{ asset("storage/section/hero/$item->file") }}" download="{{ $item->file }}">
        <button type="button" class="btn btn-sm btn-success p-0 rounded-pill">
         <span class="badge"><i class="bi bi-floppy"></i></span>
        </button>
       </a>
      </div>
     </div>
    </div>

    {{-- modal lihat gambar --}}
    <div class="modal fade" id="modalTogglelihatFotoHero{{ $i }}" aria-hidden="true"
     aria-labelledby="lihatFotoHero{{ $i }}" tabindex="-1">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen p-5 h-auto">
      <div class="modal-content">
       <div class="modal-header">
        <h1 class="modal-title fs-5" id="lihatFotoHero{{ $i }}">
         <span class="text-black">Gambar Hero</span>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body d-flex justify-content-center align-items-center">
        <img src="{{ asset("storage/section/hero/$item->file") }}" class="src-uniq-hero" alt="{{ $item->file }}">
       </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
       </div>
      </div>
     </div>
    </div>

    {{-- modal ubah gambar --}}
    <div class="modal fade modalHero modal-ubah-img{{ $item->id }}"
     id="modalToggleubahFotoHero{{ $i }}" aria-hidden="true"
     aria-labelledby="ubahFotoHero{{ $i }}" tabindex="-1">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg h-auto">
      <div class="modal-content needs-validation-edit-img{{ $item->id }}">
       <input type="hidden" value="hero" name="cekSection">
       <input type="hidden" value="ubah_gambar" name="cekUpdate" class="ubah-gambar">
       <div class="modal-header">
        <h1 class="modal-title fs-5" id="ubahFotoHero{{ $i }}">
         <span class="text-black">Ubah Gambar Hero</span>
        </h1>
        <button type="button" class="btn-close btn-close-update" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body d-flex justify-content-center align-items-center">
        <div class="col">
         <div class="form-group mt-3 row">
          <div class="col-12">
           <input type="file" name="hero{{ $item->id }}" data-id="{{ $item->id }}"
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
        <button type="button" class="btn btn-primary btn-ubah-img-hero" data-id="{{ $item->id }}"
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

{{-- Landing Page --}}
<div class="col-12 p-2 px-1 mb-2">
 <div class="shadow card border pb-2">
  <div class="p2 px-3 mt-2 mb-2">
   <h5 class="text-black">Tampilan Beranda</h5>
  </div>
  <div class="col-12 p-0 px-{{ $section->size }} body mb-2">

   <div class="bg-image-section-hero">
    <div class="text-overlay-section-hero theme-color-body-transparant pre shadow">
     <h1>{{ $dataHero->text_hero }}</h1>
     <a href="{{ $linkHrefButtonHero }}"
      class="btn btn-light cursor-pointer theme-color-primary text-break text-start">
      <span class="font-color-body fw-semibold">
       {{ $dataHero->text_button }}
      </span>
     </a>
    </div>
    <div id="carouselExampleSlidesOnlyHeroDetail" class="carousel slide" data-bs-ride="carousel">
     <div class="carousel-inner">
      @foreach ($detailSection as $i => $item)
       <div class="carousel-item carousel-item-section-hero {{ $i == 0 ? 'active' : '' }}">
        <img src="{{ asset("storage/section/hero/{$item->file}") }}" class="d-block w-100 src-uniq-hero"
         alt="...">
       </div>
      @endforeach
     </div>
    </div>
   </div>
  </div>
 </div>
</div>


{{-- modal ubah data hero --}}
<div class="modal fade" id="exampleModalToggleUbahHero" class="exampleModalToggleUbahHero"
 aria-hidden="true"aria-labelledby="exampleModalToggleLabelUbahHero" tabindex="-1">
 <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg h-auto">
  <div class="modal-content needs-validation-edit-data">
   <input type="hidden" value="hero" name="cekSection">
   <input type="hidden" value="ubah_data" name="cekUpdate" class="ubah-data">
   <div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalToggleLabelUbahHero">
     <span class="text-black">Ubah Data Hero</span>
    </h1>
    <button type="button" class="btn-close btn-close-update" data-bs-dismiss="modal" aria-label="Close"></button>
   </div>
   <div class="modal-body d-flex justify-content-center align-items-center">
    <div class="col">
     <div class="row mb-3">
      <label for="text_hero" class="col-sm-2 col-form-label">Teks Hero</label>
      <div class="col-sm-10">
       <input type="text" class="form-control input-edit-data-hero"
        value="{{ old('text_hero', $dataHero->text_hero) }}" placeholder="Masukan teks hero..." id="text_hero"
        name="text_hero" maxlength="150" data-id="{{ $section->id }}" required>
       <div class="invalid-feedback">
        Perlu di isi
       </div>
      </div>
     </div>
     <div class="row mb-3">
      <label for="text_button" class="col-sm-2 col-form-label">Teks Tombol</label>
      <div class="col-sm-10">
       <input type="text" class="form-control input-edit-data-hero"
        value="{{ old('text_button', $dataHero->text_button) }}" placeholder="Masukan teks tombol..."
        id="text_button" name="text_button" maxlength="20" data-id="{{ $section->id }}" required>
       <div class="invalid-feedback">
        Perlu di isi
       </div>
      </div>
     </div>
     <div class="row mb-3 form-group">
      <labele class="col-sm-2 col-form-label">Tujuan Tombol</labele>
      <div class="col-sm-10 d-flex align-items-center">
       <div class="row">
        <div class="col-12">
         <div class="form-check form-check-inline">
          <input class="form-check-input cursor-pointer input-edit-data-hero" type="radio" name="link_button"
           data-id="{{ $section->id }}" id="link_button1" value="1"
           @if (old('link_button', $dataHero->link_button) == '1') checked @endif>
          <label class="form-check-label cursor-pointer" for="link_button1">
           Beranda
          </label>
         </div>
         <div class="form-check form-check-inline">
          <input class="form-check-input cursor-pointer input-edit-data-hero" type="radio" name="link_button"
           data-id="{{ $section->id }}" id="link_button2" value="2"
           @if (old('link_button', $dataHero->link_button) == '2') checked @endif>
          <label class="form-check-label cursor-pointer" for="link_button2">
           Staf
          </label>
         </div>
         <div class="form-check form-check-inline">
          <input class="form-check-input cursor-pointer input-edit-data-hero" type="radio" name="link_button"
           data-id="{{ $section->id }}" id="link_button3" value="3"
           @if (old('link_button', $dataHero->link_button) == '3') checked @endif>
          <label class="form-check-label cursor-pointer" for="link_button3">
           Berita
          </label>
         </div>
         <div class="form-check form-check-inline">
          <input class="form-check-input cursor-pointer input-edit-data-hero" type="radio" name="link_button"
           data-id="{{ $section->id }}" id="link_button4" value="4"
           @if (old('link_button', $dataHero->link_button) == '4') checked @endif>
          <label class="form-check-label cursor-pointer" for="link_button4">
           Galeri Gambar
          </label>
         </div>
         <div class="form-check form-check-inline">
          <input class="form-check-input cursor-pointer input-edit-data-hero" type="radio" name="link_button"
           data-id="{{ $section->id }}" id="link_button5" value="5"
           @if (old('link_button', $dataHero->link_button) == '5') checked @endif>
          <label class="form-check-label cursor-pointer" for="link_button5">
           Galeri Video
          </label>
         </div>
         <div class="form-check form-check-inline">
          <input class="form-check-input cursor-pointer input-edit-data-hero" type="radio" name="link_button"
           data-id="{{ $section->id }}" id="link_button6" value="6"
           @if (old('link_button', $dataHero->link_button) == '6') checked @endif>
          <label class="form-check-label cursor-pointer" for="link_button6">
           Unduh
          </label>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-danger btn-close-update" data-bs-dismiss="modal">Batal</button>
    <button type="button" class="btn btn-primary btn-ubah-data-hero" data-id="{{ $section->id }}">Ubah</button>
   </div>
  </div>
 </div>
</div>

{{-- modal tambah gambar hero --}}
<div class="modal fade modal-tambah-img" id="exampleModalToggleTambahHero"
 aria-hidden="true"aria-labelledby="exampleModalToggleLabelTambahHero" tabindex="100">
 <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg h-auto">
  <div class="modal-content needs-validation-add-img">
   <input type="hidden" value="hero" name="cekSection">
   <input type="hidden" value="tambah_gambar" name="cekUpdate" class="tambah-gambar">
   <div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalToggleLabelTambahHero">
     <span class="text-black">Tambah Gambar Hero</span>
    </h1>
    <button type="button" class="btn-close btn-close-update" data-bs-dismiss="modal" aria-label="Close"></button>
   </div>
   <div class="modal-body d-flex justify-content-center align-items-center">
    <div class="col">
     <div class="form-group mt-3 row">
      <div class="col-12">
       <input type="file" name="hero[]" id="inputHeroes" class="form-control cursor-pointer addImg"
        accept=".jpg,.jpeg,.png" required multiple>
       <div class="invalid-feedback">
        Perlu di isi
       </div>
      </div>
     </div>
     <div class="form-group mt-3 row">
      <div class="col-12">
       <div class="tambahFotoHeroes d-none text-center tambahFoto">
        {{-- ... perulangan img --}}
       </div>
      </div>
     </div>
    </div>
   </div>
   <div class="modal-footer">
    <input type="hidden" name="maxImg" value="{{ $maxImg }}" class="maxImg">
    <button type="button" class="btn btn-danger btn-close-update" data-bs-dismiss="modal">Batal</button>
    <button type="button" class="btn btn-primary btn-tambah-img-hero" data-id="{{ $section->id }}">Simpan</button>
   </div>
  </div>
 </div>
</div>

{{-- script tambah gambar ada di detail.blade --}}
