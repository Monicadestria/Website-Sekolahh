@extends('partials.lp.main')

@section('content')
<div class="card-body mb-5 p-0">
    <div class="row mt-4 mx-2 mb-2">
        <div class="col-12 col-md-3 mb-2 mr-2">
            <div class="d-flex align-items-center">
                <label for="downloads-table_length" class="col-form-label flex-grow-0">Tampilkan </label>
                <select id="downloads-table_length" class="form-select form-select-sm flex-grow-0 ms-2" style="width: 70px;">
                    @for ($i = 10; $i <= 100; $i+=10)
                        <option value="{{ $i }}" {{ $i == $length ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
                <label for="downloads-table_length" class="col-form-label flex-grow-0 ms-2"> Keseluruhan</label>
            </div>
        </div>

        <div class="col-12 col-md-4 mb-2 ms-0 mx-2">
            <div class="d-flex align-items-center">
                <label class="col-form-label flex-grow-0">Kategori&nbsp;:</label>
                <select class="form-select form-select-sm ms-2" id="s_category" name="s_category" style="width: auto;">
                    <option value="Semua" {{ $s_category == 'Semua' ? 'selected' : '' }}>Semua</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $s_category == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-12 col-md-2 mb-2 ms-auto">
            <div class="d-flex align-items-center justify-content-end">
                <label for="downloads-table_filter" class="col-form-label flex-grow-0">Cari&nbsp;:</label>
                <input id="downloads-table_filter" type="search" class="form-control form-control-sm flex-grow-1 ms-2" placeholder="">
            </div>
        </div>
    </div>

    <div class="table-responsive mt-1 mx-3 p-0">
        <table id="downloads-table" class="table table-bordered w-100 mb-3 p-0">
            <thead>
                <tr>
                    <th width="5%" class="text-center">No</th>
                    <th width="30%" class="text-start">Judul</th>
                    <th class="text-start">Deskripsi</th>
                    <th width="130px" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

@section('js')
<script type="text/javascript">
$(document).ready(function() {
    let table = $('#downloads-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        searching: false, // Disable search input
        lengthChange: false, // Disable length menu
        ajax: {
            url: '{{ route('lp.unduh.index', ['slug' => $settings->slug]) }}',
            data: function(d) {
                d.s_category = $('#s_category').val(); // Add category to ajax parameters
                d.length = $('#downloads-table_length').val(); // Add length to ajax parameters
                d.search = $('#downloads-table_filter').val(); // Add search to ajax parameters
            },
            error: function(xhr, error, thrown) {
                console.error('Error: ' + error);
                console.error('Thrown: ' + thrown);
                console.error('Response Text: ' + xhr.responseText);
                alert('Error loading data');
            }
        },
        columns: [
            { data: 'no', name: 'no' },
            { data: 'title', name: 'title' },
            { data: 'desc', name: 'desc' },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
        ]
    });

    // Update s_category value when dropdown changes
    $('#s_category').on('change', function() {
        table.draw();
    });

    // Update length value when dropdown changes
    $('#downloads-table_length').on('change', function() {
        table.page.len($(this).val()).draw();
    });

    // Hide DataTable processing indicator
    $('#downloads-table').on('processing.dt', function(e, settings, processing) {
        if (settings.nTable.id === 'downloads-table') {
            $('#downloads-table_processing').hide();
        }
    });

    // Refresh table without refreshing the page
    function refreshTable() {
        table.ajax.reload(null, false); // Use 'false' to maintain current page
    }

    // Periodically refresh or redraw the table (every 3 seconds)
    setInterval(refreshTable, 3000); // 3000 milliseconds = 3 seconds

    // Handle form submission for download initiation
    $('form[id^="download-form-"]').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);
        var formData = form.serialize();
        var slug = form.find('input[name="slug"]').val();
        var id = form.find('input[name="id"]').val();
        var actionUrl = '{{ url("' + slug + '/download/click/' + id + '") }}';

        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            success: function(response) {
                // Handle success response
                alert('Download initiated successfully');
                // Optionally, redirect to the download link or show a success message
            },
            error: function(xhr) {
                // Handle error response
                alert('Error initiating download');
            }
        });
    });

    // Debounce function for search input
    function debounce(func, wait) {
        let timeout;
        return function() {
            const context = this;
            const args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                func.apply(context, args);
            }, wait);
        };
    }

    // Apply debounce on search input
    $('#downloads-table_filter').on('keyup', debounce(function() {
        table.search($(this).val()).draw();
    }, 300)); // Adjust debounce time as needed (e.g., 300 ms)

    // Refresh categories without refreshing the page
    function refreshCategories() {
        $.ajax({
            url: '{{ route('lp.unduh.category', ['slug' => $settings->slug] ) }}',
            method: 'GET',
            success: function(data) {
                var $select = $('#s_category');
                var selectedValue = $select.val();
                $select.empty();
                $select.append('<option value="Semua">Semua</option>');
                $.each(data, function(index, category) {
                    var selected = category.id == selectedValue ? 'selected' : '';
                    $select.append('<option value="' + category.id + '" ' + selected + '>' + category.name + '</option>');
                });
            },
            error: function() {
                console.log('Gagal merefresh data kategori.');
            }
        });
    }

    setInterval(refreshCategories, 3000); // Refresh data setiap 3 detik
});
</script>
@endsection

@endsection
