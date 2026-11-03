@extends('partials.main')

@section('content')
<div class="card card-primary my-4">
    <div class="card-header">
        <h5 class="card-title">
            <a href="{{ route('download.index') }}" class="mr-2">
                <i class="bi bi-chevron-left" style="color: black; font-weight: bold;"></i>
            </a> 
            Tambah Data Unduh
        </h5>
    </div>
    <form class="needs-validation" id="form-create" method="post" enctype="multipart/form-data" action="{{ route('download.store') }}" novalidate>
        @csrf
        <div class="card-body">
            <div class="form-group row mt-3">
                <label class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " pattern=".*\S.*" name="title" required>
                    <div class="invalid-feedback">
                        Perlu diisi
                    </div>
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-10">
                    <select class="form-select" name="category_download_id" required>
                        @foreach ($categoryDownloads as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>        
                    <div class="invalid-feedback">
                        Perlu diisi
                    </div>            
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-2 col-form-label">File</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control file-input" id="fileTambah" name="file" lang="id" placeholder="Pilih File" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" required>
                    <font class="text-muted" style="font-size: 12px;">Format file PDF, Word (DOC, DOCX), Excel (XLS, XLSX), dan PowerPoint (PPT, PPTX)</font>
                    <div class="invalid-feedback">
                        Perlu diisi
                    </div>
                    <center>
                        <div class="card-file mt-4" style="display: none;">Pratinjau File</div>
                        <div id="pdfViewer1" class="embed-responsive-item mb-3 mt-1" style="display: none;"></div>
                    </center>
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="desc" style="height: 80px;" pattern=".*\S.*"></textarea>
                    <div class="invalid-feedback">
                        Perlu diisi
                    </div>
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    @php
                        $defaultValue = 1; // Nilai default
                    @endphp
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="statusAktif" value="1" {{ $defaultValue == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="statusAktif">Aktif</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="statusTidakAktif" value="0" {{ $defaultValue == 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="statusTidakAktif">Tidak Aktif</label>
                    </div>
                    <div class="invalid-feedback">
                        Perlu diisi
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer mb-3" style="background-color: transparent;">
            <input type="submit" name="Simpan" value="Simpan" class="btn btn-primary mt-2 mb-3" style="float: right;">
            <a href="#" onclick="clearForm()" title="Kembali" class="btn btn-danger mt-2 mb-3" style="float: right; margin-right: 10px;">Batal</a>
        </div>
    </form>
</div>

@endsection
