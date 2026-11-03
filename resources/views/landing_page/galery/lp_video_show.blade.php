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
                <iframe class="rounded-3 w-100" height="400" src="https://www.youtube.com/embed/{{ $data->video_url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <p class="h3 mt-3">{{  $data->title}}</p>
            <p>{{ $data->desc }}</p>
        </div>

        <div class="col p-0">
            <hr class="mt-0">
            <p class="fw-bold ms-3">Lihat lainnya</p>
            <hr>    
            <div class="row m-0">
                @foreach ($datas as $item)
                @if ($data->id != $item->id)
                <a class="row m-0 mb-3 text-decoration-none" href="{{ route('lp.galery.video.show', ['slug' => $slug, 'id' => $item->id]) }}">
                    <div class="col-md-5">
                        <iframe class="w-100 rounded-3" src="https://www.youtube.com/embed/{{ $item->video_url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                    <div class="col">
                        <p class="h5">{{ $item->title }}</p>
                        <p>{{ $item->desc }}</p>
                    </div>
                </a>
                @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection