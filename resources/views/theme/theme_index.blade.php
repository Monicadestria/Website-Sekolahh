@extends('partials.main')
@section('content')
    <!-- content -->
    <div class="px-1 py-3">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-0">
                    <div class="col">
                        <h4 class="m-0 text-bawah-burger-menu">Tema</h4>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item text-bawah-burger-menu"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tema</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row content flex-grow-1">
            <div class="col-12">
                <div class="card text-center">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">Data Tema</h5>
                        <a href="{{ route('theme.create') }}" class="btn btn-primary">Tambah Tema</a>
                    </div>

                    <div class="card-body m-0 p-0">
                      <div class="container mb-5 m-0 py-0">
                          <div class="table-responsive text-start m-0 p-0">
                              <table class="table table-bordered table-striped m-0 p-0" id="myTable">
                                  <thead>
                                      <tr>
                                          <th width="5%" scope="col">No</th>
                                          <th scope="col">Nama</th>
                                          <th class="" width="15%" scope="col">Status</th>
                                          <th class="text-center" width="20%" scope="col">Aksi</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($datas as $item)
                                          <tr>
                                              <th class="text-start" scope="row">{{ $loop->iteration }}</th>
                                              <td class="text-full-display">{{ $item->name }}</td>
                                              <td class="text-full-display">
                                                {{ $item->status == 1 ? 'Digunakan' : 'Tidak Digunakan' }}
                                              </td>
                                              <td class="text-center aksi-4">
                                                  <li class="list-group-item justify-content-evenly align-items-center">
                                                      <a href="{{ route('theme.show', ['id' => $item->id]) }}"
                                                        class="btn btn-sm btn-primary text-light" title="Use">
                                                        <i class="bi bi-eye"></i>
                                                      </a>

                                                      <form class="d-inline form-edit" action="{{ route('theme.use', ['id' => $item->id]) }}">
                                                            @csrf
                                                            @method('PUT')

                                                            <button class="btn btn-sm btn-success" type="submit">
                                                                <i class="bi bi-check-circle"></i>
                                                            </button>
                                                      </form>

                                                      <a href="{{ route('theme.edit', ['id' => $item->id]) }}"
                                                          class="btn btn-sm btn-warning text-light" title="Edit">
                                                          <i class="bi bi-pencil-fill"></i>
                                                      </a>

                                                      <form class="d-inline form-delete" method="post" action="{{ route('theme.delete', ['id' => $item->id]) }}">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button class="btn btn-sm btn-danger text-light" type="submit">
                                                          <i class="bi bi-trash-fill"></i>
                                                       </button>
                                                      </form>
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
    </div>
@endsection
