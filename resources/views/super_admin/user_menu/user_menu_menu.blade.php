{{-- @dd($datas[1]->users[0]->pivot->user_id) --}}
@extends('partials.main')
@section('content')
    <div class="p-3 m-2">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0 text-bawah-burger-menu">{{ $user->name }} Menu</h4>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active">User Menu</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row content flex-grow-1">
            <div class="col-12">
                <div class="card text-center">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('user_menu.index') }}">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                            <h5 class="m-0 ms-2">Data {{ $user->name }} Menu</h5>
                        </div>
                        <div>
                            <button class="btn btn-primary" id="add-selected">Perbarui</button>
                        </div>
                    </div>

                    <div class="card-body text-start m-0 pt-0">
                        <div class="container table-responsive m-0 p-0">
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th width="5%"><input type="checkbox" id="checkAll"></th>
                                        <th width="5%" scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th class="text-center" width="20%" scope="col">Ikon</th>
                                        <th class="text-center" width="20%" scope="col">Link</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $item)
                                    <tr>
                                        <td><input class="rowCheckbox" type="checkbox" value="{{ $item->id }}" {{ isset($item->users[0]) ? 'checked' : '' }}></td>
                                        <th class="text-start">{{ $loop->iteration }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->icon }}</td>
                                        <td>{{ $item->access->name }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
<script>
    $(document).ready(function() {
        const loading = $('#loading');
        
        let dataTable = $('#myTable').DataTable();
        let checkedItems = {};

        dataTable.rows().every(function(rowIdx, tableLoop, rowLoop) {
            var row = $(this.node()); // Dapatkan elemen DOM dari baris
            var checkbox = row.find('input[type="checkbox"].rowCheckbox'); // Temukan checkbox di dalam baris
            var itemId = checkbox.val(); // Gunakan value checkbox sebagai itemId
            var isChecked = checkbox.prop('checked'); // Periksa apakah checkbox dicentang
            checkedItems[itemId] = isChecked; // Simpan status checkbox dalam objek
        });
        
        $('#checkAll').on('click', function() {
            let rows = dataTable.rows({ 'search': 'applied' }).nodes();
            let checked = this.checked;
            $('input[type="checkbox"]', rows).each(function () {
                this.checked = checked;
                let itemId = $(this).val();
                checkedItems[itemId] = checked;
            });
        });

        $('#myTable tbody').on('change', 'input[type="checkbox"]', function() {
            let itemId = $(this).val();
            checkedItems[itemId] = this.checked;

            if(!this.checked) {
                $('#checkAll').prop('checked', false);
            } else if($('input[type="checkbox"]:checked', dataTable.rows({ 'search': 'applied' }).nodes()).length === dataTable.rows({ 'search' : 'applied' }).nodes().length ) {
                $('#checkAll').prop('checked', true);
            }
        });

        $('#add-selected').click(function() {
            let checkedData = [];

            for (let key in checkedItems) {
                if (checkedItems[key]) {
                    checkedData.push(key);
                }
            }

            $.ajax({
                url: '{{ route("user_menu.menu_store", ["id" => $user->id]) }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    ids: checkedData,
                },
                beforeSend: function() {
                    loading.toggleClass('d-none d-flex');
                },
                success: function (response) {
                    Swal.fire({
                        icon: response.icon,
                        title: response.title,
                        text: response.message,
                    });
                },
                error: function(response) {
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
        });
    });
</script>
@endsection