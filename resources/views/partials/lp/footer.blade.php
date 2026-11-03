@php
  $setting = App\Models\Setting::where('created_by', $created_by)->first();
@endphp
<div class="row m-0 justify-content-between p-3 theme-color-secondary">
    <div class="col-md-4">
      <p class="h5 text-capitalize">{{ $setting->school_name }}</p>
      <div class="p">{!! $setting->footer_desc !!}</div>
    </div>
    <div class="col-md-4 mt-4 mt-md-0">
      <p class="h5">Informasi kontak</p>

      <div class="row m-0">
        <div class="col-1 p-0">
          <i class="bi bi-telephone me-2"></i>
        </div>
        <div class="col p-0">
          <p class="d-inline">{{ $setting->phone }}</p>
        </div>
      </div>

      <div class="row m-0">
        <div class="col-1 p-0">
          <i class="bi bi-envelope me-2"></i>
        </div>
        <div class="col p-0">
          <p class="d-inline">{{ $setting->email }}</p>
        </div>
      </div>

      <div class="row m-0">
        <div class="col-1 p-0">
          <i class="bi bi-geo-alt me-2"></i>
        </div>
        <div class="col p-0">
          <p class="d-inline">{{ $setting->address }}</p>
        </div>
      </div>
    </div>
    <div class="col-md-4 text-center my-4 my-md-0">
      <p class="h5">Ikuti sosial media kami</p>
      <div class="col-md-6 mx-auto text-center fs-4 d-flex justify-content-evenly">
        <a class="nav-link" href="https://instagram.com/{{ $setting->instagram }}" target="_blank">
          <i class="bi bi-instagram"></i>
        </a>
        <a class="nav-link" href="https://facebook.com/{{ $setting->facebook }}" target="_blank">
          <i class="bi bi-facebook"></i>
        </a>
        <a class="nav-link" href="https://twitter.com/{{ $setting->twitter }}" target="_blank">
          <i class="bi bi-twitter-x"></i>
        </a>
        <a class="nav-link" href="https://youtube.com/@<?= $setting->youtube ?>" target="_blank">
          <i class="bi bi-youtube"></i>
        </a>
      </div>
    </div>

    <hr class="mt-md-3">
    <div class="text-muted">
        @Copyright 2024
    </div>
</div>