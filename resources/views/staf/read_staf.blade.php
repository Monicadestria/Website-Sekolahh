@extends('partials.main')
@section('content')
    <div class="">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 m-0">
                </div>
            </div>
        </div>
        <div class="row content flex-grow-1">
            <div class="col-12">
                <div class="card ">
                    <div class="card-header d-flex justify-content-between">
                        <a href="{{ route('galery.index') }}">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                        <h5 class="m-0 flex-grow-1 ms-2">Detail Data Staf</h5>
                    </div>

                    <div class="card-body" style="margin: 25px">
                        <div>
                            <div class="row">
                                <div class="col-4 col-md-2 p-0">
                                    <p>Nama</p>
                                </div>
                                <div class="col p-0">
                                    <p>: {{ $staf->name }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 col-md-2 p-0">
                                    <p>Kategori</p>
                                </div>
                                <div class="col p-0">
                                    <p>: {{ $staf->category->name }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 col-md-2 p-0">
                                    <p>NIP</p>
                                </div>
                                <div class="col p-0">
                                    <p>: {{ $staf->nip }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 col-md-2 p-0">
                                    <p>No HP</p>
                                </div>
                                <div class="col p-0">
                                    <p>: {{ $staf->phone_number }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 col-md-2 p-0">
                                    <p>Email</p>
                                </div>
                                <div class="col p-0">
                                    <p>: {{ $staf->email }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 col-md-2 p-0">
                                    <p>Status</p>
                                </div>
                                <div class="col p-0">
                                    <p>: {{ $staf->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</p>
                                </div>
                            </div>
                            <div class="row justify-content-end me-3 me-md-0">
                                <div class="col-1">
                                    <a href="{{ route('staf.edit', $staf->id) }}" class="btn btn-warning text-light">Ubah</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row content flex-grow-1 mt-3">
            <div class="col-12">
                <div class="card p-3">
                    <p class="text-center h5">File/Dokumen</p>
                    <div class="row m-0 mt-3 justify-content-center">
                        <div class="col text-center">
                            <img class="img-thumbnail w-50" src="{{ asset('storage/staff/' . $staf->photo) }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

