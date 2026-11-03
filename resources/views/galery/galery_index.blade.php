@extends('partials.main')
@section('content')
    <div class="px-1 mt-2 py-2">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-0">
                    <div class="col-6">
                        <h4 class="m-0 text-bawah-burger-menu">Galeri</h4>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item text-bawah-burger-menu"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Galeri</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row content flex-grow-1">
            <div class="col-12">
                <div class="card text-center">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">Data Galeri</h5>
                        <a href="{{ route('galery.create') }}" class="btn btn-primary">Tambah Galeri</a>
                    </div>

                    <div class="card-body text-start m-0 pt-0">
                        <div class="container table-responsive m-0 p-0">
                            <table class="table table-bordered table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th width="5%" scope="col">No</th>
                                        <th scope="col">Judul</th>
                                        <th class="" width="10%" scope="col">Tipe</th>
                                        <th class="" width="15%" scope="col">Status</th>
                                        <th class="text-center" width="15%" scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $item)
                                        <tr>
                                            <th class="text-start">{{ $loop->iteration }}</th>
                                            <td class="text-full-display">{{ $item->title }}</td>
                                            <td class="text-full-display">{{ $item->type == 'photo' ? 'Gambar' : 'Video' }}</td>
                                            <td class="text-full-display">
                                                <p>{{ $item->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</p>
                                            </td>
                                            <td class="text-center aksi-3">
                                                <li class="list-group-item justify-content-evenly align-items-center">
                                                    <div>
                                                        <a href="{{ route('galery.show', ['id' => $item->id]) }}" type="button"
                                                            class="btn btn-sm btn-primary text-light" title="Show">
                                                            <i class="bi bi-eye-fill"></i>
                                                        </a>

                                                        <a href="{{ route('galery.edit', ['id' => $item->id]) }}" type="button"
                                                            class="btn btn-sm btn-warning text-light" title="Edit">
                                                            <i class="bi bi-pencil-fill"></i>
                                                        </a>

                                                        <form class="form-delete d-inline" action="{{ route('galery.delete', ['id' => $item->id]) }}" method="post">
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
