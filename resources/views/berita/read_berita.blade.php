@extends('partials.main')
@section('content')

<div class="container">
    <div class="row content flex-grow">
        <div class="col-12">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="card-title">
                        <h5>
                            <a href="{{ route('berita.index') }}" class="mr-2">
                                <i class="bi bi-chevron-left" style="color: black; font-weight:bold;"></i>
                            </a> Detail Berita
                        </h5>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-1">
                        <div class="col-sm-2 col-4">Judul</div>
                        <div class="col-auto px-0">:</div>
                        <div class="col"> {{ $berita->title }}</div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-sm-2 col-4">Kategori</div>
                        <div class="col-auto px-0">:</div>
                        <div class="col"> {{ $berita->CategoryBerita->name }}</div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-sm-2 col-4">Slug</div>
                        <div class="col-auto px-0">:</div>
                        <div class="col"> {{ $berita->slug }}</div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-sm-2 col-4">Isi</div>
                        <div class="col-auto px-0">:</div>
                        <div class="col" id="berita-body"> {!!  $berita->body !!}</div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-sm-2 col-4">Status</div>
                        <div class="col-auto px-0">:</div>
                        <div class="col">
                            @if($berita->status == 1)
                                Publish
                            @else
                                Draft
                            @endif
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end button m-2">
                    <a href="{{ route('berita.edit', $berita->id) }}" class="btn btn-warning text-white">Ubah</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row content flex-grow-1 mt-3 mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between text-center">
                    <h5 class="mx-auto">File/Dokumen</h5>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset('storage/berita/' . $berita->photo) }}" class="w-25">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Ambil semua elemen gambar dalam konten berita dan atur lebar maksimumnya
    const images = document.querySelectorAll('#berita-body img');
    images.forEach(image => {
        image.style.maxWidth = '50%';
        image.style.height = 'auto';
    });
</script>
@endsection