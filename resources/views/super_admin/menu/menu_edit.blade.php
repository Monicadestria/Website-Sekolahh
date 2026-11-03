@extends('partials.main')
@section('content')
    <div class="py-3 px-2">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                </div>
            </div>
        </div>
        <div class="row content flex-grow-1">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <a href="{{ route('menu.index') }}">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                        <h5 class="m-0 flex-grow-1 ms-2">Ubah Data Menu</h5>
                    </div>

                    <div class="card-body" style="margin: 25px">
                        <form class="needs-validation form-edit" action="{{ route('menu.update', ['id' => $data->id]) }}" method="post" enctype="multipart/form-data" novalidate>
                            @csrf
                            @method('PUT')

                            <div class="mb-3 row text-start">
                                <label for="name" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', $data->name) }}" required>
                                    <div class="invalid-feedback">
                                        Perlu diisi
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row text-start">
                                <label for="icon" class="col-sm-2 col-form-label">Ikon</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="icon" icon="icon"
                                        value="{{ old('icon', $data->icon) }}" required>
                                    <div class="invalid-feedback">
                                        Perlu diisi
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-sm-2 text-start">
                                    <label for="access_id" class="col-form-label">Akses</label>
                                </div>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <select class="form-select select2" id="access_id" name="access_id" required>
                                            <option disabled="disabled" value="">Pilih</option>
                                            @foreach ($access as $item)
                                                <option value="{{ $item->id }}" {{ $data->access_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Perlu memilih
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-sm-2 text-start">
                                    <label for="sequence" class="col-form-label">Urutan</label>
                                </div>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <select class="form-select" id="sequence" name="sequence" required>
                                            <option selected disabled="disabled" value="">Pilih</option>
                                            @foreach ($menus as $menu)
                                            <option value="{{ $menu->sequence }}" {{ $data->sequence == $menu->sequence ? 'selected' : '' }}>{{ $menu->sequence }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Perlu dipilih
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0">
                                <div class="col-md-2 m-0 p-0">
                                    <label class="form-label"> Status</label>
                                </div>
                                <div class="form-check col-auto ms-md-2">
                                    <input class="form-check-input" type="radio" name="status" id="aktif" value="1" {{ $data->status == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="aktif">
                                        Aktif
                                    </label>
                                </div>
                                <div class="form-check col-auto">
                                    <input class="form-check-input" type="radio" name="status" id="tidak_aktif" value="0" {{ $data->status == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tidak_aktif">
                                      Tidak Aktif
                                    </label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-5 m-0 p-0">
                                <a href="" class="btn btn-danger me-2" type="button">Batal</a>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
