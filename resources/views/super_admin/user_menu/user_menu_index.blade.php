@extends('partials.main')
@section('content')
    <div class="py-3 px-2">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0 text-bawah-burger-menu">User</h4>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active">User</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row content flex-grow-1">
            <div class="col-12">
                <div class="card text-center">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">Data User</h5>
                    </div>

                    <div class="card-body text-start m-0 pt-0">
                        <div class="container table-responsive m-0 p-0">
                            <table class="table table-bordered table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th width="5%" scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th class="" width="20%" scope="col">Email</th>
                                        <th class="" width="15%" scope="col">Status</th>
                                        <th class="text-center" width="20%" scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $item)
                                        <tr>
                                            <th class="text-start">{{ $loop->iteration }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            {{-- <td>{{ $item->status }}</td> --}}
                                            <td class="">
                                                <p>{{ $item->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</p>
                                            </td>
                                            <td class="text-center">
                                                <li class="list-group-item justify-content-evenly align-items-center">
                                                    <div>
                                                        <a href="{{ route('user_menu.menu', ['id' => $item->id]) }}" type="button"
                                                            class="btn btn-sm btn-success text-light" title="Menu">
                                                            <i class="bi bi-grid-fill"></i>
                                                        </a>

                                                        <a href="{{ route('user_menu.access', ['id' => $item->id]) }}" type="button"
                                                            class="btn btn-sm btn-primary text-light" title="Link">
                                                            <i class="bi bi-gear-fill"></i>
                                                        </a>

                                                        <form class="form-delete d-inline" action="{{ route('user_menu.delete', ['id' => $item->id]) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button class="btn btn-sm btn-danger text-light" type="submit">
                                                                <i class="bi bi-trash-fill"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </li>
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
