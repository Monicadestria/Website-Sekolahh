@extends('partials.main')
@section('content')

<div class="card card-primary mt-4 mb-4">
	<div class="card-header">
		<h5 class="card-title">
			<a href="{{ route('berita.index') }}" class="mr-2">
			<i class="bi bi-chevron-left " style="color: black; font-weight:bold;"></i>
			</a> Tambah Data Berita
		</h5>
	</div>
	<form action="{{ route('berita.store') }}" method="post" enctype="multipart/form-data" class="needs-validation" id="form-create" novalidate>
	@csrf
	<div class="card-body">
		<div class="form-group row mt-3">
			<label class="col-sm-3 col-form-label">Judul</label>
			<div class="col-sm-9">
				<input type="text" pattern=".*\S.*" class="form-control" id="title" name="title" placeholder="" required>
				<div class="invalid-feedback">
					Perlu diisi
				</div>
			</div>
		</div>

		<div class="form-group row mt-3">
			<label class="col-sm-3 col-form-label">Kategori</label>
			<div class="col-sm-9">
				<select class="form-select" name="category_berita_id" required>
				{{-- <option>== Pilih Kategori ==</option> --}}
				@foreach ($categoryBerita as $id => $name)
					<option value="{{ $id }}">{{ $name }}</option>
				@endforeach
				</select>
			</div>
		</div>

		<div class="form-group row mt-3">
			<label class="col-sm-3 col-form-label">Slug</label>
			<div class="col-sm-9">
				<input type="text" pattern=".*\S.*" class="form-control" id="slug" name="slug" placeholder="" required>
				<div class="invalid-feedback">
					Perlu diisi
				</div>
			</div>
		</div>

		<div class="form-group row mt-3">
			<label class="col-sm-3 col-form-label">Foto</label>
			<div class="col-sm-9">
				<input type="file" class="form-control" id="photo" name="photo" accept=".jpg, .png, .jpeg" placeholder="" required>
				<img id="photo-preview" src="#" alt="Pratinjau" style="max-width: 200px; display: none; margin-top: 4px;">
				<div class="invalid-feedback">
					Perlu dipilih
				</div>
			</div>
		</div>

		<div class="form-group row mt-3">
            <label class="col-sm-3 col-form-label">Isi</label>
            <div class="col-sm-9">
                <input id="body" type="hidden" name="body">
                <trix-editor input="body" data-direct-upload-url="{{ route('upload') }}" data-persisted>
                </trix-editor>
				<div class="invalid-feedback">
					Perlu diisi
				</div>
			</div>
        </div>

		<div class="form-group row mt-3">
			<label class="col-sm-3 col-form-label">Status:</label>
			<div class="col-sm-9">
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="status" id="publish" value="1" checked required>
					<label class="form-check-label" for="publish">Publish</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="status" id="draft" value="0" required>
					<label class="form-check-label" for="draft">Draft</label>
				</div>
			</div>
			<div class="invalid-feedback">
				Perlu dipilih
			</div>
		</div>
	</div>
		<div class="card-footer text-end">
            <a href="{{ route('berita.create') }}" title="Batal" class="btn btn-danger">Batal</a>
            <input type="submit" name="Simpan" value="Simpan" class="btn btn-primary">
        </div>
	</form>
</div>

 <script>
  const title = document.querySelector('#title');
  const slug = document.querySelector('#slug');

  title.addEventListener('change', function() {
   fetch('/berita/create/checkSlug?title=' + title.value, {
    method: 'GET'
   }).then(response => response.json()).then(data => slug.value = data.slug);
  });
 </script>

<script>
	document.addEventListener('trix-file-accept', function(event) {
		console.log('trix-file-accept event triggered');
		if (event.file) {
			// Cegah perilaku default untuk menghindari penyisipan file dua kali
			event.preventDefault();
	
			// Upload file
			uploadFile(event.file);
		}
	});
	
	function uploadFile(file) {
		console.log('uploadFile function called');
		
		var form = new FormData();
		form.append('file', file);
	
		var csrfToken = document.querySelector('meta[name="csrf-token"]');
		if (!csrfToken) {
			console.error('CSRF token meta tag not found');
			return;
		}
	
		fetch('{!! route("upload") !!}', {
			method: 'POST',
			body: form,
			headers: {
				'X-CSRF-TOKEN': csrfToken.getAttribute('content')
			}
		})
		.then(response => response.json())
		.then(data => {
			console.log('Response received:', data);
			if (data.url) {
				var imageUrl = data.url;
	
				// Sisipkan gambar ke dalam konten editor Trix hanya sekali
				var editor = document.querySelector("trix-editor");
				editor.editor.insertHTML(`<img src="${imageUrl}">`);
			} else {
				console.error('URL gambar tidak tersedia dalam respons JSON');
			}
		})
		.catch(error => {
			console.error('Error:', error);
		});
	}
</script>	

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
