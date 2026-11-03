@extends('partials.lp.main')
@section('content')

<div class="container-fluid mb-4">
    <div class="title text-center">
      <h3>
        <strong>{{ $berita->title }}</strong>
      </h3>
      <p>{{ formatDate($berita->created_at) }} | <i class="bi bi-eye-fill eye-icon"> </i>{{ $berita->view_count }} Tayangan</p>
      {{-- @if(session()->has('viewed_berita') && in_array($berita->id, session('viewed_berita')))
        <p>Anda sudah melihat berita ini sebelumnya.</p>
      @else
        <p>Ini adalah pertama kalinya Anda melihat berita ini.</p>
      @endif --}}
    </div>

    <div class="row">
      <div class="col-6 d-flex justify-content-center">
        <img src="{{ asset('storage/berita/' . $berita->photo) }}" alt="Gambar" style="width: 60%" />
      </div>
      <div class="col-6 d-flex justify-content-start">
        <p class="text-justify">
          {!! $berita->body !!}
        </p>
      </div>
    </div>
  </div>
@endsection
