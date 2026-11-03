@extends('partials.main')

@section('content')
<div class="card card-primary my-4">
    <div class="card-header">
        <h5 class="card-title">
            <a href="{{ route('download.index') }}" class="mr-2">
                <i class="bi bi-chevron-left" style="color: black; font-weight:bold;"></i>
            </a> 
            Ubah Data Unduh
        </h5>
    </div>
    <form class="needs-validation form-edit" method="POST" enctype="multipart/form-data" action="{{ route('download.update', $downloads->id) }}" novalidate>
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group row mt-3">
                <label class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title" pattern=".*\S.*" value="{{ $downloads->title }}" required>
                    <div class="invalid-feedback">
                        Perlu diisi.
                    </div>
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-10">
                    <select class="form-select" name="category_download_id">
                        @foreach ($categoryDownloads as $id => $name)
                            <option value="{{ $id }}"  {{ $id == $downloads->category_download_id ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>        
                    <div class="invalid-feedback">
                        Kategori wajib dipilih.
                    </div>
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-2 col-form-label">File</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control file-input" id="fileUbah" name="file" lang="id" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                    <small class="text-muted" style="font-size:12px;">
                        Format file PDF, Word (DOC, DOCX), Excel (XLS, XLSX), dan PowerPoint (PPT, PPTX)
                    </small>
                    <div class="invalid-feedback">
                        Perlu diisi
                    </div>
                    <center>
                        @if(pathinfo(asset('storage/download/original/' . $userId . '/' . $downloads->file), PATHINFO_EXTENSION) == 'pdf')
                            <div id="card-file-value" class="card-file mt-4" style="display: none;">Pratinjau File</div>
                            <div id="pdf-viewer" class="embed-responsive-item mb-3 mt-1" style="display: none;"
                            data-src="{{ asset('storage/download/original/' . $userId . '/' . $downloads->file) }}"></div>
                        @endif
                        <div id="card-file-js" class="card-file mt-4" style="display: none;">Pratinjau File</div>
                        <div id="pdfViewer2" class="embed-responsive-item mb-3 mt-1" style="display: none;"></div>
                    </center>
                </div>
            </div>

            <div class="form-group row mt-3 mb-4">
                <label for="desc" class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="desc" name="desc" style="height: 80px;" pattern=".*\S.*" >{{ $downloads->desc }}</textarea>
                    <div class="invalid-feedback">
                        Perlu diisi
                    </div>
                </div>
            </div>

            <div class="form-group row mt-3 mb-4">
                <label class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="statusAktif" value="1" @if($downloads->status == 1) checked @endif>
                        <label class="form-check-label" for="statusAktif">Aktif</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="statusTidakAktif" value="0" @if($downloads->status == 0) checked @endif>
                        <label class="form-check-label" for="statusTidakAktif">Tidak Aktif</label>
                    </div>
                    <div class="invalid-feedback">
                        Perlu diisi
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer mb-5 " style="background-color: transparent; ">
            <input type="submit" name="Simpan" value="Simpan" class="btn btn-primary mt-2 mb-3" style="float: right;">
            <a href="{{ route('download.edit', $downloads->id) }}" title="Kembali" class="btn btn-danger mt-2 mb-3" style="float: right; margin-right: 10px;">Batal</a>
        </div>
    </form>
</div>
@endsection
