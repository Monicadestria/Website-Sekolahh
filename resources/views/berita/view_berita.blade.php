@extends('partials.main')
@section('content')

<div class="content-header">
    <div class="row mt-3">
        <div class="col-6">
            <h4 class="m-0 ms-3 text-bawah-burger-menu">Berita</h4>
        </div>
        <div class="col-6 d-flex justify-content-end pe-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Berita</li>
            </ol>
        </div>
    </div>
</div>

<div class="card bg-light mt-0 mb-3 mx-1">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title my-auto">
            <i class="fa fa-table"></i>Data Berita</h5>
        <span>
            <a href="{{ route('berita.create') }}" class="btn btn-primary">
                <i></i>Tambah Berita</a>
        </span>
    </div>
    <!-- /.Card-Body -->
    <div class="card-body mt-0 pt-0">
        <div class="table-responsive mb-2">
            <table id="myTable" class="table table-bordered table-striped m-auto p-auto">
                <thead class="mt-2">
                    <tr>
                        <th class="text-start" width="1%">No</th>
                        <th width="25%">Judul</th>
                        <th width="10%">Kategori</th>
                        <th width="15%">Slug</th>
                        <th class="text-start" width="8%">Status</th>
                        <th class="text-center" width="8%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($berita as $brt)
                    <tr>
                        <td class="text-start ">{{ $loop->iteration }}</td>
                        <td class="text-start text-full-display">{{ $brt->title }}</td>
                        <td class="text-start text-full-display">{{ $brt->categoryBerita->name }}</td>
                        <td class="text-start text-full-display">{{ $brt->slug }}</td>
                        <td class="text-start text-full-display">
                            <form action="{{ route('berita.status', ['id' => $brt->id]) }}" method="POST">
                            @csrf
                            </form>
                            <div>{{ $brt->status ? 'Publish' : 'Draft' }}</div>
                        </td>
                        <td class="text-center aksi-3">
                            <a href="{{ route('berita.show', $brt->id) }}" title="Lihat" class="btn btn-primary btn-sm">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <a href="{{ route('berita.edit', $brt->id) }}" title="Ubah" class="btn btn-warning btn-sm text-light">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form class="d-inline form-delete" method="post" action="{{ route('berita.delete', ['id' => $brt->id]) }}">
                                @csrf
                                @method('DELETE')
    
                                <button class="btn btn-sm btn-danger text-light" type="submit">
                                  <i class="bi bi-trash-fill"></i>
                               </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.Card-Body -->
</div>
@endsection
