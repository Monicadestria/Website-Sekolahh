@extends('partials.lp.main')
@section('content')

<div class="container-fluid main-news section mb-5">
    <div class="row d-flex align-items-center">
        <div class="col-md-6">
            <div class="d-inline-flex align-items-center">
                <p class="d-inline me-1 mb-0">Kategori:</p>
                <select class="border border-2 rounded-2" id="s_category">
                    <option value="semua">Semua</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <form>
                <div class="col text-end">
                    <p class="d-inline">Cari : </p>
                    <input class="form-control d-inline ms-3" id="s_title" type="text" style="width: 50%;" name="s_title">
                </div>
            </form>
        </div>
    </div>

    <div class="row" id="news-section">
        @if ($mainBerita->isEmpty() && $otherBerita->isEmpty())
        <div class="col-12 text-center mt-5 mb-5">
            <p class="fw-bold">Belum ada data berita.</p>
        </div>
        @else
        <div class="col-lg-6">
            <div id="news-list">
                @foreach ($mainBerita as $brt)
                <div class="news-item mb-4" data-title="{{ $brt->title }}">
                    <a href="{{ route('lp.berita.show', ['slug' => $slug, 'id' => $brt->id]) }}">
                        <img class="thumb mb-3" src="{{ asset('storage/berita/' . $brt->photo) }}" width="50%" style="padding-top: 30px" />
                    </a>
                    <h5>
                        <a href="{{ route('lp.berita.show', ['slug' => $slug, 'id' => $brt->id]) }}" class="text-decoration-none text-dark">{{ $brt->title }}</a>
                    </h5>
                </div>
                @endforeach
            </div>
        </div>

        <div class="col-lg-6">
            <div class="row">
                <div>
                    <h4 class="pt-4"><strong>Berita Lainnya</strong></h4>
                    <hr />
                    <div class="row" id="container">
                        @foreach($otherBerita as $brt)
                        <div class="col-6 news-item mb-4" data-title="{{ $brt->title }}">
                            <div class="d-flex">
                                <div class="image">
                                    <a href="{{ route('lp.berita.show', ['slug' => $slug, 'id' => $brt->id]) }}">
                                        <img src="{{ asset('storage/berita/' . $brt->photo) }}" width="100px" class="me-3" style="object-fit: cover; height: 100px" />
                                    </a>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                  <p><a href="{{ route('lp.berita.show', ['slug' => $slug, 'id' => $brt->id]) }}" class="text-decoration-none text-dark">{{ $brt->title }}</a></p>
                                  <p>{{ timeAgo($brt->created_at) }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<div class="d-flex justify-content-end d-none" id="paginator">
    {{ $datas->links('partials.lp.pagination') }}
</div>

@endsection
@include('partials.lp.jquery')

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
