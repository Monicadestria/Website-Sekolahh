@extends('partials.main')
@section('content')
    <div class="container" style=" margin-top: 20px; padding-left: 20px; padding-right: 20px;">
        <div class="card">
            <h5 class="card-header">
                <a href="{{ route('theme.index') }}" style="color: black;">
                    <i class="bi bi-chevron-left"></i> Detail Data Tema
                </a>
            </h5>
            <div class="card-body">
                <div class="row">
                    <div class="col col-md-2">
                        <p>Nama</p>
                    </div>
                    <div class="col ms-md-5">
                        <p>: {{ $data->name }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col-auto col-md-5">
                                <p>Warna Tema Primer</p>
                            </div>
                            <div class="col">
                                <input class="form-control form-control-color" type="color" value="{{ $data->theme_color_primary }}">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col-auto col-md-5">
                                <p>Warna Font Primer</p>
                            </div>
                            <div class="col">
                                <input class="form-control form-control-color" type="color" value="{{ $data->font_color_primary }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col-auto col-md-5">
                                <p>Warna Tema Sekunder</p>
                            </div>
                            <div class="col">
                                <input class="form-control form-control-color" type="color" value="{{ $data->theme_color_secondary }}">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col-auto col-md-5">
                                <p>Warna Font Sekunder</p>
                            </div>
                            <div class="col">
                                <input class="form-control form-control-color" type="color" value="{{ $data->font_color_secondary }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col-auto col-md-5">
                                <p>Warna Tema Body</p>
                            </div>
                            <div class="col">
                                <input class="form-control form-control-color" type="color" value="{{ $data->theme_color_body }}">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col-auto col-md-5">
                                <p> </p>
                            </div>
                            <div class="col">
                                <p> </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col col-md-2">
                        <p>Deskripsi</p>
                    </div>
                    <div class="col ms-md-5">
                        <p>: {{ $data->desc }}</p>
                    </div>
                </div>
                
                <div class="text-end">
                    <a class="btn btn-warning text-light" href="{{ route('theme.edit', $data->id) }}">Ubah</a>
                </div>
            </div>
        </div>
    </div>
@endsection
