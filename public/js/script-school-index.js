$(document).ready(function () {

  function navbarSekolah() {
    if ($(window).scrollTop() > 0 || $(window).width() < 768) {
      $('#navbar').addClass('bg-slate-100 py-0 shadow-xl');
      $('#navbar-href').removeClass('text-white');
      $('.navbar-md-ke-atas').removeClass('hover:text-gray-700').addClass('hover:text-sky-500');
      $('.navbar-md-ke-atas.active').removeClass('text-gray-700').addClass('text-sky-500');
      $('.navbar-md-ke-atas.inactive').removeClass('text-gray-700').removeClass('text-sky-500');
      $('.underline-navbar').removeClass('border-gray-700 ').addClass('border-sky-500');
      $('#logo').attr('src', $('#logo').data('logo-src-warna'));
      //  console.log('scroll bawah / width < 768');
    } else {
      $('#navbar').removeClass('bg-slate-100 py-0 shadow-xl');
      $('#navbar-href').addClass('text-white');
      $('.navbar-md-ke-atas').addClass('hover:text-gray-700').removeClass('hover:text-sky-500');
      $('.navbar-md-ke-atas.active').addClass('text-gray-700').removeClass('text-sky-500');
      $('.navbar-md-ke-atas.inactive').removeClass('text-gray-700').removeClass('text-sky-500');
      $('.underline-navbar').addClass('border-gray-700 ').removeClass('border-sky-500');
      $('#logo').attr('src', $('#logo').data('logo-src-putih'));
      //  console.log('paling atas');
    }
  }

  function handleNavbarLink(currLink, navbar) {
    var targetId = currLink.attr('href');
    var refElement = $(targetId);
    var scrollPos = $(document).scrollTop();

    if (refElement.length) {
      var refElementTop = refElement.offset().top;
      var refElementBottom = refElementTop + refElement.outerHeight();

      if (refElementTop <= scrollPos && refElementBottom >= scrollPos) {
        // Tambahkan kelas active pada elemen yang sedang dilihat
        currLink.addClass('active').removeClass('inactive');
        // Hapus kelas active dari elemen lainnya
        $(navbar).not(currLink).removeClass('active').addClass('inactive');
      }

      // Mengatur kelas border
      if (currLink.hasClass('active')) {
        currLink.find('.underline-navbar').removeClass('border-transparent');
      } else {
        currLink.find('.underline-navbar').addClass('border-transparent');
      }
    }
  }

  $(window).on('scroll', function () {
    var scrollPos = $(document).scrollTop();
    $('.navbar-href-stay').each(function () {
      handleNavbarLink($(this), '.navbar-href-stay');
    });

    $('.navbar-href-stay-2').each(function () {
      handleNavbarLink($(this), '.navbar-href-stay-2');
    });

    navbarSekolah();
  });

  // Trigger scroll event on page load to set the initial active class
  $(window).trigger('scroll');

  // Menangani resize dan scroll
  $(window).on('resize', function () {
    navbarSekolah();
  });

  // Menangani klik pada menu-toggle
  $('#menu-toggle').on('click', function () {
    $('#mobile-menu').toggleClass('hidden');
  });

  //  scorll ke #
  $('a[href^="#"]').on('click', function (e) {
    e.preventDefault();

    var target = this.hash;
    var $target = $(target);
    // let offset = (target == '#detail' || target == '#tim') ? 5 : 0;
    let offset = (target != '#beranda') ? 7 : 0;
    // console.log(offset);
    $('html, body').animate({
      scrollTop: $target.offset().top + offset
    }, 755, 'swing', function () {
      // window.location.hash = target; // Ini yang menyebabkan scroll otomatis
      // Alternatif: Memperbarui hash tanpa menggulir
      if (history.pushState) {
        history.pushState(null, null, target);
      } else {
        location.hash = target;
      }
    });
  });

  // swiper
  if ($('.card-slider').length) {
    var cardSlider = new Swiper('.card-slider', {
      autoplay: {
        delay: 4000,
        disableOnInteraction: false
      },
      loop: true,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      slidesPerView: 3,
      spaceBetween: 70,
      //  grabCursor: true, // Enable grab cursor for mouse
      simulateTouch: true, // Enable simulate touch for mouse
      breakpoints: {
        // when window is <= 767px
        767: {
          slidesPerView: 1
        },
        // when window is <= 1023px
        1023: {
          slidesPerView: 2,
          spaceBetween: 40
        }
      }
    });
  }
});