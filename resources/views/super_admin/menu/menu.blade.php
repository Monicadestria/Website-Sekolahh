@extends('partials.main')
@section('content')
    <div class="p-3 m-2">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0 text-bawah-burger-menu">Menu</h4>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Menu</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row content flex-grow-1">
            <div class="col-12">
                <div class="card text-center">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">Data Menu</h5>
                        <a href="{{ route('menu.create') }}" class="btn btn-primary">Tambah Menu</a>
                    </div>

                    <div class="card-body text-start m-0 pt-0">
                        <div class="container table-responsive p-0 m-0">
                            <table class="table table-bordered table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th width="5%" scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th class="text-start" width="10%" scope="col">Ikon</th>
                                        <th class="text-start" width="20%" scope="col">Rute</th>
                                        <th class="text-start" width="10%" scope="col">Urutan</th>
                                        <th class="text-start" width="15%" scope="col">Status</th>
                                        <th class="text-center" width="15%" scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $item)
                                        <tr>
                                            <th class="text-start">{{ $loop->iteration }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td class="text-center">
                                                <i class="bi {{ $item->icon }} fs-1"></i>
                                            </td>
                                            <td>{{ $item->access->name }}</td>
                                            <td class="text-start">{{ $item->sequence }}</td>
                                            <td class="text-start">
                                                <p>{{ $item->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</p>
                                            </td>
                                            <td class="text-center">
                                                <li class="list-group-item justify-content-evenly align-items-center">
                                                    <div>
                                                        <a href="{{ route('menu.edit', ['id' => $item->id]) }}" type="button"
                                                            class="btn btn-sm btn-warning text-light" title="Edit">
                                                            <i class="bi bi-pencil-fill"></i>
                                                        </a>

                                                        <form class="form-delete d-inline" action="{{ route('menu.delete', ['id' => $item->id]) }}" method="post">
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
