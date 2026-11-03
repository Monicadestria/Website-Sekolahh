@extends('partials.main')
@section('content')
    <div class="py-3 px-2">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0 text-bawah-burger-menu">Akses</h4>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Akses</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row content flex-grow-1">
            <div class="col-12">
                <div class="card text-center">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">Data Akses</h5>
                        <button class="btn btn-primary" type="button" id="btn-sync">Perbarui</button>
                    </div>

                    <div class="card-body text-start m-0 pt-0">
                        <div class="container table-responsive m-0 p-0">
                            <table class="table table-bordered table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th width="5%" scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Path</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $item)
                                        <tr>
                                            <th class="text-start">{{ $loop->iteration }}</th>
                                            <td>
                                                {{ get_url_name($item->name) }}
                                            </td>
                                            <td>
                                                {{ get_url_path($item->name) }}
                                            </td>
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
    $(document).ready(function () {
        const loading = $('#loading');
        let dataTable = $('#myTable').DataTable();

        $('#btn-sync').click(function (e) {
            $.ajax({
                url: '{{ route("access.sync") }}',
                method: 'GET',
                beforeSend: function () {
                    loading.toggleClass('d-none d-flex')
                },
                success: function (response) {                    
                    dataTable.clear().draw();

                    response.data.forEach( function (item, index) {
                        dataTable.row.add([
                            index + 1,
                            item.name,
                        ]).draw(false);
                    });

                    Swal.fire({
                        icon: response.icon,
                        title: response.title,
                        text: response.message,
                    });
                },
                error: function (response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'An error occured while deleting data: ' + xhr.responseText,
                    });
                },
                complete: function () {
                    loading.toggleClass('d-none d-flex')
                },
            });
        }); 
    });
</script>
@endsection