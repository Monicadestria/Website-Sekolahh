@extends('partials.main')

@section('content')

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        let table = $('#tabelUnduh').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('download.index') }}",
            columns: [
                { data: 'no', name: 'no' },
                { data: 'category_name', name: 'category_name' },
                { data: 'title', name: 'title' },
                { data: 'file', name: 'file' },
                { data: 'desc', name: 'desc' },
                { data: 'status', name: 'status' },
                { data: 'aksi', name: 'aksi', orderable: false, searchable: false },
            ],
            searching: true,
            autoWidth: false,  // Menonaktifkan pengaturan lebar otomatis
            columnDefs: [
                { width: '4%', targets: 0 },
                { targets: 1 },  // Tidak diatur lebar
                { width: '15%', targets: 2 },
                { width: '15%', targets: 3 },
                { targets: 4 },  // Tidak diatur lebar
                { width: '90px', targets: 5 },
                { width: '150px', targets: 6 }
            ]
        });

        // Sembunyikan Processing DataTable
        $('#tabelUnduh').on('processing.dt', function(e, settings, processing) {
            if (settings.nTable.id === 'tabelUnduh') {
                $('#tabelUnduh_processing').hide();
            }
        });

        // Toggle description visibility
        $('#tabelUnduh').on('click', '.toggle-desc', function(e) {
            e.preventDefault();
            var $this = $(this);
            var $shortDesc = $this.siblings('.short-desc');
            var $fullDesc = $this.siblings('.full-desc');
            
            if ($fullDesc.is(':visible')) {
                $fullDesc.hide();
                $shortDesc.show();
                $this.text('Selengkapnya');
            } else {
                $fullDesc.show();
                $shortDesc.hide();
                $this.text('Tampilkan lebih sedikit');
            }
        });
    });
</script>


    {{-- Header --}}
    <div class="content-header">
        <div class="row mt-3">
            <div class="col-6">
                <h4 class="m-0 text-bawah-burger-menu ms-3">Unduh</h4>
            </div>
            <div class="col-6 d-flex justify-content-end" style="margin-left: -18px;">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Unduh</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row content flex-grow-1 mb-4 px-1">
        <div class="col-12">
            <div class="card text-center">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="m-0">Data Unduh</h5>
                    <a href="{{ route('download.create') }}" class="btn btn-primary">Tambah Unduh</a>
                </div>
                <div class="card-body text-start mt-0 pt-0 mb-2">
                    <div class="table-responsive">
                        <table id="tabelUnduh" class="table table-bordered table-striped sekolah m-auto p-auto">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-start">No</th>
                                    <th scope="col" class="text-start">Judul</th>
                                    <th scope="col" class="text-start">Kategori</th>
                                    <th scope="col" class="text-start">File</th>
                                    <th scope="col" class="text-start">Status</th>
                                    <th scope="col" class="text-start">Deskripsi</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@endpush
