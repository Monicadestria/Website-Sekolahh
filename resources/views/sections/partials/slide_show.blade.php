<div class="col-12 p-0 section-partials" data-margin-top="{{ $data->margin_top }}"
 data-margin-bottom="{{ $data->margin_bottom }}">
 <div class="row m-0">
  <div class="col-12 m-0 p-0 px-{{ $data->size }}">
   <div id="carouselExampleIndicators{{ $no }}" class="carousel slide " data-bs-ride="carousel">
    {{-- garis panjang dibawah gambar --}}
    <div class="carousel-indicators">
     @foreach ($data->slider as $i => $item)
      <button type="button" data-bs-target="#carouselExampleIndicators{{ $no }}"
       data-bs-slide-to="{{ $i }}"
       @if ($i == 0) class="active" aria-current="true" @endif></button>
     @endforeach
    </div>
    {{-- gambar slide show --}}
    <div class="carousel-inner">
     @foreach ($data->slider as $i => $item)
      <div class="carousel-item carousel-item-slideshow-partial {{ $i == 0 ? 'active' : '' }}">
       <img src="{{ asset("storage/section/slider/$item->file") }}"class="d-block" alt="gambar slideshow">
      </div>
     @endforeach
    </div>
    {{-- panah kiri  --}}
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators{{ $no }}"
     data-bs-slide="prev">
     <span class="carousel-control-prev-icon" aria-hidden="true"></span>
     <span class="visually-hidden">Previous</span>
    </button>
    {{-- panah kanan --}}
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators{{ $no }}"
     data-bs-slide="next">
     <span class="carousel-control-next-icon" aria-hidden="true"></span>
     <span class="visually-hidden">Next</span>
    </button>
   </div>
  </div>
 </div>

</div>
