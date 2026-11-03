const sidebar = document.querySelectorAll(".sidebar");
const burgerOpen = document.querySelector(".menu-open");
const burgerClose = document.querySelector(".menu-close");
const burgerOpenLayarKecil = document.querySelector(".menu-open-layar-kecil");
const menuSidebar = document.querySelectorAll(".sidebar-hilang");
const spaceSidebar = document.querySelectorAll(".space-sidebar");
const textSidebarNamaSekolah = document.querySelectorAll(
    ".sidebar-hilang-nama-sekolah"
);
const textDashboardMenu = document.querySelectorAll(".dashboard-menu");
// const navbarFixed = document.querySelector(".navbar-fixed");
const divTombolSilang = document.querySelector(".div-tombol-silang");
const sidebarHide = document.querySelector('.sidebar-hide');
var wContent = document.querySelector('.w-content');
let cekBurgerOpen = 'none';
let cekBurgerClose = 'block';
let cekLeftLayarkecil = '-255px';
let cekTombolSilangSidebar = '-100px';
// dropdown
const caretIcon = document.querySelector('#caret-icon');
const dropdowns = document.querySelectorAll('.sidebar-super-admin');

spaceSidebar.forEach((element) => {
    element.style.padding = "0";
});

function LayarBesar() {
    burgerOpen.style.display = cekBurgerOpen;
    burgerClose.style.display = cekBurgerClose;
    if (caretIcon) {
        caretIcon.style.display = cekBurgerClose;
    }
    dropdowns.forEach(function (dropdown) {
        dropdown.classList.remove('mx-4');
    });
    burgerOpenLayarKecil.style.display = "none";
    divTombolSilang.style.top = '-100px';
    divTombolSilang.style.transition = "top 0.5s ease";

    // document.querySelector('#idSidebar').classList.add('space-sidebar');
    document.querySelector('.sidebar').style.left = '0px';
    document.querySelector('.space-sidebar').style.display = 'block';
    document.querySelector('.navbar-fixed').style.paddingRight = '255px';
    document.querySelector('.sidebar').classList.remove("position-fixed");
    document.querySelector('.sidebar').classList.add('shadow-sidebar');
    document.querySelector('.burger-menu').classList.remove("ps-3");
    wContent.style.width = "calc(100% - 255px)";

    spaceSidebar.forEach((element) => {
        element.style.display = "block";
        element.style.left = "0";
        element.style.transition = "width 0.5s ease";
    });

    if (cekBurgerOpen === 'none') {
        spaceSidebar.forEach((element) => {
            element.style.width = "255px";
        });
        Open();
    } else if (cekBurgerOpen === 'block') {
        spaceSidebar.forEach((element) => {
            element.style.width = "75px";
        });

        Close();
    }
    // console.log('layar besar dijalankan');
}

function LayarKecil() {
    burgerOpen.style.display = "none";
    burgerClose.style.display = "none";
    if (caretIcon) {
        caretIcon.style.display = "block";
    }
    dropdowns.forEach(function (dropdown) {
        dropdown.classList.add('mx-4');
    });
    burgerOpenLayarKecil.style.display = "block";
    divTombolSilang.style.top = cekTombolSilangSidebar;
    divTombolSilang.style.transition = "top 0.5s ease";
    // document.querySelector('#idSidebar').classList.remove('space-sidebar');
    document.querySelector('.sidebar').style.left = cekLeftLayarkecil;
    // document.querySelector('.space-sidebar').style.display = 'none';
    document.querySelector('.sidebar').classList.add("position-fixed");
    document.querySelector('.sidebar').style.width = '255px';
    document.querySelector('.navbar-fixed').style.paddingRight = '0';
    document.querySelector('.burger-menu').classList.add("ps-3");
    wContent.style.width = "100%";
    wContent.style.transition = "width 0.5s ease";

    menuSidebar.forEach((element) => {
        element.classList.remove("sidebar-hide");
    });
    spaceSidebar.forEach((element) => {
        element.style.width = "0";
        element.style.padding = "0";
    });
    textSidebarNamaSekolah.forEach((element) => {
        element.classList.remove("sidebar-hide", "position-absolute");
    });
    if (cekBurgerOpen === 'none') {
        menuSidebar.forEach((element) => {
            element.classList.remove("sidebar-hide");
            element.style.visibility = 'visible';
        });
        textDashboardMenu.forEach((e) => {
            e.style.display = "block";
        });
    } else if (cekBurgerOpen === 'block') {
        textDashboardMenu.forEach((e) => {
            e.style.display = "none";
        });
    }

    if (cekTombolSilangSidebar === '-100px') {
        document.querySelector('.sidebar').classList.remove('shadow-sidebar');
    }
    else if (cekTombolSilangSidebar === '9px') {
        document.querySelector('.sidebar').classList.add('shadow-sidebar');
    }
    // console.log('layar kecil dijalankan');
}

function Open() {
    document.querySelector('.navbar-fixed').style.paddingRight = '255px';
    // console.log('fungsi open jalan');
    cekBurgerOpen = 'none';
    cekBurgerClose = 'block';
    burgerOpen.style.display = cekBurgerOpen;
    burgerClose.style.display = cekBurgerClose;
    if (caretIcon) {
        caretIcon.style.display = cekBurgerClose;
    }
    dropdowns.forEach(function (dropdown) {
        dropdown.classList.add('mx-4');
    });
    sidebar.forEach((element) => {
        element.style.transition = "width 0.5s ease";
        element.style.width = "255px";
    });
    spaceSidebar.forEach((element) => {
        element.style.transition = "width 0.5s ease";
        element.style.width = "255px";
    });
    menuSidebar.forEach((element) => {
        element.classList.remove("sidebar-hide");
        element.classList.add("sidebar-show");
    });
    textSidebarNamaSekolah.forEach((element) => {
        element.classList.remove("sidebar-hide", "position-absolute");
    });
    textDashboardMenu.forEach((e) => {
        e.style.display = "block";
    });
}

function Close() {
    document.querySelector('.navbar-fixed').style.paddingRight = '75px';
    // console.log('fungsi close jalan');
    cekBurgerOpen = 'block';
    cekBurgerClose = 'none';
    burgerOpen.style.display = cekBurgerOpen;
    burgerClose.style.display = cekBurgerClose;
    if (caretIcon) {
        caretIcon.style.display = cekBurgerClose;
    }
    dropdowns.forEach(function (dropdown) {
        dropdown.classList.remove('mx-4');
    });
    sidebar.forEach((element) => {
        element.style.transition = "width 0.5s ease";
        element.style.width = "75px";
    });
    spaceSidebar.forEach((element) => {
        element.style.transition = "width 0.5s ease";
        element.style.width = "75px";
    });
    menuSidebar.forEach((element) => {
        element.classList.add("sidebar-hide");
        element.classList.remove("sidebar-show");
    });
    textSidebarNamaSekolah.forEach((element) => {
        element.classList.add("sidebar-hide", "position-absolute");
    });
    textDashboardMenu.forEach((e) => {
        e.style.display = "none";
    });
}

function OpenLayarKecil() {
    document.querySelector('.navbar-fixed').style.paddingRight = '0';
    // console.log('fungsi open layar kecil jalan');
    cekLeftLayarkecil = '0';
    sidebar.forEach((element) => {
        element.style.left = cekLeftLayarkecil;
        element.style.transition = "left 0.5s ease";
        element.style.zIndex = '1000';
        element.classList.add('shadow-sidebar');
    });
    menuSidebar.forEach((element) => {
        element.classList.remove("sidebar-hide");
    });
    textSidebarNamaSekolah.forEach((element) => {
        element.classList.remove("sidebar-hide", "position-absolute");
    });
    textDashboardMenu.forEach((e) => {
        e.style.display = "block";
    });
    cekTombolSilangSidebar = '9px';
    divTombolSilang.style.top = cekTombolSilangSidebar;
    divTombolSilang.style.transition = "top 0.5s ease";
}

function tombolHideSidebarLayarKecil() {
    document.querySelector('.navbar-fixed').style.paddingRight = '0';
    // console.log('fungsi close sidebar layar kecil jalan');
    cekLeftLayarkecil = '-255px';
    cekTombolSilangSidebar = '-100px';
    divTombolSilang.style.top = cekTombolSilangSidebar;
    divTombolSilang.style.transition = "top 0.5s ease";
    sidebar.forEach((element) => {
        element.style.left = cekLeftLayarkecil;
        element.style.transition = "left 0.5s ease";
        element.classList.remove('shadow-sidebar');
    });

}

burgerOpen.addEventListener("click", function () {
    Open();
});
burgerClose.addEventListener("click", function () {
    Close();
});
burgerOpenLayarKecil.addEventListener("click", function () {
    OpenLayarKecil();
});
divTombolSilang.addEventListener("click", function () {
    tombolHideSidebarLayarKecil();

});

// col-lg
if (window.innerWidth >= 992) {
    LayarBesar();
} else {
    LayarKecil();
}

// Event listener untuk mengeksekusi kode saat ukuran layar berubah
window.addEventListener('resize', function () {
    if (window.innerWidth >= 992) {
        LayarBesar();
    } else {
        LayarKecil();
    }
});


function confirmClear() {
    if (confirm('Apakah Anda yakin ingin membersihkan field data yang telah terisi?')) {
        clearForm();
        return true;
    }
    return false;
}


function previewFile(event) {
    var fileInput = event.target;
    var file = fileInput.files[0];
    var previewFoto = document.getElementById('previewFoto');

    if (file && file.type.match('image.*')) {
        var reader = new FileReader();
        reader.onload = function () {
            previewFoto.src = reader.result;
            previewFoto.style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        previewFoto.src = ''; // Mengosongkan src untuk menghindari tampilan gambar sebelumnya
        previewFoto.alt = 'none';
        previewFoto.style.display = 'none'; // Menyembunyikan gambar ketika tidak ada file yang dipilih
    }
}

// Membuat dropdown pada sidebar
$(document).on('click', '#icon-super-admin', function () {
    dropdownSuperAdmin();
});

function dropdownSuperAdmin() {
    if (caretIcon.classList.contains('bi-caret-down')) {
        console.log('dropdown sistem hide');
        caretIcon.classList.remove('bi-caret-down');
        caretIcon.classList.add('bi-caret-right');
        dropdowns.forEach(function (dropdown) {
            dropdown.classList.add('d-none');
        });
    } else {
        console.log('dropdown sistem show');
        caretIcon.classList.remove('bi-caret-right');
        caretIcon.classList.add('bi-caret-down');
        dropdowns.forEach(function (dropdown) {
            dropdown.classList.remove('d-none');
        });
    }
}
