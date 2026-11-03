@extends('partials.main')
@section('content')
    @php
        $title = 'master';
    @endphp
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- content -->
    <style>
        .text-danger {
            color: red;
        }

        .radio-success {
            background-color: green !important;
        }
        
    </style>
    
    <div class="content-header">
        <div class="row mt-3">
            <div class="col-6">
                <h4 class="m-0 text-bawah-burger-menu ms-3">Kategori</h4>
            </div>
            <div class="col-6 d-flex justify-content-end" style="margin-left: -18px;">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Kategori</li>
                </ol>
            </div>
        </div>
    </div>
    
    <div class="row content flex-grow-1 px-1 ">
        <div class="col-12">
            <div class="card text-center">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="m-0">Data Kategori</h5>
                    <!-- Modal Tambah -->
                    <button type="button" class="btn btn-primary btn-tambah-category" >
                        Tambah Kategori
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content needs-validation">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3 row text-start">
                                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="nama" class="form-control "pattern=".*\S.*" id="name" name="name"
                                                required>
                                                <div class="invalid-feedback">
                                                    Perlu diisi
                                                   </div>
                                            {{-- <span id="nameError" class="text-danger"></span> --}}
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-2 text-start">
                                            <label for="type" class="col-form-label">Tipe</label>
                                        </div>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <select class="form-select" id="type" name="type">
                                                    <option value="Berita">Berita</option>
                                                    <option value="Galeri">Galeri</option>
                                                    <option value="Staf">Staf</option>
                                                    <option value="Unduh">Unduh</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-3 text-start">
                                        <label class="col-sm-2 col-form-label">Status</label>
                                        <div class="col-sm-10" id="status">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status_aktif" value="1" checked>
                                                <label class="form-check-label" for="status_aktif">Aktif</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status_nonaktif" value="0">
                                                <label class="form-check-label" for="status_nonaktif">Tidak Aktif</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary tombol-simpan">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container " style="margin-bottom: 40px;">
                    <div class="table-responsive mb-2 pt-0">
                        <table class="table table-bordered table-striped m-auto p-auto text-start"
                            style="margin: auto; padding: auto" id="master">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5px;">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col" width="200">Tipe</th>
                                    <th scope="col" width="200">Status</th>
                                    <th class="text-center" scope="col" width="120">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content needs-validation-edit">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Isi modal -->
                    <div class="mb-3 row text-start">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="nama" class="form-control" pattern=".*\S.*" id="edit_name" name="edit_name" required>
                            <div class="invalid-feedback">
                                Perlu diisi
                               </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-2 text-start">
                            <label for="type" class="col-form-label">Tipe</label>
                        </div>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <select class="form-select" id="edit_type" name="edit_type">
                                    <option value="Berita">Berita</option>
                                    <option value="Galeri">Galeri</option>
                                    <option value="Staf">Staf</option>
                                    <option value="Unduh">Unduh</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mt-3 text-start">
                            <label class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="edit_status"
                                        id="edit_status_aktif" value="1" checked>
                                    <label class="form-check-label" for="edit_status_aktif">Aktif</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="edit_status"
                                        id="edit_status_nonaktif" value="0">
                                    <label class="form-check-label" for="edit_status_nonaktif">Tidak Aktif</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary tombol-update">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Edit -->
    @include('category.script')
@endsection
