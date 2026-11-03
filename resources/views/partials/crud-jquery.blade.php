<script>
    $(document).ready(function() {
        const loading = $('#loading');

        (() => {
            'use strict'

            const forms = $('.needs-validation')

            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, true)
            })
        })()

        $('#form-create').submit(function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const route = $('#form-create').attr('action');

            @php
                $route_name = Route::currentRouteName();
                $redirect = explode('.', $route_name);
                $redirect = $redirect[0] . '.index';
            @endphp

            const route_name = "{{ $route_name }}";
            const redirect = "{{ $redirect }}";

            $.ajax({
                url: route,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function (params) {
                    loading.toggleClass('d-none d-flex');                    
                },
                success: function(response) {
                    let swalConfig = {
                        icon: response.icon,
                        title: response.title,
                        text: response.message
                    };
                    if (response.icon === 'success') {
                        swalConfig.timer = 3000;
                        swalConfig.timerProgressBar = true;
                    }
                    Swal.fire(swalConfig).then(() => {
                        if ( route_name == 'section.detail') {
                            if (response.icon == 'success' || response.icon == 'error') {
                                window.location.reload();
                            }else{
                            //  icon warning masih ditempat   
                            }
                        } else if(redirect != route_name && response.icon == 'success') {
                            window.location.href = "{{ route($redirect) }}";
                        }
                    });

                    $('#form-create').removeClass('was-validated')
                },

                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'An error occurred while adding data: ' + error,
                    })

                    $('#form-create').removeClass('was-validated')
                },

                complete: function () {
                    loading.toggleClass('d-none d-flex');
                }
            });
        });

        $('.form-edit').submit(function(e) {
            e.preventDefault();

            @php
                $route_name = Route::currentRouteName();
                $redirect = explode('.', $route_name);
                $redirect = $redirect[0] . '.index';
            @endphp

            const form = $(this); 
            const route = form.attr('action');
            const route_name = "{{ $route_name }}";
            const redirect = "{{ $redirect }}";

            $.ajax({
                url: route,
                type: "POST",
                data: new FormData(form[0]),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    loading.toggleClass('d-none d-flex');
                },
                success: function(response) {
                    let swalConfig = {
                        icon: response.icon,
                        title: response.title,
                        text: response.message
                    };
                    if (response.icon === 'success') {
                        swalConfig.timer = 3000;
                        swalConfig.timerProgressBar = true;
                    }
                    Swal.fire(swalConfig).then(() => {
                        if (route_name == 'section.detail') {
                            if (response.icon == 'success' || response.icon == 'error') {
                                window.location.reload();
                            }else{
                            //  icon warning masih ditempat   
                            }
                        } else if (redirect != route_name && response.icon == 'success') {
                            window.location.href = "{{ route($redirect) }}";
                        } else {
                            window.location.reload()
                        }
                    });

                    form.removeClass('was-validated');
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'An error occurred while updating data: ' + error,
                    });

                    form.removeClass('was-validated');
                },
                complete: function () {
                    loading.toggleClass('d-none d-flex');
                }
            });
        });

        $('body').on('submit', '.form-delete', function(e) {
            e.preventDefault()

            Swal.fire({
                icon: 'warning',
                title: 'Hapus?',
                text: 'Apakah Anda yakin?',
                showCancelButton: true,
                confirmButtonText: 'Ya, yakin',
                cancelButtonColor: "#d33",
                cancelButtonText: "Batal",
                reverseButtons: true,  
                confirmButtonColor: "#3085d6",
            }).then((result) => {
                if(result.isConfirmed) {
                    
                    @php
                        $route_name = Route::currentRouteName();
                        $redirect = explode('.', $route_name);
                        $redirect = $redirect[0] . '.index';
                    @endphp

                    const form = $(this)
                    const formData = $(this).serialize()
                    const route = $(this).attr('action')
                    const route_name = "{{ $route_name }}"
                    const redirect = "{{ $redirect }}"

                    $.ajax({
                        url: route,
                        type: "POST",
                        data: formData,
                        beforeSend: function() {
                            loading.toggleClass('d-none d-flex');
                        },
                        success: function(response) {
                            let swalConfig = {
                                icon: response.icon,
                                title: response.title,
                                text: response.message
                            };
                            if (response.icon === 'success') {
                                swalConfig.timer = 3000;
                                swalConfig.timerProgressBar = true;
                            }
                            Swal.fire(swalConfig).then(() => {
                                if (route_name == 'section.detail') {
                                    if(response.icon == 'success'){
                                        window.location.reload();
                                    }else{
                                        // jangan dihapus else nya untuk menangani icon error
                                    }
                                }else if(route_name != redirect) {
                                    window.location.href = redirect
                                }  else {
                                    if(response.icon == 'success') {
                                        form.closest('tr').remove();

                                        // Mengupdate DataTable
                                        var table = $('.sekolah').DataTable();
                                        table.draw();

                                         // Menghitung jumlah baris dalam tabel kecuali header
                                        var rowCount = $('table tbody tr').length;

                                        // Menghitung jumlah kolom (th) dalam tabel
                                         var colCount = $('table th').length;

                                        // Jika tidak ada baris tersisa, tambahkan satu baris dengan pesan
                                        if (rowCount === 0) {
                                            $('table tbody').append('<tr><td class="text-center" colspan="' + colCount + '">Tidak ada data yang tersedia dalam tabel</td></tr>');
                                        } else {
                                            // Mengupdate nomor kolom
                                            $('.number_columns').each((i, el) => {
                                                $(el).html(i + 1);
                                            });
                                        }
                                    }
                                }

                            });
                            
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'An error occured while deleting data: ' + xhr.responseText,
                            })
                        },
                        complete: function() {
                            loading.toggleClass('d-none d-flex');
                        },
                    });
                }
            });
        });
        
        //   -------- Alert Warning Otomatis Validasi JS Spasi & Hanya Spasi  ------------ 
        $(document).ready(function() {
            $('.unavailable').on('blur', function() {
                var unduhInput = $(this).val().trim();
                if (unduhInput === '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian!',
                        text: 'Data tidak boleh kosong atau hanya berupa spasi.',
                    });
                }
            });
        });

        // function validateForm($fields) {
        //   const fields = [
        //     'school_name',
        //     'post_code',
        //   ];

        //   let errorCount = 0;

        //   fields.forEach(field => {
        //     if($('#'+field).val()== '') {
        //       errorCount = errorCount + 1;

        //       // $('#'+field+'_feedback').removeClass('d-none');
        //       // $('#'+field).addClass('is-invalid');
        //     }

        //   });

        //   if(errorCount > 0) {
        //     $('#loading').removeClass('d-flex');
        //     $('#loading').addClass('d-none');
        //     Swal.fire({
        //         icon: 'error',
        //         title: 'Gagal!',
        //         text: 'Periksa kembali data yang anda masukan',
        //     })
        //     return false;
        //   }

        //   console.log('success');
        //   return true;
        // }
    });
</script>
