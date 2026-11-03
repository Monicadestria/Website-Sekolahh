<hr class="text-white">
  <li
   class="nav-item mt-2 cursor-pointer fw-semibold {{ Route::is('menu*') || Route::is('user_menu*') || Route::is('access*') ? 'dashboard card shadow bg-light text-dark' : '' }}"
   id="icon-super-admin">
   <a
    class="nav-link sidebar-nonaktif {{ Route::is('menu*') || Route::is('user_menu*') || Route::is('access*') ? 'text-dark' : '' }}">
    <i class="bi-pc-display menu-sidebar ps-1"></i>
    <span class="sidebar-hilang">Sistem
    </span>
    <span
     class="sidebar-hilang-dropdown {{ Route::is('menu*') || Route::is('user_menu*') || Route::is('access*') ? 'text-dark' : '' }}">
     <i
      class="bi bi-caret-{{ Route::is('menu*') || Route::is('user_menu*') || Route::is('access*') ? 'down' : 'right' }}"
      id="caret-icon"></i>
    </span>
   </a>
  </li>
  <li
   class="nav-item mt-2 fw-semibold sidebar-super-admin {{ Route::is('menu*') || Route::is('user_menu*') || Route::is('access*') ? '' : 'd-none' }} {{ Route::is('access*') ? 'rounded-3 shadow border border-light text-white' : '' }}">
   <a class="nav-link sidebar-nonaktif {{ Route::is('access*') ? 'text-white' : '' }} hover-text-black"
    href="{{ route('access.index') }}">
    <i class="bi-{{ Route::is('access*') ? 'record-circle' : 'circle' }} menu-sidebar ps-1"></i>
    <span class="sidebar-hilang">Akses
    </span>
   </a>
  </li>
  <li
   class="nav-item mt-2 fw-semibold sidebar-super-admin {{ Route::is('menu*') || Route::is('user_menu*') || Route::is('access*') ? '' : 'd-none' }} {{ Route::is('menu*') ? 'rounded-3 shadow border border-light text-white' : '' }}">
   <a class="nav-link sidebar-nonaktif {{ Route::is('menu*') ? 'text-white' : '' }} hover-text-black"
    href="{{ route('menu.index') }}">
    <i class="bi-{{ Route::is('menu*') ? 'record-circle' : 'circle' }} menu-sidebar ps-1"></i>
    <span class="sidebar-hilang">Menu
    </span>
   </a>
  </li>
  <li
   class="nav-item mt-2 fw-semibold sidebar-super-admin {{ Route::is('menu*') || Route::is('user_menu*') || Route::is('access*') ? '' : 'd-none' }} {{ Route::is('user_menu*') ? 'rounded-3 shadow border border-light text-white' : '' }}">
   <a class="nav-link sidebar-nonaktif {{ Route::is('user_menu*') ? 'text-white' : '' }} hover-text-black"
    href="{{ route('user_menu.index') }}">
    <i class="bi-{{ Route::is('user_menu*') ? 'record-circle' : 'circle' }} menu-sidebar ps-1"></i>
    <span class="sidebar-hilang">User
    </span>
   </a>
  </li>
