@php
 $user = App\Models\User::with([
     'menus' => function ($query) {
         $query
         ->with('access')
         ->where('status', 1)
         ->orderBy('sequence', 'asc')
         ->get();
     },
 ])
 ->find(auth()->user()->id);
 $logo = App\Models\Setting::select('logo')->where('created_by', auth()->user()->id)->first();
 $logo = $logo['logo'];
@endphp

<div class="sidebar shadow-sidebar px-2" id="sidebar">
 <ul class="nav flex-column">
  <li class="nav-item logo-nama-sekolah fw-bold d-flex align-items-center justify-content-center text-white">
   <img src="{{ $logo ? asset('storage/setting/' . $logo) : asset('img/logo-tutwuri.png') }}" class="logo" alt="Logo Sekolah">
   <span class="sidebar-hilang-nama-sekolah mt-1 nama-sekolah text-break">{{ $school }}</span>
  </li>
  <hr>
  <li class="nav-item fw-semibold dashboard-menu text-white">
   <span class="sidebar-hilang">
    Dashboard Menu
   </span>
  </li>
  @foreach ($user->menus as $menu)
   <li
    class="nav-item mt-2 fw-semibold {{ Route::is(strtolower($menu->name) . '*') ? 'dashboard card shadow bg-light text-dark' : '' }}">
    <a class="nav-link sidebar-nonaktif {{ Route::is(strtolower($menu->name) . '*') ? 'text-dark' : '' }}"
     href="{{ route($menu->access->name) }}">
     <i class="{{ $menu->icon }} menu-sidebar ps-1"></i>
     {{-- <span class="sidebar-hilang">{{ ucwords($menu->name) }}</span> --}}
     @if ($menu->name == 'Category')
     <span class="sidebar-hilang">{{ 'Kategori' }}</span>
     @elseif($menu->name == 'Theme')
     <span class="sidebar-hilang">{{ 'Tema' }}</span>
     @elseif($menu->name == 'Setting')
     <span class="sidebar-hilang">{{ 'Pengaturan' }}</span>
     @elseif($menu->name == 'Download')
     <span class="sidebar-hilang">{{ 'Unduh' }}</span>
     @elseif($menu->name == 'Galery')
     <span class="sidebar-hilang">{{ 'Galeri' }}</span>
     @else
     <span class="sidebar-hilang">{{ ucwords($menu->name) }}</span>
     @endif
    </a>
   </li>
  @endforeach

  {{-- SISTEM BARU SUPER ADMIN --}}
  @if (auth()->user()->role == 'super-admin')
      @include('partials.super-admin-sidebar')
  @endif
 </ul>
 <div class="mb-3"></div>
</div>
