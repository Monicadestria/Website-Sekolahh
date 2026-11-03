// script sections/index.blade.php
$(document).ready(function () {
    // Mengatur lebar setiap elemen berdasarkan data-width
    $('.garis-section').each(function () {
        $(this).css('width', $(this).data('width') + '%');
        $(this).attr('style', function (i, style) {
            return (style || '') + 'border-width: ' + $(this).data('border-width') + 'px !important;';
        });
        $(this).css('--border-color', $(this).data('color'));
    });

    $('.section-partials').each(function () {
        $(this).css('marginTop', $(this).data('marginTop') + "px");
        $(this).css('marginBottom', $(this).data('marginBottom') + "px");
    });

    $('.contentTrix-partial').each(function () {
        $(this).addClass($(this).data('paddingLeft'));
        const firstElement = $(this).children().first();
        if (firstElement.prop('tagName').toLowerCase() === 'h1') {
            firstElement.css('marginTop', '-3px');
        } else {
            firstElement.css('marginTop', '4px');
        }
    });

    function layarMd768Px() {
        $('.ghp-content-trix-partial').each(function () {
            $(this).addClass($(this).data('paddingRight')).removeClass("text-center");
        });
        $('.gambaratasbawah-ghp-partial').each(function () {
            $(this).addClass($(this).data('marginRight'));
        });
        $('.ghp-content-trix-partial ul li, .ghp-content-trix-partial ol li').removeClass('text-start');
    }

    function layarKurang768Px() {
        $('.ghp-content-trix-partial').each(function () {
            $(this).removeClass($(this).data('paddingRight')).addClass("text-center");
        });
        $('.gambaratasbawah-ghp-partial').each(function () {
            $(this).removeClass($(this).data('marginRight'));
        });
        $('.ghp-content-trix-partial ul li, .ghp-content-trix-partial ol li').addClass('text-start');
    }

    // col-md
    if ($(window).width() >= 768) {
        layarMd768Px();
    } else {
        layarKurang768Px();
    }

    // Event listener untuk mengeksekusi kode saat ukuran layar berubah
    $(window).resize(function () {
        if ($(window).width() >= 768) {
            layarMd768Px();
        } else {
            layarKurang768Px();
        }
    });
});

