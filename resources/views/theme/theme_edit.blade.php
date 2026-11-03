@extends('partials.main')
@section('content')
    <div class="px-2 py-3">
        <div class="card">
            <h5 class="card-header">
                <a href="{{ route('theme.index') }}" style="color: black;">
                    <i class="bi bi-chevron-left"></i> Ubah Data Tema
                </a>
            </h5>
            <div class="card-body">
                <form class="needs-validation form-edit" method="post"
                    action="{{ route('theme.update', ['id' => $data->id]) }}" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $data->name) }}" pattern=".*\S.*" required>
                            <div class="invalid-feedback">
                                Perlu di isi
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row align-items-center">
                        <label for="theme_color_primary" class="col-sm-3 col-form-label">Warna Tema Primer</label>
                        <div class="col-sm-3">
                            <input type="color" class="form-control form-control-color" id="theme_color_primary"
                                value="{{ old('theme_color_primary', $data->theme_color_primary) }}" style="width: 80px;"
                                name="theme_color_primary">
                        </div>
                        <label for="font_color_primary" class="col-sm-3 col-form-label">Warna Font Primer</label>
                        <div class="col-sm-3">
                            <input type="color" class="form-control form-control-color" id="font_color_primary"
                                value="{{ old('font_color_primary', $data->font_color_primary) }}" style="width: 80px;"
                                name="font_color_primary">
                        </div>
                    </div>
                    <div class="mb-3 row align-items-center">
                        <label for="theme_color_secondary" class="col-sm-3 col-form-label">Warna Tema Sekunder</label>
                        <div class="col-sm-3">
                            <input type="color" class="form-control form-control-color" id="theme_color_secondary"
                                value="{{ old('theme_color_secondary', $data->theme_color_secondary) }}"
                                style="width: 80px;" name="theme_color_secondary">
                        </div>
                        <label for="font_color_secondary" class="col-sm-3 col-form-label">Warna Font Sekunder</label>
                        <div class="col-sm-3">
                            <input type="color" class="form-control form-control-color" id="font_color_secondary"
                                value="{{ old('font_color_secondary', $data->font_color_secondary) }}" style="width: 80px;"
                                name="font_color_secondary">
                        </div>
                    </div>
                    <div class="mb-3 row align-items-center">
                        <label for="theme_color_body" class="col-sm-3 col-form-label">Warna Tema Body</label>
                        <div class="col-sm-3">
                            <input type="color" class="form-control form-control-color" id="theme_color_body"
                                value="{{ old('theme_color_body', $data->theme_color_body) }}" style="width: 80px;"
                                name="theme_color_body">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="desc" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="desc" value="{{ old('desc', $data->desc) }}"
                                name="desc">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end"
                        style="margin-top: 30px; margin-bottom:20px;">
                        <button class="btn btn-danger me-2" type="button">Batal</button>
                        <button class="btn btn-warning me-2 text-light" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Pratinjau</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade modal-fullscreen" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-2">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Pratinjau Tema</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modal-preview">
            <div id="body-modal" style="background: {{ $data->theme_color_body }}">
                <nav class="navbar navbar-expand-lg" style="backround: {{ $data->theme_color_primary }}" id="navbar-modal">
                    <div class="container-fluid">
                        <div class="col-2 p-0 m-0">
                            <a class="navbar-brand" href="#"><img class="img-fluid w-50" src="{{ asset('img/logo-tutwuri.png') }}"></a>
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav ms-auto">
                            <a class="nav-link link active" aria-current="page" href="#">Beranda</a>
                            <a class="nav-link link" href="#">Staf</a>
                            <a class="nav-link link" href="#">Berita</a>
                            <a class="nav-link link" href="#">Galeri</a>
                            <a class="nav-link link" href="#">Unduh</a>
                        </div>
                        </div>
                    </div>
                </nav>

                <div class="row m-0 justify-content-between h6 align-items-center mt-2">
                    <div class="col">
                        <p class="d-inline fs-3 text-capitalize font-color-primary">Tema</p>
                    </div>
                    
                    <div class="col text-end font-color-primary">
                        <a href="#" class="nav-link d-inline">Beranda</a>
                        <p class="d-inline text-capitalize">/ Tema</p>
                    </div>
                </div>

                <div class="row m-0 mt-3 justify-content-between p-0">
                    @for ($i = 0; $i < 6; $i++)
                    <div class="col-md-3 shadow-lg border border-dark p-3 rounded-3 me-md-3 mb-md-3 mx-auto">
                        <img class="img-fluid w-100 rounded-3" src="https://cdn.pixabay.com/photo/2024/04/24/14/19/work-from-home-8717863_1280.jpg">
                        <hr class="">
                        <p class="fs-6 m-0 p-0 font-color-secondary">Palet {{ $i + 1 }}</p>
                    </div>
                    @endfor
                </div>

                <div class="row m-0 justify-content-between p-3 bg-body-primary" id="footer-modal" style="background: {{ $data->theme_color_primary }}">
                    <div class="col">
                    <p class="h6 font-color-primary">Sekolah</p>
                    <br>
                    <p class="font-color-secondary">Footer Deskripsi</p>
                    </div>
                    <div class="col">
                    <p class="h6 font-color-primary">Informasi kontak</p>
                    <p class="font-color-secondary">Informasi Kontak</p> 
                    </div>
                    <div class="col text-center">
                    <p class="h6 font-color-primary">Ikuti sosial media kami</p>
                    <div class="col mx-auto text-center fs-4 d-flex justify-content-evenly">
                        <i class="bi bi-instagram font-color-primary"></i>
                        <i class="bi bi-facebook font-color-primary"></i>
                        <i class="bi bi-twitter-x font-color-primary"></i>
                        <i class="bi bi-youtube font-color-primary"></i>
                    </div>
                    </div>
                
                    <hr>
                    <div class="text-muted">
                        @Copyright 2024
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    const theme_color_primary = $('#theme_color_primary');
    const theme_color_secondary = $('#theme_color_secondary');
    const theme_color_body = $('#theme_color_body');
    const font_color_primary = $('#font_color_primary');
    const font_color_secondary = $('#font_color_secondary');

    $('#navbar-modal').css({
        'background-color' : theme_color_primary.val(),
    });
    $('#footer-modal').css({
        'background-color' : theme_color_secondary.val(),
    });
    $('#body-modal').css({
        'background-color' : theme_color_body.val(),
    });
    $('.font-color-primary').css({
        'color' : font_color_primary.val(),
    });
    $('.font-color-secondary').css({
        'color' : font_color_secondary.val(),
    });
    $('.link').css({
        'color' : theme_color_body.val(),
    });

    theme_color_primary.on('input', function() {
        $('#navbar-modal').css({
            'background-color' : theme_color_primary.val(),
        });
    });
    
    theme_color_secondary.on('input', function() {
        $('#footer-modal').css({
            'background-color' : theme_color_secondary.val(),
        });
    });
    
    theme_color_body.on('input', function() {
        $('#body-modal').css({
            'background-color' : theme_color_body.val(),
        });
        $('.link').css({
            'color' : theme_color_body.val(),
        });
    });

    font_color_primary.on('input', function() {
        $('.font-color-primary').css({
            'color' : font_color_primary.val(),
        });
    });
    
    font_color_secondary.on('input', function() {
        $('.font-color-secondary').css({
            'color' : font_color_secondary.val(),
        });
    });

</script>
@endsection
