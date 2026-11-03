<div class="col-12 p-2 px-1 mb-2">
 <div class="shadow card border pb-2">
  <div class="p2 px-3 mt-2 mb-0">
   <h5 class="text-black">Tampilan Beranda</h5>
  </div>

  <div class="col-12 p-0 mt-2 px-{{ $section->size }} mb-2 ubah-px body">
   <div class="theme-color-primary align-items-center text-center justify-content-center fs-1 py-5 px-3 text-white pre">
    <b>
     <span class="tagline-name font-color-body">
      {{ $detailSection->name }}
     </span>
    </b>
   </div>
  </div>
 </div>
</div>

{{-- modal ubah tagline --}}
<div class="modal fade" id="exampleModalToggleUbahTagline"
 aria-hidden="true"aria-labelledby="exampleModalToggleLabelUbahTagline" tabindex="-1">
 <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
  <div class="modal-content needs-validation">
   <input type="hidden" value="tagline" name="cekSection">
   <div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalToggleLabelUbahTagline">
     <span class="text-black">Ubah Data Slogan</span>
    </h1>
    <button type="button" class="btn-close btn-close-update" data-bs-dismiss="modal" aria-label="Close"></button>
   </div>
   <div class="modal-body d-flex justify-content-center align-items-center">
    <div class="col">
     <div class="form-group mt-3 row">
      <div class="col-auto mb-3">
       <label for="editTagline" class="col-form-label">Slogan</label>
      </div>
      <div class="col mb-3">
       <input type="text" name="tagline" value="{{ old('tagline', $detailSection->name) }}"
        class="form-control input-edit-tagline" data-id="{{ $detailSection->id }}" id="editTagline"
        placeholder="Masukan slogan..." required maxlength="150">
       <div class="invalid-feedback">
        Perlu di isi
       </div>
      </div>
     </div>
    </div>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-danger btn-close-update" data-bs-dismiss="modal">Batal</button>
    <button type="button" class="btn btn-primary btn-ubah-tagline" data-id="{{ $detailSection->id }}">Ubah</button>
   </div>
  </div>
 </div>
</div>

{{-- script edit tagline ada di detail.blade --}}
