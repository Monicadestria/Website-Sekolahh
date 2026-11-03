@extends('partials.main')
@section('content')
    
<div class="content-header">
    <div class="row mt-3">
        <div class="col-6">
            <h4 class="m-0 ms-3 text-bawah-burger-menu">Staf</h4>
        </div>
        <div class="col-6 d-flex justify-content-end pe-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard </a></li>
                <li class="breadcrumb-item active">Staf</li>
            </ol>
        </div>
    </div>
</div>

<div class="card bg-light mt-0 mb-3 mx-1">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title my-auto">
            <i class="fa fa-table"></i>Data Staf</h5>
        <span>
            <a href="{{ route('staf.create') }}" class="btn btn-primary">
                <i></i>Tambah Staf</a>
        </span>
    </div>
    <!-- /.Card-Body -->
    <div class="card-body mt-0 pt-0">
        <div class="table-responsive mb-2">
            <table id="myTable" class="table table-bordered table-striped">
                <thead class="mt-2">
                    <tr>
                        <th class="text-start" width="5%">No</th>
                        <th class="text-start" width="25%">Nama</th>
                        <th class="text-start" width="15%">Kategori</th>
                        <th class="text-start" width="15%">NIP</th>
                        <th class="text-start" width="8%">Status</th>
                        <th class="text-center" width="14%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($staf as $stf)
                <tr>
                    <td class="text-start">{{ $loop->iteration }}</td>
                    <td class="text-start text-full-display">{{ $stf->name }}</td>
                    <td class="text-start text-full-display">{{ $stf->category->name }}</td>
                    <td class="text-start text-full-display">{{ $stf->nip }}</td>
                    <td class="text-start text-full-display">
                        <form action="{{ route('staf.status', ['id' => $stf->id]) }}" method="POST">
                        @csrf
                        </form>
                        <div>{{ $stf->status ? 'Aktif' : 'Tidak Aktif' }}</div>
                    </td>
                    <td class="text-center aksi-3">
                        <a href="{{ route('staf.show', $stf->id) }}" title="Lihat" class="btn btn-primary btn-sm">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        <a href="{{ route('staf.edit', $stf->id) }}" title="Ubah" class="btn btn-warning btn-sm text-light">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        {{-- <a href="{{ route('staf.delete', $stf->id) }}" onclick="confirmDelete(event, 'Hapus Data!', 'Apakah kamu yakin menghapus data ini?', '{{ route('staf.delete', $stf->id) }}')"
                            title="Hapus" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i>
                        </a> --}}
                        <form class="d-inline form-delete" method="post" action="{{ route('staf.delete', ['id' => $stf->id]) }}">
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
