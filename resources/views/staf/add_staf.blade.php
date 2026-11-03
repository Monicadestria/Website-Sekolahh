@extends('partials.main')
@section('content')

<div class="card card-primary mt-4 mb-4">
    <div class="card-header">
        <h5 class="card-title">
            <a href="{{ route('staf.index') }}" class="mr-2">
                <i class="bi bi-chevron-left " style="color: black; font-weight:bold;"></i>
            </a> Tambah Data Staf
        </h5>
    </div>
    <form action="{{ route('staf.store') }}" method="post" enctype="multipart/form-data" class="needs-validation" id="form-create" novalidate>
        @csrf
        <div class="card-body">
            <div class="form-group row mt-3">
                <label class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                    <input type="text" pattern=".*\S.*" class="form-control" id="name" name="name" placeholder="" required>
                    <div class="invalid-feedback">
                        Perlu diisi
                    </div>
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-3 col-form-label">Kategori </label>
                <div class="col-sm-9">
                    <select class="form-select" name="category_staf_id" required>
                        @foreach ($categoryStaf as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-3 col-form-label">NIP</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="nip" name="nip" placeholder="" required>
                    <div class="invalid-feedback">
                        Perlu diisi
                    </div>
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-3 col-form-label">Foto</label>
                <div class="col-sm-9">
                    <input type="file" class="form-control" id="photo" name="photo" accept=".jpg, .png, .jpeg" placeholder="Pilih Foto" required>
                    <img id="photo-preview" src="#" alt="Pratinjau" style="max-width: 200px; display: none; margin-top: 10px;">
                    <div class="invalid-feedback">
                        Perlu dipilih
                    </div>
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-3 col-form-label">No HP</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="phone_number" name="phone_number" placeholder="" required>
                    <div class="invalid-feedback">
                        Perlu diisi
                    </div>
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input type="text" pattern=".*\S.*" class="form-control" id="email" name="email" placeholder="" required>
                    <div class="invalid-feedback">
                        Perlu diisi
                    </div>
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-3 col-form-label">Status:</label>
                <div class="col-sm-9">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="active" value="1" checked>
                        <label class="form-check-label" for="active">Aktif</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="inactive" value="0">
                        <label class="form-check-label" for="inactive">Tidak Aktif</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('staf.create') }}" title="Batal" class="btn btn-danger">Batal</a>
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
