<div class="col-12 p-2 px-1">
 <div class="row d-flex justify-content-around px-2">
  <div class="row m-0 p-0 px-1 justify-content-around">
   @foreach ($detailSection as $i => $item)
    <div class="card shadow align-items-center {{ $lebarImg }} px-0">
     <img src="{{ asset("storage/section/slider/$item->file") }}" class="card border-0 w-100 h-200px src-uniq-slider"
      alt="{{ $item->file }}">
     <div class="card-img-overlay p-0 d-flex flex-column">
      <div class="py-0 px-1 fs-6">
       <span class="badge rounded-pill text-bg-secondary">{{ ++$i }}</span>
      </div>
      <div class="text-end p-1 mt-auto">
       <button type="button" class="btn btn-sm btn-info p-0 rounded-pill" data-bs-toggle="modal"
        data-bs-target="#modalTogglelihatFotoSlider{{ $i }}">
        <span class="badge"><i class="bi bi-zoom-in"></i></span>
       </button>
       <button type="button" class="btn btn-sm btn-warning p-0 rounded-pill btn-modal-edit-slider"
        {{-- data-bs-toggle="modal" data-bs-target="#modalToggleubahFotoSlider{{ $i }}" --}} data-key="{{ $i }}" data-id="{{ $item->id }}">
        <span class="badge"><i class="bi bi-pencil"></i></span>
       </button>
       <button class="btn btn-sm btn-danger p-0 rounded-pill btn-delete-slider" data-id="{{ $item->id }}"
        data-key="{{ $section->id }}">
        <span class="badge"><i class="bi bi-trash"></i></span>
       </button>
       <a href="{{ asset("storage/section/slider/$item->file") }}" download="{{ $item->file }}">
        <button type="button" class="btn btn-sm btn-success p-0 rounded-pill">
         <span class="badge"><i class="bi bi-floppy"></i></span>
        </button>
       </a>
      </div>
     </div>
    </div>

    {{-- modal lihat gambar --}}
    <div class="modal fade" id="modalTogglelihatFotoSlider{{ $i }}" aria-hidden="true"
     aria-labelledby="lihatFotoSlider{{ $i }}" tabindex="-1">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen p-5 h-auto">
      <div class="modal-content">
       <div class="modal-header">
        <h1 class="modal-title fs-5" id="lihatFotoSlider{{ $i }}">
         <span class="text-black">Gambar Slide Show</span>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body d-flex justify-content-center align-items-center">
        <img src="{{ asset("storage/section/slider/$item->file") }}" class="src-uniq-slider"
         alt="{{ $item->file }}">
       </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
       </div>
      </div>
     </div>
    </div>
    {{-- modal ubah gambar --}}
    <div class="modal fade modalSlider modal-ubah-img{{ $item->id }}"
     id="modalToggleubahFotoSlider{{ $i }}" aria-hidden="true"
     aria-labelledby="ubahFotoSlider{{ $i }}" tabindex="-1">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg h-auto">
      <div class="modal-content needs-validation-edit-img{{ $item->id }}">
       <input type="hidden" value="slide_show" name="cekSection">
       <input type="hidden" value="ubah_gambar" name="cekUpdate" class="ubah-gambar">
       <div class="modal-header">
        <h1 class="modal-title fs-5" id="ubahFotoSlider{{ $i }}">
         <span class="text-black">Ubah Gambar Slide Show</span>
        </h1>
        <button type="button" class="btn-close btn-close-update" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body d-flex justify-content-center align-items-center">
        <div class="col">
         <div class="form-group mt-3 row">
          <div class="col-12">
           <input type="file" name="slider{{ $item->id }}" data-id="{{ $item->id }}"
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
        <button type="button" class="btn btn-primary btn-ubah-img-slider" data-id="{{ $item->id }}"
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

{{-- Tampilan Landing Page --}}
<div class="col-12 p-2 px-1 mb-2">
 <div class="shadow card border pb-3">
  <div class="p2 px-3 mt-2 mb-2">
   <h5>
    <span class="text-black">Tampilan Beranda</span>
   </h5>
  </div>
  <div class="col-12 m-0 p-0 px-{{ $section->size }} body">
   <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators ">
     {{-- Tombol geser slide show --}}
     @foreach ($detailSection as $i => $item)
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $i }}"
       @if ($i == 0) class="active" aria-current="true" @endif></button>
     @endforeach
    </div>
    <div class="carousel-inner">
     @foreach ($detailSection as $i => $item)
      <div class="carousel-item carousel-item-slideshow-detail {{ $i == 0 ? 'active' : '' }}">
       <img src="{{ asset("storage/section/slider/$item->file") }}" class="d-block w-100 src-uniq-slider"
        alt="gambar slideshow">
      </div>
     @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
     data-bs-slide="prev">
     <span class="carousel-control-prev-icon" aria-hidden="true"></span>
     <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
     data-bs-slide="next">
     <span class="carousel-control-next-icon" aria-hidden="true"></span>
     <span class="visually-hidden">Next</span>
    </button>
   </div>
  </div>
 </div>
</div>

{{-- modal tambah gambar SlideShow --}}
<div class="modal fade modal-tambah-img" id="exampleModalToggleTambahSlideShow"
 aria-hidden="true"aria-labelledby="exampleModalToggleLabelTambahSlideShow" tabindex="-1">
 <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg h-auto">
  <div class="modal-content needs-validation-add-img">
   <input type="hidden" value="slide_show" name="cekSection">
   <input type="hidden" value="tambah_gambar" name="cekUpdate" class="tambah-gambar">
   <div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalToggleLabelTambahSlideShow">
     <span class="text-black">Tambah Gambar Slide Show</span>
    </h1>
    <button type="button" class="btn-close btn-close-update" data-bs-dismiss="modal" aria-label="Close"></button>
   </div>
   <div class="modal-body d-flex justify-content-center align-items-center">
    <div class="col">
     <div class="form-group mt-3 row">
      <div class="col-12">
       <input type="file" name="slider[]" id="inputFotoSliders" class="form-control cursor-pointer addImg"
        data-id="{{ $section->id }}" accept=".jpg,.jpeg,.png" required multiple>
       <div class="invalid-feedback">
        Perlu di isi
       </div>
      </div>
     </div>
     <div class="form-group mt-3 row">
      <div class="col-12">
       <div class="tambahFotoSliders d-none text-center tambahFoto">
        {{-- ... perulangan img --}}
       </div>
      </div>
     </div>
    </div>
   </div>
   <div class="modal-footer">
    <input type="hidden" name="maxImg" value="{{ $maxImg }}" class="maxImg">
    <button type="button" class="btn btn-danger btn-close-update" data-bs-dismiss="modal">Batal</button>
    <button type="button" class="btn btn-primary btn-tambah-slider" data-id="{{ $section->id }}">Simpan</button>
   </div>
  </div>
 </div>
</div>
{{-- script tambah gambar ada di detail.blade --}}
