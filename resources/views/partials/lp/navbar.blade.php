<nav class="navbar navbar-expand-lg fixed-top theme-color-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img class="img-fluid" width="50" src="{{ $logo ? asset('storage/setting/' . $logo) : asset('img/logo-tutwuri.png') }}"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link text-light font-color-body" aria-current="page" href="{{ route('lp.home.index', ['slug' => $slug]) }}">Beranda</a>
            @if (request()->segment(2) == '')
            <div class="text-dark m-0 border border-light border-2 rounded-5 mx-1 font-color-body"></div>
            @endif
          </li>
          <li class="nav-item">
            <a class="nav-link text-light font-color-body" href="{{ route('lp.staff.index', ['slug' => $slug]) }}">Staf</a>
            @if (request()->segment(2) == 'staff')
            <div class="text-dark m-0 border border-light border-2 rounded-5 mx-1 font-color-body"></div>
            @endif
          </li>
          <li class="nav-item">
            <a class="nav-link text-light font-color-body" href="{{ route('lp.berita.index', ['slug' => $slug]) }}">Berita</a>
            @if (request()->segment(2) == 'berita')
            <div class="text-dark m-0 border border-light border-2 rounded-5 mx-1 font-color-body"></div>
            @endif
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link text-light font-color-body dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Galeri
            </a>
            @if (request()->segment(2) == 'galery')
            <div class="text-dark m-0 border border-light border-2 rounded-5 mx-1 font-color-body"></div>
            @endif
            <ul class="dropdown-menu" id="dropdown">
              <li><a class="dropdown-item {{ request()->segment(3) == 'gambar' ? 'font-color-primary' : ''}}" href="{{ route('lp.galery.gambar.index', ['slug' => $slug]) }}">Gambar</a></li>
              <li><a class="dropdown-item {{ request()->segment(3) == 'video' ? 'font-color-primary' : ''}}" href="{{ route('lp.galery.video.index', ['slug' => $slug]) }}">Video</a></li>
              <!-- <li><hr class="dropdown-divider"></li> -->
              <!-- <li><a class="dropdown-item" href="#">Something else here</a></li> -->
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light font-color-body" href="{{ route('lp.unduh.index', ['slug' => $slug]) }}">Unduh</a>
            @if (request()->segment(2) == 'download')
            <div class="text-dark m-0 border border-light border-2 rounded-5 mx-1 font-color-body"></div>
            @endif
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
          </li> -->
        </ul>
      </div>
    </div>
</nav>