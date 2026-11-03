@extends('partials.lp.main')
@php
    $slug = request()->url();
    $slug = explode('/', $slug);
    $slug = $slug['3'];
@endphp
@section('content')
<form class="row m-0 justify-content-between align-items-center mt-3">
    <div class="col-auto">
        <p class="d-inline">Tampilkan</p>
        <div class="d-inline">
            <select class="border border-2 rounded-2" id="s_paging" aria-label="{{ $datas->perPage() }}">
                {{-- <option selected>Open this select menu</option> --}}
                {{-- @for ($i = 10; $i <= 100; $i+=10) --}}
                @for ($i = 10; $i <= 100; $i+=10)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <p class="d-inline">Keseluruhan</p>
    </div>

    <div class="col-auto text-start">
        <p class="d-inline me-1">Kategori : </p>
        <div class="d-inline">
            <select class="border border-2 rounded-2" id="s_category">
                <option value="semua">Semua</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    
    <div class="col text-md-end">
        <p class="d-inline">Cari : </p>
        <input class="form-control d-inline ms-md-3" id="s_title" type="text" style="width: 40%;" name="s_title">
    </div>
</form>

<div class="row m-0 p-5 px-0 justify-content-around" id="container">
    @if($datas->count() == 0) 
        <p class="text-light text-center my-5 h5">(Belum ada data)</p>
        {{-- <img class="img-fluid w-25 mx-auto py-5" src="https://www.blackhillsinfosec.com/wp-content/uploads/2016/07/66619265.jpg"> --}}
    @else
    @foreach ($datas as $data)
    <a class="col-md-2 shadow p-3 rounded-3 me-md-2 mb-md-3 text-decoration-none" href="{{ route('lp.galery.video.show', ['slug' => $slug, 'id' => $data->id]) }}">
        <iframe class="w-100 rounded-3" src="https://www.youtube.com/embed/{{ $data->video_url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        <hr class="">
        <p class="fs-6 m-0 p-0">{{ $data->title }}</p>
    </a>
    @endforeach
    @endif
</div>

<div class="d-flex justify-content-end" id="paginator">
    {{ $datas->links('partials.lp.pagination') }}
</div>
@endsection
@include('partials.lp.jquery')
