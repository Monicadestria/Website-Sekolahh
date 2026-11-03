<div class="col-12 p-0 px-full section-partials" data-margin-top="0" data-margin-bottom="0">
 <div class="bg-image-hero-partial">
  <div class="text-overlay-hero-partial pre shadow">
   <h1>Proses Pembelajaran di Kelas</h1>
   <a href="#" class="text-white cursor-pointer">Read more</a>
  </div>
  <div id="carouselHeroLivePreviews" class="carousel slide" data-bs-ride="carousel">
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
