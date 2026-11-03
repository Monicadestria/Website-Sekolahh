@php
 if ($data->hero->link_button === '1') {
     $href = route('lp.home.index', ['slug' => $slug]);
 } elseif ($data->hero->link_button === '2') {
     $href = route('lp.staff.index', ['slug' => $slug]);
 } elseif ($data->hero->link_button === '3') {
     $href = route('lp.berita.index', ['slug' => $slug]);
 } elseif ($data->hero->link_button === '4') {
     $href = route('lp.galery.gambar.index', ['slug' => $slug]);
 } elseif ($data->hero->link_button === '5') {
     $href = route('lp.galery.video.index', ['slug' => $slug]);
 } elseif ($data->hero->link_button === '6') {
     $href = route('lp.unduh.index', ['slug' => $slug]);
 }
@endphp

<div class="col-12 p-0 px-{{ $data->size }} section-partials" data-margin-top="{{ $data->margin_top }}"
 data-margin-bottom="{{ $data->margin_bottom }}">
 <div class="bg-image-hero-partial">
  <div class="text-overlay-hero-partial theme-color-body-transparant pre shadow">
   <h1>{{ $data->hero->text_hero }}</h1>
   <a href="{{ $href }}" class="btn btn-light cursor-pointer theme-color-primary text-break text-start">
    <span class="font-color-body fw-semibold">
     {{ $data->hero->text_button }}
    </span>
   </a>
  </div>
  <div id="carouselExampleSlidesOnly{{ $no }}" class="carousel slide" data-bs-ride="carousel">
   <div class="carousel-inner">
    @foreach ($data->hero->heroSlider as $i => $item)
     <div class="carousel-item carousel-item-hero-partial {{ $i == 0 ? 'active' : '' }}">
      <img src="{{ asset("storage/section/hero/{$item->file}") }}" class="d-block w-100" alt="...">
     </div>
    @endforeach
   </div>
  </div>
 </div>
</div>
