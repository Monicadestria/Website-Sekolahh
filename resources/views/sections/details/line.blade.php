<div class="col-12 p-2 px-1 mb-2">
 <div class="shadow card border">
  <div class="p2 px-3 mt-2">
   <h5 class="text-black">Tampilan Beranda</h5>
  </div>
  <div class="row my-3 mx-0">
   <div class="col-12 foreach-line p-0 body">
    @for ($i = 0; $i < $detailSection->amount; $i++)
     <div
      class="col-12 p-0 px-{{ $section->size }} d-flex justify-content-{{ $detailSection->position }} section-partials"
      data-margin-top="{{ $section->margin_top }}" data-margin-bottom="{{ $section->margin_bottom }}">
      <div
       class="col-sendiri-section garis-section border-top p-0 
        @if ($detailSection->round) border-radius-section-line @endif"
       data-width="{{ $detailSection->length }}" data-color="{{ $detailSection->color }}"
       data-border-width="{{ $detailSection->bold }}">
      </div>
     </div>
    @endfor
   </div>
  </div>
 </div>
</div>

<div class="modal fade" id="exampleModalToggleUbahLine"
 aria-hidden="true"aria-labelledby="exampleModalToggleLabelUbahLine" tabindex="-1">
 <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
  <div class="modal-content">
   {{-- <form class="needs-validation form-edit" novalidate
    action="{{ route('section.updateDetail', ['id' => $detailSection->id]) }}" method="post">
    @csrf
    @method('PUT') --}}
   <input type="hidden" value="line" name="cekSection">
   <div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalToggleLabelUbahLine">
     <span class="text-black">
      Ubah Data Garis
     </span>
    </h1>
    <button type="button" class="btn-close btn-close-update" data-bs-dismiss="modal" aria-label="Close"></button>
   </div>
   <div class="modal-body pt-0 row d-flex justify-content-center align-items-center">
    <div class="col-12">
     <div class="form-group row mt-3">
      <label class="col-xl-2 col-sm-3 col-form-label" for="inputPosisigaris">Posisi</label>
      <div class="col-xl-10 col-sm-9">
       <div class="form-check form-check-inline me-4">
        <input class="form-check-input cursor-pointer input-edit-line" type="radio" data-id="{{ $detailSection->id }}"
         name="position" value="start" id="positionstart" @if (old('position', $detailSection->position) == 'start') checked @endif>
        <label class="form-check-label cursor-pointer input-edit-line" for="positionstart">
         Kiri
        </label>
       </div>
       <div class="form-check form-check-inline me-4">
        <input class="form-check-input cursor-pointer input-edit-line" type="radio" data-id="{{ $detailSection->id }}"
         name="position" value="center" id="positioncenter" @if (old('position', $detailSection->position) == 'center') checked @endif>
        <label class="form-check-label cursor-pointer input-edit-line" for="positioncenter">
         Tengah
        </label>
       </div>
       <div class="form-check form-check-inline me-0">
        <input class="form-check-input cursor-pointer input-edit-line" type="radio" data-id="{{ $detailSection->id }}"
         name="position" value="end" id="positionend" @if (old('position', $detailSection->position) == 'end') checked @endif>
        <label class="form-check-label cursor-pointer input-edit-line" for="positionend">
         Kanan
        </label>
       </div>
      </div>
     </div>
     <div class="form-group row mt-3">
      <label class="col-xl-2 col-sm-3 col-form-label" for="inputTepigaris">Tepi</label>
      <div class="col-xl-10 col-sm-9">
       <div class="form-check form-check-inline me-4">
        <input class="form-check-input cursor-pointer input-edit-line" type="radio"
         data-id="{{ $detailSection->id }}" name="round" value="1" id="round1"
         @if (old('round', $detailSection->round) == '1') checked @endif>
        <label class="form-check-label cursor-pointer input-edit-line" for="round1">
         Bulat
        </label>
       </div>
       <div class="form-check form-check-inline me-0">
        <input class="form-check-input cursor-pointer input-edit-line" type="radio"
         data-id="{{ $detailSection->id }}" name="round" value="0" id="round0"
         @if (old('round', $detailSection->round) == '0') checked @endif>
        <label class="form-check-label cursor-pointer input-edit-line" for="round0">
         Kotak
        </label>
       </div>
      </div>
     </div>
     <div class="form-group row mt-3">
      <label class="col-xl-2 col-sm-3 col-form-label" for="inputWarnGaris">Warna</label>
      <div class="col-xl-10 col-sm-9">
       <input type="color" class="form-control form-control-color w-100 linecolor" id="inputWarnGaris"
        data-id="{{ $detailSection->id }}" value="{{ old('color', $detailSection->color) }}" name="color">
      </div>
     </div>
     <div class="form-group row mt-3">
      <label class="col-xl-2 col-sm-3 col-form-label" for="inputTebalGaris">Tebal</label>
      <div class="col-xl-10 col-sm-9 m-0 kolomInputGaris">
       <div class="input-group">
        <div class="col-auto d-flex">
         <div class="col-span-value-section d-flex align-items-center justify-content-start pe-2">
          <span class="input-group-text w-100 justify-content-center"
           id="hasilInputTebalGaris">{{ old('bold', $detailSection->bold . 'px') }}</span>
         </div>
         <div class="col-auto d-flex align-items-center pe-2">
          <button type="button" id="minusTebalGaris" class="btn btn-secondary m-0 p-0 fs-4-sendiri px-2">
           <i class="bi bi-dash text-white"></i>
          </button>
         </div>
        </div>
        <div class="col d-flex">
         <div class="col pt-2 border rounded px-3">
          <input type="range" required class="form-range input-edit-line" name="bold" id="inputTebalGaris"
           readonly data-id="{{ $detailSection->id }}" value="{{ old('bold', $detailSection->bold) }}"
           min="1" max="100">
         </div>
         <div class="col-auto p-0 m-0 d-flex align-items-center justify-content-end ps-2">
          <button type="button" id="plusTebalGaris" class="btn btn-secondary m-0 p-0 fs-4-sendiri px-2">
           <i class="bi bi-plus text-white"></i>
          </button>
         </div>
        </div>
       </div>
      </div>
     </div>
     <div class="form-group row mt-3">
      <label class="col-xl-2 col-sm-3 col-form-label" for="inputLebarGaris">Panjang</label>
      <div class="col-xl-10 col-sm-9 m-0 kolomInputGaris">
       <div class="input-group">
        <div class="col-auto d-flex">
         <div class="col-span-value-section d-flex align-items-center justify-content-start pe-2">
          <span class="input-group-text w-100 justify-content-center"
           id="hasilInputLebarGaris">{{ old('length', $detailSection->length . '%') }}</span>
         </div>
         <div class="col-auto d-flex align-items-center pe-2">
          <button type="button" id="minusLebarGaris" class="btn btn-secondary m-0 p-0 fs-4-sendiri px-2">
           <i class="bi bi-dash text-white"></i>
          </button>
         </div>
        </div>
        <div class="col d-flex">
         <div class="col pt-2 border rounded px-3">
          <input type="range" required class="form-range input-edit-line" name="length" id="inputLebarGaris"
           readonly data-id="{{ $detailSection->id }}" value="{{ old('length', $detailSection->length) }}"
           min="1" max="100">

         </div>
         <div class="col-auto p-0 m-0 d-flex align-items-center justify-content-end ps-2">
          <button type="button" id="plusLebarGaris" class="btn btn-secondary m-0 p-0 fs-4-sendiri px-2">
           <i class="bi bi-plus text-white"></i>
          </button>
         </div>
        </div>
       </div>
      </div>
     </div>
     <div class="form-group row mt-3">
      <label class="col-xl-2 col-sm-3 col-form-label" for="inputJumlahGaris">Jumlah</label>
      <div class="col-xl-10 col-sm-9 m-0 kolomInputGaris">
       <div class="input-group">
        <div class="col-auto d-flex">
         <div class="col-span-value-section d-flex align-items-center justify-content-start pe-2">
          <span class="input-group-text w-100 justify-content-center"
           id="hasilInputJumlahGaris">{{ old('amount', $detailSection->amount) }}</span>
         </div>
         <div class="col-auto d-flex align-items-center pe-2">
          <button type="button" id="minusJumlahGaris" class="btn btn-secondary m-0 p-0 fs-4-sendiri px-2">
           <i class="bi bi-dash text-white"></i>
          </button>
         </div>
        </div>
        <div class="col d-flex">
         <div class="col pt-2 border rounded px-3">
          <input type="range" required class="form-range input-edit-line" name="amount" id="inputJumlahGaris"
           readonly data-id="{{ $detailSection->id }}" value="{{ old('amount', $detailSection->amount) }}"
           min="1" max="20">
         </div>
         <div class="col-auto p-0 m-0 d-flex align-items-center justify-content-end ps-2">
          <button type="button" id="plusJumlahGaris" class="btn btn-secondary m-0 p-0 fs-4-sendiri px-2">
           <i class="bi bi-plus text-white"></i>
          </button>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-danger btn-close-update" data-bs-dismiss="modal">Batal</button>
    <button type="button" class="btn btn-primary btn-ubah-line" data-id="{{ $detailSection->id }}">Ubah</button>
   </div>
   {{-- </form> --}}
  </div>
 </div>
</div>
{{-- script baru ada di detail --}}
