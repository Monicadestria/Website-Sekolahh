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
                <div class="card ">
                    <div class="card-header d-flex justify-content-between">
                        <a href="{{ route('galery.index') }}">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                        <h5 class="m-0 flex-grow-1 ms-2">Ubah Data Galeri</h5>
                    </div>

                    <div class="card-body m-2">
                        <form class="needs-validation form-edit" action="{{ route('galery.update', ['id' => $data->id]) }}" method="post" enctype="multipart/form-data" novalidate>
                            @csrf
                            @method('PUT')

                            <div class="mb-3 row text-start">
                                <label for="title" class="col-sm-2 col-form-label">Judul</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ old('title', $data->title) }}" pattern=".*\S.*" required>
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
                                            <option disabled="disabled" value="">Pilih</option>
                                            @foreach ($category_galery as $item)
                                                <option value="{{ $item->id }}" {{ $data->category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
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
                                    <label for="type" class="col-form-label">Tipe</label>
                                </div>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <select class="form-select" id="type" name="type" required>
                                            <option disabled="disabled" value="">Pilih</option>
                                            <option value="photo" {{ $data->type == 'photo' ? 'selected' : '' }}>Gambar</option>
                                            <option value="video" {{ $data->type == 'video' ? 'selected' : '' }}>Video</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Perlu memilih
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row text-start">
                                <label for="desc" class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    <input type="alamat" class="form-control" id="desc" name="desc"
                                        value="{{ old('desc', $data->desc) }}">
                                </div>
                            </div>

                            <div class="mb-3 row text-start {{ $data->type == 'video' ? '' : 'd-none' }}" id="video_tag">
                                <label for="video" class="col-sm-2 col-form-label">Video</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="video"
                                        placeholder="Masukan id video Youtube" name="video" value="{{ old('video', $data->video) }}">
                                </div>
                            </div>

                            <div class="mb-3 row text-start {{ $data->type == 'photo' ? '' : 'd-none' }}" id="photo_tag">
                                <label for="photo" class="col-sm-2 col-form-label">Gambar</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" id="photo" name="photo" accept=".png,.jpg,.jpeg">
                                </div>
                            </div>

                            {{-- Photo Preview --}}
                            <div class="row justify-content-start">
                                <div class="col-sm-2"> </div>
                                <div class="col-sm-10 {{ $data->type == 'photo' ? '' : 'd-none' }}" id="photo_preview_tag">
                                  <img class="img-fluid w-25" src="{{ $data->photo ? asset('storage/galery/' . $data->photo) : ''}}" id="photo_preview" alt="Photo Preview">
                                </div>
                            </div>

                            {{-- Video Preview --}}
                            <?php
                                if ($data->type == 'video') {
                                    $src = explode('/', $data->video);
                                    $src = "https://www.youtube.com/embed/" . $src['3'];
                                    // dd($src);
                                } else {
                                    $src = '';
                                }

                            ?>
                            <div class="row justify-content-start">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10 {{ $data->type == 'video' ? '' : 'd-none' }}" id="video_preview_tag">
                                    <iframe class="text-en" id="video_preview" src="{{ $src }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                </div>
                            </div>

                            <div class="row m-0 mt-3">
                                <div class="col-md-2 m-0 p-0">
                                    <label class="form-label">Status</label>
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

@section('js')
    <script>
        const selectType = document.getElementById('type');
        
        const photoTag = document.getElementById('photo_tag')
        const photoInput = document.getElementById('photo');
        const photoPreviewTag = document.getElementById('photo_preview_tag');
        const photoPreview = document.getElementById('photo_preview')

        const videoTag = document.getElementById('video_tag')
        const videoInput = document.getElementById('video');
        const videoPreviewTag = document.getElementById('video_preview_tag')
        const videoPreview = document.getElementById('video_preview')

        selectType.addEventListener('change', function() {
            const selected = selectType.value;

            if(selected == 'photo') {
                photoTag.classList.remove('d-none');
                photoPreviewTag.classList.remove('d-none');
                videoTag.classList.add('d-none');
                videoPreviewTag.classList.add('d-none');
                videoInput.removeAttribute('required', 'required');
            } else {
                photoTag.classList.add('d-none');
                photoPreviewTag.classList.add('d-none');
                videoTag.classList.remove('d-none');
                videoPreviewTag.classList.remove('d-none');
                videoInput.setAttribute('required', 'required');
            }
        });

        photoInput.addEventListener('change', function() {
            const file = document.querySelector('input[type=file]').files[0];
            const reader = new FileReader();
            const data_photo = `<?= $data->photo ?>`;

            reader.onloadend = function() {
              photoPreview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file)
            } else {
                if(data_photo != null) {
                    photoPreview.src = `{{ asset('storage/galery/${data_photo}') }}`;
                }
            }
        });

        videoInput.addEventListener('input', function() {
            const data_video = `<?= $data->video ?>`;

            let src = videoInput.value.split(/[/]/);
            src = `https://www.youtube.com/embed/${src['3']}`

            videoPreview.src = src;

            if(!videoInput.value && data_video != null) {
                videoPreview.src = data_video;
            }
        });
    </script>
@endsection
