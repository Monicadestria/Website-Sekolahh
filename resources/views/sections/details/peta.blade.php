<div class="col-12 p-2 px-1 mb-2">
 <div class="shadow card border pb-2">
  <div class="p2 px-3 mt-2 mb-0">
   <h5 class="text-black">Tampilan Beranda</h5>
  </div>
  <div class="col-12 p-0 mt-2 px-{{ $section->size }} mb-2 div-iframe-peta-detail ubah-px body">
   <span class="map-url">
    {!! $detailSection->url !!}
   </span>
  </div>
 </div>
</div>

{{-- modal ubah peta --}}
<div class="modal fade" id="modalEditUrlPeta" tabindex="-1" aria-labelledby="modalEditUrlPetaLabel" aria-hidden="true">
 <div class="modal-dialog modal-lg modal-dialog-centered">
  <div class="modal-content needs-validation">
   <input type="hidden" value="peta" name="cekSection">
   <div class="modal-header">
    <h1 class="modal-title fs-5" id="modalEditUrlPetaLabel">
     <span class="text-black">Ubah Data Peta</span>
    </h1>
    <button type="button" class="btn-close btn-close-update" data-bs-dismiss="modal" aria-label="Close"></button>
   </div>
   <div class="modal-body row">
    <div class="form-group row">
     <label class="col-xl-2 col-sm-3 col-form-label">Cara input</label>
     <div class="col-xl-10 col-sm-9">
      <video width="100%" height="auto" controls>
       <source src="{{ asset('video/tutorial/tutorial_edit_peta.mp4') }}" type="video/mp4">
       Ganti browser Anda untuk melihat video tutorial
      </video>
     </div>
    </div>
    <div class="form-group row mt-2">
     <label class="col-xl-2 col-sm-3 col-12 col-form-label" for="editPeta">Url Peta</label>
     <div class="col-xl-9 col-sm-8 col-10">
      <textarea name="url" id="editPeta" class="form-control input-edit-map" placeholder="Tempelkan url peta..."
       data-id="{{ $detailSection->id }}" required>{{ old('url', $detailSection->url) }}</textarea>
      <div class="invalid-feedback">
       Perlu di isi
      </div>
     </div>
     <div class="col-xl-1 col-sm-1 col-2 d-flex justify-content-end align-items-start">
      <a href="https://www.google.com/maps" type="button" class="btn btn-primary" target="_blank"
       rel="noopener noreferrer"><i class="bi bi-map"></i></a>
     </div>
    </div>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-info text-white tempelUrl">Tempel</button>
    <button type="button" class="btn btn-danger btn-close-update" data-bs-dismiss="modal">Batal</button>
    <button type="button" class="btn btn-primary btn-ubah-map" id="simpanUpdatePeta"
     data-id="{{ $detailSection->id }}">Ubah</button>
   </div>
  </div>
 </div>
</div>
