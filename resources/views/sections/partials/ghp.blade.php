<div class="col-12 p-0 section-partials px-{{ $data->size }}" data-margin-top="{{ $data->margin_top }}"
 data-margin-bottom="{{ $data->margin_bottom }}">
 <div class="row m-0">

  <div class="col-md-3 col-12 d-flex justify-content-center align-items-center text-center">
   <div class="row">
    @foreach ($data->ghp->img as $img)
     <div class="col-12">
      <img src="{{ asset("storage/section/ghp/$img->file") }}" alt="{{ $img->file }}"
       class="gambaratasbawah-ghp-partial my-2"
       data-margin-right="{{ $data->size == 'small' ? 'me-3' : 'kalau-null-error' }}">
     </div>
    @endforeach
   </div>
  </div>
  <div class="col-md-9 col-12 d-flex text-break justify-content-center align-items-center pre ghp-content-trix-partial"
   data-padding-right="{{ $data->size == 'full' ? 'pe-5' : 'kalau-null-error' }}"
   data-padding-left="{{ $data->size == 'small' ? 'ps-3' : 'ps-0' }}">
   <div class="row m-0 p-0">
    <div class="contentTrix-partial mb-0 p">
     {!! $data->ghp->content !!}
    </div>
   </div>
  </div>

 </div>
</div>
