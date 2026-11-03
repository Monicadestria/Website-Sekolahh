@extends('partials.main')
@section('content')
    <div class="">
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
                        <a class="mt-1" href="{{ route('galery.index') }}">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                        <h5 class="m-0 flex-grow-1 ms-2">Tambah Data Galeri</h5>
                    </div>

                    <div class="card-body m-2">
                        <form class="needs-validation" id="form-create" action="{{ route('galery.store') }}" method="post" enctype="multipart/form-data" novalidate>
                            @csrf

                            <div class="mb-3 row text-start">
                                <label for="title" class="col-sm-2 col-form-label">Judul</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" pattern=".*\S.*" required>
                                    <div class="invalid-feedback">
                                        Perlu diisi
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-sm-2 text-start">
                                    <label for="category_id" class="col-form-label">Kategori</label>
                                </div>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <select class="form-select" id="category_id" name="category_id" required>
                                            <option selected disabled="disabled" value="">Pilih</option>
                                            @foreach ($category_galery as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Perlu dipilih
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-sm-2 text-start">
                                    <label for="type" class="col-form-label">Tipe</label>
                                </div>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <select class="form-select" id="type" name="type" required>
                                            <option selected disabled="disabled" value="">Pilih</option>
                                            <option value="photo">Gambar</option>
                                            <option value="video">Video</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Perlu dipilih
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row text-start">
                                <label for="desc" class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="desc" name="desc"
                                        value="{{ old('desc') }}">
                                </div>
                            </div>

                            <div class="mb-3 row text-start" id="video_input">
                                <label for="video" class="col-sm-2 col-form-label">Video</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="video"
                                        placeholder="Masukan link video Youtube" name="video" value="{{ old('video') }}">
                                    <div class="invalid-feedback">
                                        Perlu di isi
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row text-start" id="photo_input">
                                <label for="photo" class="col-sm-2 col-form-label">Gambar</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" id="photo" name="photo" accept=".png,.jpg,.jpeg">
                                    <div class="invalid-feedback">
                                        Perlu di isi
                                    </div>
                                </div>
                            </div>

                            <div id="photo_preview"></div>
                            <div id="video_preview"></div>

                            <div class="row m-0 mt-3">
                                <div class="col-md-2 m-0 p-0">
                                    <label class="form-label">Status</label>
                                </div>
                                <div class="form-check col-auto ms-md-2">
                                    <input class="form-check-input" type="radio" name="status" id="aktif" value="1" checked>
                                    <label class="form-check-label" for="aktif">
                                        Aktif
                                    </label>
                                </div>
                                <div class="form-check col-auto">
                                    <input class="form-check-input" type="radio" name="status" id="tidak_aktif" value="0">
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

@section('js')
    <script>
        const selectType = document.getElementById('type');
        const photoInput = document.getElementById('photo');
        const videoInput = document.getElementById('video');
        const photoTag = document.getElementById('photo_input');
        const videoTag = document.getElementById('video_input');
        const photoPreview = document.getElementById('photo_preview');
        const videoPreview = document.getElementById('video_preview');

        selectType.addEventListener('change', function() {
            const selected = selectType.value;

            if (selected == 'photo') {
                photoTag.classList.remove('d-none')
                photoPreview.classList.remove('d-none')
                videoTag.classList.add('d-none')
                videoPreview.classList.add('d-none')
                photoInput.setAttribute('required', 'required')
                videoInput.removeAttribute('required', 'required')
            } else {
                photoTag.classList.add('d-none')
                photoPreview.classList.add('d-none')
                videoTag.classList.remove('d-none')
                videoPreview.classList.remove('d-none')
                videoInput.setAttribute('required', 'required')
                photoInput.removeAttribute('required', 'required')
            }
        });

        videoInput.addEventListener('input', function() {
            let src = videoInput.value.split(/[/]/);
            src = `https://www.youtube.com/embed/${src['3']}`

            videoPreview.innerHTML =
                `<div class="row justify-content-start"><div class="col-sm-2"></div><div class="col-sm-2"><iframe class="text-en" id="video_preview" src="${src}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></div></div>`

                
        });

        photoInput.addEventListener('change', function() {
            const file = document.querySelector('input[type=file]').files[0];
            const reader = new FileReader();

            reader.onloadend = function() {
                photoPreview.classList.add('d-flex', 'justify-content-start');
                photoPreview.innerHTML = `<div class="row justify-content-start"><div class="col-sm-2"></div><div class="col-sm-10"><img class="img-fluid w-25" src="` + reader.result + `"></div></div>`;
            }

            if (file) {
                reader.readAsDataURL(file)
            } else {
                photoPreview.innerHTML = '';
            }
        });
    </script>
@endsection

<div class="row justify-content-start">
    <div class="col-sm-2"></div>
    </div>
</div>
{{-- https://youtu.be/e2gwlYXZbH8?si=FmkET5IJH218xS2- --}}
{{-- src="https://www.youtube.com/embed/e2gwlYXZbH8?si=TaXjl6eHe8HkkvrK" --}}
