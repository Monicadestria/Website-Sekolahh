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
                        <h5 class="m-0 flex-grow-1 ms-2">Detail Data Galeri</h5>
                    </div>

                    <div class="card-body" style="margin: 25px">
                        <div>
                            <div class="row">
                                <div class="col-4 col-md-2 p-0">
                                    <p>Judul</p>
                                </div>
                                <div class="col p-0">
                                    <p>: {{ $data->title }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 col-md-2 p-0">
                                    <p>Kategori</p>
                                </div>
                                <div class="col p-0">
                                    <p>: {{ $data->category_galery->name }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 col-md-2 p-0">
                                    <p>Tipe</p>
                                </div>
                                <div class="col p-0">
                                    <p>: {{ $data->type == 'photo' ? 'Gambar' : 'Video' }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 col-md-2 p-0">
                                    <p>Deskripsi</p>
                                </div>
                                <div class="col p-0">
                                    <p>: {{ $data->desc }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 col-md-2 p-0">
                                    <p>Status</p>
                                </div>
                                <div class="col p-0">
                                    <p>: {{ $data->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</p>
                                </div>
                            </div>
                            <div class="row justify-content-end me-3 me-md-0">
                                <div class="col-1">
                                    <a href="{{ route('galery.edit', $data->id) }}" class="btn btn-warning text-light">Ubah</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
            if ($data->type == 'video') {
                $src = explode('/', $data->video);
                $src = "https://www.youtube.com/embed/" . $src['3'];
            } else {
                $src = '';
            }
        ?>

        <div class="row content flex-grow-1 mt-3">
            <div class="col-12">
                <div class="card p-3">
                    <p class="text-center h5">File/Dokumen</p>
                    <div class="row m-0 mt-3 justify-content-center">
                        <div class="col text-center">
                            <img class="img-thumbnail w-50 {{ $data->type == 'photo' ? '' : 'd-none' }}" src="{{ asset('storage/galery/' . $data->photo) }}">
                            <div class="d-flex justify-content-center {{ $data->type == 'video' ? '' : 'd-none' }}" id="video_preview_tag">
                                <iframe class="text-en" id="video_preview" src="{{ $src }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

