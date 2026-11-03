@extends('partials.main')
@section('content')

<div class="card card-primary mt-4 mb-4">
    <div class="card-header">
        <h5 class="card-title">
            <a href="{{ route('staf.index') }}" class="mr-2">
                <i class="bi bi-chevron-left" style="color: black; font-weight:bold;"></i>
            </a> Ubah Data Staf
        </h5>
    </div>
    <form action="{{ route('staf.update', ['id' => $staf->id]) }}" class="needs-validation form-edit"  method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group row mt-3">
                <label class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="name" name="name" placeholder="name" value="{{ old('name', $staf->name) }}" required pattern=".*\S.*">
                    <div class="invalid-feedback">
                        Perlu diisi
                    </div>
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-3 col-form-label">Kategori </label>
                <div class="col-sm-9">
                    <select name="category_staf_id" id="category_staf_id" class="form-select">
                        @foreach ($categoryStaf as $id => $name)
                            <option value="{{ $id }}" {{ $id == $staf->category_staf_id ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-3 col-form-label">NIP</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="nip" name="nip" placeholder="nip" value="{{ old('nip', $staf->nip) }}" required pattern=".*\S.*">
                    <div class="invalid-feedback">
                        Perlu diisi
                    </div>
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-3 col-form-label">Foto</label>
                <div class="col-sm-9">
                      <input type="file" class="form-control" id="photo" name="photo" accept=".jpg, .png, .jpeg" placeholder="" value="{{ old('photo', $staf->photo) }}" >
                    @if ($staf->photo)
                    <img src="{{ asset('storage/staff/' . $staf->photo) }}" id="photo-preview" alt="Pratinjau Gambar" class="mt-2" width="200px">
                    @else
                        <p>Gambar belum tersedia</p>
                    @endif
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-3 col-form-label">No HP</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="phone_number" name="phone_number" placeholder="phone_number" value="{{ old('phone_number', $staf->phone_number) }}" required pattern=".*\S.*">
                    <div class="invalid-feedback">
                        Perlu diisi
                    </div>
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="email" name="email" placeholder="email" value="{{ old('email', $staf->email) }}" required pattern=".*\S.*">
                    <div class="invalid-feedback">
                        Perlu diisi
                    </div>
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-3 col-form-label">Status:</label>
                <div class="col-sm-9">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="active" value="1" {{ $staf->status ? 'checked' : '' }}>
                        <label class="form-check-label" for="active">Aktif</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="inactive" value="0" {{ !$staf->status ? 'checked' : '' }}>
                        <label class="form-check-label" for="inactive">Tidak Aktif</label>
                    </div>
                </div>
            </div>            
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('staf.edit',$staf->id) }}" title="Batal" class="btn btn-danger">Batal</a>
            <input type="submit" name="Simpan" value="Simpan" class="btn btn-primary">
        </div>
    </form>
</div>

<script>
    document.getElementById('photo').addEventListener('change', function(event) {
    // Ambil file yang dipilih oleh pengguna
    const file = event.target.files[0];
    // Buat objek URL untuk pratinjau foto
    const imageURL = URL.createObjectURL(file);
    // Perbarui src dari elemen img untuk menampilkan pratinjau foto
    document.getElementById('photo-preview').src = imageURL;
    // Tampilkan elemen img pratinjau foto
    document.getElementById('photo-preview').style.display = 'block';
});
</script>
@endsection
