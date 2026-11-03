@extends('partials.lp.main')
@php
    $slug = request()->url();
    $slug = explode('/', $slug);
    $slug = $slug['3'];
@endphp
@section('content')
    <div class="row m-0 my-3">
        <div class="col-md-7">
            <div>
                <img class="img-fluid w-100 rounded-3" src="{{ asset('storage/galery/' . $data->photo) }}">
            </div>
            <p class="h3 mt-3 text-capitalize">{{ $data->title }}</p>
            <p class="h6 mb-3 text-capitalize">Kategori : {{ $data->category_galery->name }}</p>
            <hr>
            <p>{{ $data->desc }}</p>
        </div>

        <div class="col p-0">
            <hr class="mt-0">
            <p class="fw-bold ms-3">Lihat lainnya</p>
            <hr>    
            <div class="row m-0">
                @foreach ($datas as $item)
                @if ($item->id != $data->id)
                <a class="row m-0 mb-3 text-decoration-none font-color-secondary" href="{{ route('lp.galery.gambar.show', ['slug' => $slug, 'id' => $item->id ]) }}">
                    <div class="col-md-5">
                        <img class="img-fluid w-100 rounded-3 lp_image" src="{{ asset('storage/galery/' . $item->photo) }}">
                    </div>
                    <div class="col">
                        <p class="h5 text-capitalize">{{ $item->title }}</p>
                        <p>{{ $item->desc }}</p>
                    </div>
                </a>
                @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection