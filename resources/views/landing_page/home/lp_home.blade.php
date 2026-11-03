@extends('partials.lp.main')

@section('content')
 <div class="container-fluid">
  <div class="row">
   <div class="col-12 pt-0 pb-2 mt-0"></div>
   @foreach ($sections as $no => $section)
    @includeIf("sections.partials.$section->partial", ['data' => $section, 'no' => $no, 'slug' => $slug])
   @endforeach
  </div>
 </div>

 <script>
  const garisSection = document.querySelectorAll('.garis-section');
  const sectionPartials = document.querySelectorAll('.section-partials');
  const ghpContentTrixPartials = document.querySelectorAll('.ghp-content-trix-partial');
  const gambaratasbawahGhpPartial = document.querySelectorAll('.gambaratasbawah-ghp-partial');
  const isiContentTrixPartial = document.querySelectorAll('.contentTrix-partial');
  const trixListItems = document.querySelectorAll('.ghp-content-trix-partial ul li, .ghp-content-trix-partial ol li');

  // Mengatur lebar setiap elemen berdasarkan data-width
  garisSection.forEach(function(element) {
   element.style.width = element.dataset.width + "%";
   element.style.setProperty('border-width', element.dataset.borderWidth + "px", 'important');
   element.style.setProperty('--border-color', element.dataset.color);
  });
  sectionPartials.forEach(function(element) {
   element.style.marginTop = element.dataset.marginTop + "px";
   element.style.marginBottom = element.dataset.marginBottom + "px";
  });
  isiContentTrixPartial.forEach(function(e) {
   e.classList.add(e.dataset.paddingLeft);
   const firstElement = e.firstElementChild;
   console.log(firstElement.tagName);

   // Periksa apakah elemen pertama adalah <h1>
   if (firstElement.tagName.toLowerCase() === 'h1') {
    firstElement.style.marginTop = '3px';
    console.log('h1 di awal' + firstElement.style.marginTop);
   } else {
    firstElement.style.marginTop = '4px';
    console.log('h1 tidak di awal' + firstElement.style.marginTop);
   }
  });

  function layarMd768Px() {
   ghpContentTrixPartials.forEach(function(e) {
    e.classList.add(e.dataset.paddingRight);
    e.classList.remove("text-center");
   });
   gambaratasbawahGhpPartial.forEach(function(e) {
    e.classList.add(e.dataset.marginRight);
   });
   trixListItems.forEach(function(e) {
    e.classList.remove('text-start');
   });
  }

  function layarKurang768Px() {
   ghpContentTrixPartials.forEach(function(e) {
    e.classList.remove(e.dataset.paddingRight);
    e.classList.add("text-center");
   });
   gambaratasbawahGhpPartial.forEach(function(e) {
    e.classList.remove(e.dataset.marginRight);
   });
   trixListItems.forEach(function(e) {
    e.classList.add('text-start');
   });
  }

  // col-md
  if (window.innerWidth >= 768) {
   layarMd768Px();
  } else {
   layarKurang768Px();
  }

  // Event listener untuk mengeksekusi kode saat ukuran layar berubah
  window.addEventListener('resize', function() {
   if (window.innerWidth >= 768) {
    layarMd768Px();
   } else {
    layarKurang768Px();
   }
  });
 </script>
@endsection
