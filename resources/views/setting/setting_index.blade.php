@extends('partials.main')
@section('content')
<style>
  .trix-button-group--file-tools,
  .trix-button--icon-attach {
   display: none !important;
  }

  trix-editor pre {
   white-space: pre-wrap;
   word-wrap: break-word;
  }
</style>
<div class="py-3 px-1">
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col">
            <h4 class="m-0 text-bawah-burger-menu">Pengaturan</h4>
          </div>
          <div class="col d-flex justify-content-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item text-bawah-burger-menu"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Pengaturan</li>
            </ol>
          </div>
        </div>
      </div>
  </div>
<div class="card">
  <div class="card-header d-flex align-items-center">
    <h5 class="my-1 py-1">
      Data Pengaturan
    </h5>
  </div>
  <div class="card-body">
    <form class="needs-validation form-edit" method="post" data-id="{{ $data->id }}" action="{{ route('setting.update', ['id' => $data->id]) }}" enctype="multipart/form-data" novalidate>
      @csrf
      @method('PUT')

      <div class="row m-0 mb-3">
        <div class="col-md-2 m-0 p-0">
            <label class="form-label">Status Website</label>
        </div>
        <div class="form-check col-auto ms-3">
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

      <div class="mb-3 row">
          <label for="school_name" class="col-sm-2 col-form-label">Nama Sekolah</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="school_name" name="school_name" value="{{ old('school_name', $data->school_name) }}" pattern=".*\S.*" required>
            <div class="invalid-feedback">
                Perlu di isi
            </div>
          </div>
      </div>

      <div class="mb-3 row">
          <label for="slug" class="col-sm-2 col-form-label">Slug</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $data->slug) }}" disabled>
            {{-- <div class="invalid-feedback">
                Perlu di isi
            </div> --}}
          </div>
      </div>

      <div class="mb-3 row">
        <label for="theme_id" class="col-sm-2 col-form-label">Tema</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="theme_id" value="{{ $data->theme ? $data->theme->name : 'No theme selected'}}" disabled>
        </div>
        <div class="invalid-feedback">
          Cukup
        </div>
      </div>

      <div class="mb-3 row">
          <label for="visi_misi" class="col-sm-2 col-form-label">Visi Misi</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="visi_misi" name="visi_misi" value="{{ old('visi_misi', $data->visi_misi) }}">
          </div>
          <div class="invalid-feedback">
            Cukup
          </div>
      </div>

      <div class="mb-3 row">
          <label for="phone" class="col-sm-2 col-form-label">Nomor Telepon</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" id="phone" name="phone" value="{{ old('phone', $data->phone) }}" maxlength="7">
          </div>
          <div class="invalid-feedback">
            Data tidak valid
          </div>
      </div>

      <div class="mb-3 row">
          <label for="post_code" class="col-sm-2 col-form-label">Kode Pos</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="post_code" name="post_code" value="{{ old('post_code', $data->post_code) }}" maxlength="7">
          </div>
          <div class="invalid-feedback">
            Data tidak valid
          </div>
      </div>

      <div class="mb-3 row">
          <label for="maps" class="col-sm-2 col-form-label">Lokasi</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="maps" name="maps" value="{{ old('maps', $data->maps) }}">
          </div>
          <div class="invalid-feedback">
            Cukup
          </div>
      </div>

      <div class="mb-3 row">
          <label for="facebook" class="col-sm-2 col-form-label">Facebook</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="facebook" name="facebook" value="{{ old('facebook', $data->facebook) }}">
          </div>
          <div class="invalid-feedback">
            Cukup
          </div>
      </div>

      <div class="mb-3 row">
          <label for="instagram" class="col-sm-2 col-form-label">Instagram</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="instagram" name="instagram" value="{{ old('instagram', $data->instagram) }}">
          </div>
          <div class="invalid-feedback">
            Cukup
          </div>
      </div>

      <div class="mb-3 row">
          <label for="tiktok" class="col-sm-2 col-form-label">TikTok</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="tiktok" name="tiktok" value="{{ old('tiktok', $data->tiktok) }}">
          </div>
          <div class="invalid-feedback">
            Cukup
          </div>
      </div>

      <div class="mb-3 row">
          <label for="twitter" class="col-sm-2 col-form-label">Twitter</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="twitter" name="twitter" value="{{ old('twitter', $data->twitter) }}">
          </div>
          <div class="invalid-feedback">
            Cukup
          </div>
      </div>
      
      <div class="mb-3 row">
        <label for="youtube" class="col-sm-2 col-form-label">Youtube</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="youtube" name="youtube" value="{{ old('youtube', $data->youtube) }}">
        </div>
        <div class="invalid-feedback">
          Cukup
        </div>
      </div>

      <div class="mb-3 row">
          <label for="email" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $data->email) }}">
          </div>
          <div class="invalid-feedback">
            Cukup
          </div>
      </div>

      <div class="mb-3 row">
          <label for="address" class="col-sm-2 col-form-label">Alamat</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $data->address) }}">
            {{-- <textarea name="address" id="address" cols="30" rows="10"></textarea> --}}
          </div>
          <div class="invalid-feedback">
            Cukup
          </div>
      </div>

      <div class="mb-3 row">
          <label for="desc" class="col-sm-2 col-form-label">Deskripsi</label>
          <div class="col-sm-10">
            <input id="desc" type="hidden" name="desc" value="{{ old('desc', $data->desc) }}">
            <trix-editor input="desc" class="form-control" id="desc" name="desc" data-persisted></trix-editor>
          </div>
          <div class="invalid-feedback">
            Cukup
          </div>
      </div>

      <div class="mb-3 row">
          <label for="footer_desc" class="col-sm-2 col-form-label">Deskripsi Footer</label>
          <div class="col-sm-10">
            <input type="hidden" class="form-control" id="footer_desc" name="footer_desc" value="{{ old('footer_desc', $data->footer_desc) }}">
            <trix-editor input="footer_desc" class="form-control" id="foot_desc" name="foot_desc"></trix-editor>
          </div>
          <div class="invalid-feedback">
            Cukup
          </div>
      </div>

      <div class="mb-3 row">
        <label for="logo" class="col-sm-2 col-form-label">Logo</label>
        <div class="col-sm-10">
            <input class="form-control" type="file" id="logo" name="logo" value="{{ old('logo', $data->logo) }}" accept=".jpg,.jpeg,.png">
        </div>
        <div class="invalid-feedback">
          Cukup
        </div>
      </div>

      {{-- Preview Logo --}}
      {{-- <div class="d-flex justify-content-center mb-3"> --}}
      <div class="row justify-content-start">
        <div class="col-sm-2"></div>
          <img class="img-fluid w-25" src="{{ $data->logo ? asset('/storage/setting/' . $data->logo) : '/img/logo-tutwuri.png' }}" alt="logo" id="preview">
        </div>
      </div>
      {{-- </div> --}}

      <div class="d-flex justify-content-end mb-4 me-3">
          <button class="btn btn-danger me-2" type="button">Batal</button>
          <button class="btn btn-primary" type="submit">Simpan</button>
      </div>
    </form>
</div>
</div>

@endsection

@section('js')
    <script>
      $(document).ready(function () {
        const loading = document.querySelector('#loading');
        data_logo = "<?= $data->logo ?>"

        document.getElementById('logo').addEventListener('change', function() {
          const preview = document.getElementById('preview');
          const file    = document.querySelector('input[type=file]').files[0];
          const reader  = new FileReader();

          reader.onloadend = function () {
              preview.src = reader.result;
          }

          if (file) {
              reader.readAsDataURL(file);
          } else {
            if(data_logo) {
              preview.src = data_logo;
            } else {
              preview.src = '/img/logo-tutwuri.png';
            }
          }
        });
      });
    </script>
@endsection