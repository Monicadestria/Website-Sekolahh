<style>
    /* Style the dropdown button */
.dropbtn {
  background-color: #3498db;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

/* Dropdown button on hover & focus */
.dropbtn:hover, .dropbtn:focus {
  background-color: #2980b9;
}

/* Dropdown content (hidden by default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #f1f1f1;}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {display: block;}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {background-color: #2980b9;}

</style>
<div class="row mb-5">
 <nav class="navbar navbar-expand-lg text-white navbar-fixed">
  <div class="container-fluid">
   <ul class="navbar-nav me-auto burger-menu fs-3">
    <li class="nav-item menu-open">
     <a class="nav-link cursor-pointer">
      <i class="bi bi-list text-white"></i>
     </a>
    </li>
    <li class="nav-item menu-close">
     <a class="nav-link cursor-pointer">
      <i class="bi bi-list text-white"></i>
     </a>
    </li>
    <li class="nav-item menu-open-layar-kecil">
     <a class="nav-link cursor-pointer">
      <i class="bi bi-list text-white"></i>
     </a>
    </li>
   </ul>
   <ul class="navbar-nav ms-auto flex-column">
    <li class="nav-item d-flex align-items-center position-relative">
      Halo, Selamat Datang Admin!
      <span class="fs-5">
        <i class="bi bi-person-circle ms-2 dropdown-logout text-white" id="dropdownMenuButton"  aria-expanded="false" style="cursor: pointer;"></i>
      </span>
      <a href="{{ route('logout') }}" onclick="confirmLogout(event, '', '', '{{ route('logout') }}')" >
      <ul class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuButton">
        <li class="d-flex align-items-center mx-3">
          <i class="bi bi-arrow-right-circle text-dark"></i>
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="confirmLogout(event, '', '', '{{ route('logout') }}')">Keluar</a>
        </li>
      </ul>
      </a>
    </li>
  </ul>
  </div>
 </nav>
</div>

{{--  Dropdown Custom - Optimalisasi Jquery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('.dropdown-logout').click(function(e){
            e.stopPropagation(); // Hindari menutup dropdown saat ikon diklik
            $('.dropdown-menu').toggleClass('show');
        });
        
        // Tutup dropdown saat area lain di luar dropdown diklik
        $(document).click(function(e) {
            if (!$(e.target).closest('.dropdown-menu').length) {
                $('.dropdown-menu').removeClass('show');
            }
        });
    });
</script>