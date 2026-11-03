<div class="col-12 p-2 px-3 needs-validation{{ $key }}">
 <div class="form-group row">
  <label class="col-form-label col-xl-2 col-sm-3" for="inputJenis{{ $key }}">Jenis</label>
  <div class="col-xl-10 col-sm-9">
   <input type="text" name="jenis{{ $key }}" class="form-control" id="inputJenis{{ $key }}"
    value="{{ $item->jenis }}" disabled>
  </div>
 </div>

 {{-- name --}}
 <div class="form-group row mt-3">
  <label class="col-xl-2 col-sm-3 col-form-label " for="inputNamaSection{{ $key }}">Nama</label>
  <div class="col-xl-10 col-sm-9">
   <input type="text" class="form-control input-edit-section" id="inputNamaSection{{ $key }}"
    name="name{{ $key }}" pattern=".*\S.*" placeholder="Masukan nama section..." required value="{{ old('name', $item->name) }}"
    maxlength="150" data-id="{{ $item->id }}" data-key="{{ $key }}">
   <div class="invalid-feedback">
    Perlu diisi
   </div>
  </div>
 </div>
 {{-- ukuran section --}}
 <div class="form-group row mt-3">
  <div class="col-12">
   <div class="row d-flex">
    <div class="col-xl-2 col-sm-3">
     <label class="col-form-label">Ukuran</label>
    </div>
    <div class="col-xl-10 col-sm-9">
     <div class="form-check form-check-inline me-3 col-form-label mb-0">
      <input class="form-check-input cursor-pointer input-edit-section" type="radio" name="size{{ $key }}"
       value="full" id="size1{{ $key }}" @if (old('size', $item->size) == 'full') checked @endif
       data-id="{{ $item->id }}" data-key="{{ $key }}">
      <label class="form-check-label p-0 cursor-pointer" for="size1{{ $key }}">
       Memenuhi Layar
      </label>
     </div>
     <div class="form-check form-check-inline me-3 col-form-label mb-0">
      <input class="form-check-input cursor-pointer input-edit-section" type="radio" name="size{{ $key }}"
       value="big" id="size2{{ $key }}" @if (old('size', $item->size) == 'big') checked @endif
       data-id="{{ $item->id }}" data-key="{{ $key }}">
      <label class="form-check-label p-0 cursor-pointer" for="size2{{ $key }}">
       Besar
      </label>
     </div>
     <div class="form-check form-check-inline me-3 col-form-label mb-0">
      <input class="form-check-input cursor-pointer input-edit-section" type="radio" name="size{{ $key }}"
       value="medium" id="size3{{ $key }}" @if (old('size', $item->size) == 'medium') checked @endif
       data-id="{{ $item->id }}" data-key="{{ $key }}">
      <label class="form-check-label p-0 cursor-pointer" for="size3{{ $key }}">
       Sedang
      </label>
     </div>
     <div class="form-check form-check-inline me-0 col-form-label mb-0">
      <input class="form-check-input cursor-pointer input-edit-section" type="radio" name="size{{ $key }}"
       value="small" id="size4{{ $key }}" @if (old('size', $item->size) == 'small') checked @endif
       data-id="{{ $item->id }}" data-key="{{ $key }}">
      <label class="form-check-label p-0 cursor-pointer" for="size4{{ $key }}">
       Kecil
      </label>
     </div>
    </div>
   </div>
  </div>
 </div>
 {{-- urutan section --}}
 <div class="form-group row mt-3">
  <label class="col-xl-2 col-sm-3 col-form-label " for="inputUrutan{{ $key }}">Urutan</label>
  <div class="col-xl-10 col-sm-9">
   <div class="input-group">
    <div class="col-auto d-flex">
     <div class="col-span-value-section d-flex align-items-center justify-content-start pe-2">
      <span class="input-group-text w-100 justify-content-center"
       id="hasilInputUrutan{{ $key }}">{{ old('urutan', $item->urutan) }}</span>
     </div>
     <div class="col-auto d-flex align-items-center pe-2">
      <button type="button" id="minusUrutan{{ $key }}" class="btn btn-secondary m-0 p-0 fs-4-sendiri px-2">
       <span class="text-white">
        <i class="bi bi-dash"></i>
       </span>
      </button>
     </div>
    </div>
    <div class="col d-flex">
     <div class="col pt-2 border rounded px-3">
      <input type="range" required class="form-range input-edit-section" name="urutan{{ $key }}"
       id="inputUrutan{{ $key }}" value="{{ old('urutan', $item->urutan) }}" min="1"
       max="{{ $max }}" data-id="{{ $item->id }}" data-key="{{ $key }}">
     </div>
     <div class="col-auto p-0 m-0 d-flex align-items-center justify-content-end ps-2">
      <button type="button" id="plusUrutan{{ $key }}" class="btn btn-secondary m-0 p-0 fs-4-sendiri px-2">
       <span class="text-white">
        <i class="bi bi-plus"></i>
       </span>
      </button>
     </div>
    </div>
   </div>
  </div>
 </div>
 {{-- jarak atas --}}
 <div class="form-group row mt-3">
  <label class="col-xl-2 col-sm-3 col-form-label " for="inputMarginTop{{ $key }}">Jarak Atas</label>
  <div class="col-xl-10 col-sm-9">
   <div class="input-group">
    <div class="col-auto d-flex">
     <div class="col-span-value-section d-flex align-items-center justify-content-start pe-2">
      <span class="input-group-text w-100 justify-content-center"
       id="hasilInputMarginTop{{ $key }}">{{ old('margin_top', $item->margin_top . 'px') }}</span>
     </div>
     <div class="col-auto d-flex align-items-center pe-2">
      <button type="button" id="minusMarginTop{{ $key }}" class="btn btn-secondary m-0 p-0 fs-4-sendiri px-2">
       <span class="text-white">
        <i class="bi bi-dash"></i>
       </span>
      </button>
     </div>
    </div>
    <div class="col d-flex">
     <div class="col pt-2 border rounded px-3">
      <input type="range" required class="form-range input-edit-section" name="margin_top{{ $key }}"
       id="inputMarginTop{{ $key }}" value="{{ old('margin_top', $item->margin_top) }}" min="0"
       max="999" data-id="{{ $item->id }}" data-key="{{ $key }}">
     </div>
     <div class="col-auto p-0 m-0 d-flex align-items-center justify-content-end ps-2">
      <button type="button" id="plusMarginTop{{ $key }}" class="btn btn-secondary m-0 p-0 fs-4-sendiri px-2">
       <span class="text-white">
        <i class="bi bi-plus"></i>
       </span>
      </button>
     </div>
    </div>
   </div>
  </div>
 </div>
 {{-- jarak bawah --}}
 <div class="form-group row mt-3">
  <label class="col-xl-2 col-sm-3 col-form-label " for="inputMarginBottom{{ $key }}">Jarak Bawah</label>
  <div class="col-xl-10 col-sm-9">
   <div class="input-group ">
    <div class="col-auto d-flex">
     <div class="col-span-value-section d-flex align-items-center justify-content-start pe-2">
      <span class="input-group-text w-100 justify-content-center"
       id="hasilInputMarginBottom{{ $key }}">{{ old('margin_bottom', $item->margin_bottom . 'px') }}</span>
     </div>
     <div class="col-auto d-flex align-items-center pe-2">
      <button type="button" id="minusMarginBottom{{ $key }}" class="btn btn-secondary m-0 p-0 fs-4-sendiri px-2">
       <span class="text-white">
        <i class="bi bi-dash"></i>
       </span>
      </button>
     </div>
    </div>
    <div class="col d-flex">
     <div class="col pt-2 border rounded px-3">
      <input type="range" required class="form-range input-edit-section" name="margin_bottom{{ $key }}"
       id="inputMarginBottom{{ $key }}" value="{{ old('margin_bottom', $item->margin_bottom) }}"
       min="0" max="999" data-id="{{ $item->id }}" data-key="{{ $key }}">
     </div>
     <div class="col-auto p-0 m-0 d-flex align-items-center justify-content-end ps-2">
      <button type="button" id="plusMarginBottom{{ $key }}" class="btn btn-secondary m-0 p-0 fs-4-sendiri px-2">
       <span class="text-white">
        <i class="bi bi-plus"></i>
       </span>
      </button>
     </div>
    </div>
   </div>
  </div>
 </div>
 {{-- status --}}
 <div class="form-group row mt-3">
  <div class="col-12">
   <div class="row d-flex">
    <div class="col-xl-2 col-sm-3">
     <label class="col-form-label">Status</label>
    </div>
    <div class="col-xl-10 col-sm-9">
     <div class="form-check form-check-inline me-3 col-form-label mb-0">
      <input class="form-check-input cursor-pointer input-edit-section" type="radio"
       name="active{{ $key }}" value="1" id="active1{{ $key }}"
       @if (old('active', $item->active) == '1') checked @endif data-id="{{ $item->id }}"
       data-key="{{ $key }}">
      <label class="form-check-label p-0  cursor-pointer" for="active1{{ $key }}">
       Aktif
      </label>
     </div>
     <div class="form-check form-check-inline me-0 col-form-label mb-0">
      <input class="form-check-input cursor-pointer input-edit-section" type="radio"
       name="active{{ $key }}" value="0" id="active0{{ $key }}"
       @if (old('active', $item->active) == '0') checked @endif data-id="{{ $item->id }}"
       data-key="{{ $key }}">
      <label class="form-check-label p-0  cursor-pointer" for="active0{{ $key }}">
       Tidak Aktif
      </label>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>
