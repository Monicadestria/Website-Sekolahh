<table class="table table-striped table-bordered  m-auto p-auto" id="tableSection">
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
  <th class="m-0 p-0 ps-2 pe-3 py-2 text-start th-no" width="60">No</th>
  <th class="m-0 p-0 px-2 py-2 text-start">Nama</th>
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
    </td>
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
  @endforeach

 </tbody>
</table>
