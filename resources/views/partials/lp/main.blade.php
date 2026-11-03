<!doctype html>
<html lang="en">
  <head>
    @php
      $title = Route::currentRouteName();
      $title = explode('.', $title);
      $title = ucwords($title[count($title) - 2]);

      $slug = request()->url();
      $slug = explode('/', $slug);
      $slug = $slug['3'];

      $created_by = App\Models\Setting::withoutGlobalScope('user_query_scope')->where('slug', $slug)->select('created_by')->first()['created_by'];
      $theme = App\Models\Theme::withoutGlobalScope('user_query_scope')->where('created_by', $created_by)->where('status', true)->first();
      $logo = App\Models\Setting::withoutGlobalScope('user_query_scope')->where('created_by', $created_by)->pluck('logo')->first();
    @endphp
    <title>{{ $title }}</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{ $logo ? asset('storage/setting/' . $logo) : asset('img/logo-tutwuri.png') }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="/css/dataTables.bootstrap5.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @if ($title == 'Home')
      <link rel="stylesheet" href="{{ asset('css/style-section-user.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('assets/themes/' . (isset($theme->id) ? $theme->id : 'default') . '.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lp_style.css') }}">
  </head>
  <body>
    @include('partials.lp.navbar')
    <br><br>

    @if ($title != 'Home')
    <div class="row m-0 justify-content-between h6 align-items-center py-3 mt-4">
      <div class="col">
        <p class="d-inline fs-2 text-capitalize ">{{ $title }}</p>
      </div>
      
      <div class="col text-end">
        <a href="{{ route('lp.home.index', ['id' => $slug, 'slug' => $slug]) }}" class="nav-link d-inline font-color-primary">Beranda</a>
        <p class="d-inline text-capitalize">/ {{ $title }}</p>
      </div>
    </div>
    @endif

    @yield('content')
    <footer>
      @include('partials.lp.footer')
    </footer>
    
    <script src="/js/jquery-3.7.1.js"></script>
    {{-- <script src=" /js/bootstrap.bundle.min.js"></script> --}}
    <script src="/js/dataTables.js"></script>
    <script src="/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
      $(document).ready(function() {
        $('#myTable').DataTable({

        });
      });
    </script>
    @yield('js')
  </body>
</html>