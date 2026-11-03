<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        'use strict';
        const loading = $('#loading');
        const dtb = $('#master').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ url('masterAjax') }}",
            columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, width: '50px' },
            { data: 'name', name: 'name', className: 'text-full-display', orderable: true },
            { data: 'type', name: 'type', className: 'text-full-display', orderable: true },
            { data: 'status', name: 'status', className: 'text-full-display', orderable: true },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false, className: 'text-center aksi-3' }
        ]

        });

        function resetModalState() {
            $('.modal-backdrop').remove();
        }

        function resetBodyScroll() {
            // Reset body scroll logic here if needed
        }

        // Debugging helper function
        function logModalState() {
            // Logging modal state if needed
        }

        $(document).on('click', '.btn-tambah-category', function() {
            var validationContainer = document.querySelector('.needs-validation');
            validationContainer.classList.remove('was-validated');
            $('#exampleModal').modal('show');
            $('.modal-backdrop').remove();
            $('body').append('<div class="modal-backdrop fade show custom-backdrop"></div>');
            $('#name').val('');
            $('#type').val('Berita');
            $('input[name="status"][value="1"]').prop('checked', true);
        });

        // Menangani Tombol Simpan Tambah Data
        $('.tombol-simpan').click(function(e) {
            e.preventDefault();
            var validationContainer = document.querySelector('.needs-validation');
            var name = $('#name').val();
            if (name.trim() === '') {
                validationContainer.classList.add('was-validated');
            } else {
                validationContainer.classList.remove('was-validated');
                $('#exampleModal').modal('hide');
                $.ajax({
                    url: 'masterAjax',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: name,
                        type: $('#type').val(),
                        status: $('input[name="status"]:checked').val()
                    },
                    beforeSend: function() {
                        loading.toggleClass('d-none d-flex');
                    },
                    success: function(response) {
                        dtb.ajax.reload();
                        let swalConfig = {
                            icon: response.icon,
                            title: response.title,
                            text: response.message
                        };
                        if (response.icon === 'success') {
                            swalConfig.timer = 3000;
                            swalConfig.timerProgressBar = true;
                        }
                        Swal.fire(swalConfig);
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'An error occurred while adding data: ' + error,
                        });
                    },
                    complete: function() {
                        loading.toggleClass('d-none d-flex');
                    }
                });
            }
        });

        // Tombol Batal
        $('#exampleModal').on('hidden.bs.modal', function(e) {
            $('#nameError').text(''); // Kosongkan pesan peringatan saat modal ditutup
            $('input[name="status"]').removeClass('radio-success'); // Hapus kelas saat modal ditutup
            resetModalState(); // Pastikan body dapat di-scroll
            resetBodyScroll(); // Reset body scroll
            logModalState();
        });

        // Menampilkan Modal Edit
        $(document).on('click', '.tombol-edit', function(e) {
            var validationContainers = document.querySelectorAll('.needs-validation-edit');
            validationContainers.forEach(function(validationContainer) {
                // Menambahkan class 'was-validated' ke setiap elemen
                validationContainer.classList.remove('was-validated');
            });
            var id = $(this).data('id');

            $.ajax({
                url: 'masterAjax/' + id + '/edit',
                type: 'GET',
                beforeSend: function() {
                    loading.toggleClass('d-none d-flex');
                },
                success: function(response) {
                    $('#editModal').modal('show');
                    $('#edit_name').val(response.result.name);
                    $('#edit_type').val(response.result.type);
                    $('input[name="edit_status"][value="' + response.result.status + '"]').prop('checked', true); // Atur nilai status
                    $('.tombol-update').data('id', id);
                },
                complete: function() {
                    loading.toggleClass('d-none d-flex');
                }
            });
        });

        // Menangani Tombol Simpan Edit Data
        $('.tombol-update').click(function(e) {
            e.preventDefault();
            var validationContainers = document.querySelectorAll('.needs-validation-edit');
            var id = $(this).data('id');
            var name = $('#edit_name').val();
            if (name.trim() === '') {
                validationContainers.forEach(function(validationContainer) {
                    // Menambahkan class 'was-validated' ke setiap elemen
                    validationContainer.classList.add('was-validated');
                });
            } else {
                validationContainers.forEach(function(validationContainer) {
                    // Menambahkan class 'was-validated' ke setiap elemen
                    validationContainer.classList.remove('was-validated');
                });
                $.ajax({
                    url: 'masterAjax/' + id,
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: $('#edit_name').val(),
                        type: $('#edit_type').val(),
                        status: $('input[name="edit_status"]:checked').val()
                    },
                    beforeSend: function() {
                        loading.toggleClass('d-none d-flex');
                    },
                    success: function(response) {
                        dtb.ajax.reload();
                        $('#editModal').modal('hide');
                        let swalConfig = {
                            icon: response.icon,
                            title: response.title,
                            text: response.message
                        };
                        if (response.icon === 'success') {
                            swalConfig.timer = 3000;
                            swalConfig.timerProgressBar = true;
                        }
                        Swal.fire(swalConfig);
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'An error occurred while updating data: ' + error,
                        });
                    },
                    complete: function() {
                        loading.toggleClass('d-none d-flex');
                    }
                });
            }
        });

        // Menangani Tombol Hapus
        $('body').on('click', '.tombol-del', function(e) {
            e.preventDefault();
            var id = $(this).data('id');

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
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'masterAjax/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        beforeSend: function() {
                            loading.toggleClass('d-none d-flex');
                        },
                        success: function(response) {
                            dtb.ajax.reload();
                            let swalConfig = {
                                icon: response.icon,
                                title: response.title,
                                text: response.message
                            };
                            if (response.icon === 'success') {
                                swalConfig.timer = 3000;
                                swalConfig.timerProgressBar = true;
                            }
                            Swal.fire(swalConfig);
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'An error occurred while deleting data: ' + error,
                            });
                        },
                        complete: function() {
                            loading.toggleClass('d-none d-flex');
                        }
                    });
                }
            });
        });
    });
</script>
