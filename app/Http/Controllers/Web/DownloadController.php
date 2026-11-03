<?php

namespace App\Http\Controllers\Web;

use App\Models\Master;
use App\Models\Download;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use Yajra\DataTables\Facades\DataTables;


class DownloadController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        if ($request->ajax()) {
            // Eager load the categoryDownloads relationship
            $data = Download::with('CategoryDownloads')->orderBy('created_at', 'desc')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('no', function($row) {
                    static $no = 1;
                    return '<div>' . $no++ . '</div>';
                })
                ->addColumn('category_name', function($row) {
                    return $row->CategoryDownloads->name ?? 'Tidak ada data kategori';
                })
                ->addColumn('desc', function($row) {
                    $desc = $row->desc;
                    $words = explode(' ', $desc);
                    if (count($words) > 5) {
                        $shortDesc = implode(' ', array_slice($words, 0, 5)) . '...';
                        $fullDesc = $desc;
                        return '<span class="short-desc">' . $shortDesc . '</span><span class="full-desc" style="display:none;">' . $fullDesc . '</span> <a href="#" class="toggle-desc">Selengkapnya</a>';
                    } else {
                        return $desc;
                    }
                })
                ->addColumn('file', function($row) {
                    return basename($row->file);
                })
                ->addColumn('status', function($row) {
                    return $row->status ? '<div class="text-start" style="width:90px;">Aktif' : '<div class="text-start" style="width:90px;">Tidak Aktif</div>';
                })
                ->addColumn('aksi', function($row) use ($userId) {
                    $btn = '
                    <div class="text-center" style="width:130px;">
                        <a href="' . asset("storage/download/original/{$userId}/{$row->file}") . '" download title="Unduh" class="btn btn-primary btn-sm mx-1">
                            <i class="bi bi-cloud-arrow-down-fill"></i>
                        </a>
                        <a href="' . route('download.edit', $row->id) . '" title="Ubah" class="btn btn-warning btn-sm text-light">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <form class="form-delete d-inline" method="post" action="' . route('download.delete', $row->id) . '">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button class="btn btn-sm btn-danger text-light" title="Hapus" type="submit">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </div>
                    ';
                    return $btn;
                })
                ->rawColumns(['no', 'desc', 'status', 'aksi'])
                ->make(true);
        }

        return view('download.index', [
            'title' => 'Unduh | Admin',
        ]);
    }

    public function create()
    {
        $categoryDownloads = Master::where('type', '=', 'Unduh')->where('status', '=', 1)->pluck('name', 'id');

        return view('download.create', [
            'categoryDownloads' => $categoryDownloads,
            'title' => 'Tambah Unduh',
        ]);
    }
    
    public function store(Request $request) {

        $messages = [
            'file.required' => 'Berkas wajib diunggah.',
            'file.file' => 'Yang diunggah harus berupa berkas.',
            'file.mimes' => 'Format berkas harus PDF, Word, Excel, dan PowerPoint.',
            'file.max' => 'Ukuran berkas maksimal 5MB.',
            'title.required' => 'Judul wajib diisi.',
            'category_download_id.required' => 'Kategori unduhan wajib dipilih.',
        ];
    
        try {
            $request->validate([
                'file' => 'required|file|mimes:pdf,docx,docx,xls,xlsx,ppt,pptx|max:5120',
                'title' => 'required',
                'category_download_id' => 'required',
            ], $messages);

            $userId = Auth::id();
    
            $file = $request->file('file');
            $originalFileName = $file->getClientOriginalName();
    
            // Dapatkan judul dari request  
            $title = $request->title;
    
            // Dapatkan ekstensi file
            $extension = $file->getClientOriginalExtension();
    
            // Buat nama file baru dari judul dan ekstensi
            $fileName = $title . '.' . $extension;
    
            // Ubah path penyimpanan menjadi storage/download
            $path = $file->storeAs("public/download/original/{$userId}", $fileName);
    
            // Ubah penyimpanan menjadi storage: 'storage/app/public/download'
            $storedPath = str_replace('public/', 'storage/', $path);
    
            // Buat model Download dan simpan ke database
            $download = new Download();
            $download->id = Str::uuid();
            $download->category_download_id = $request->category_download_id;
            $download->file = basename($storedPath);
            $download->title = $request->title;
            $download->desc = $request->desc;
            $download->status = $request->status; 
            $download->save();
    
            $response = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'message' => 'Data berhasil ditambahkan.',
                'data' => $download,
            ];
            return response()->json($response);
        } catch (\Exception $e) {
        
            $errorMessage = $e->getMessage();
            $response = [
                'icon' => 'error',
                'title' => 'Gagal!',
                'message' => $errorMessage,
                'data' => null,
            ];
            return response()->json($response);
        }
    }

    public function edit($id)
    { 
        $userId = Auth::id();
        $downloads  = Download::findOrFail($id);
        $categoryDownloads = Master::where('type', '=', 'Unduh')->where('status', '=', 1)->pluck('name', 'id');

        return view('download.edit', [
            'title' => 'Ubah Unduh',
            'downloads' => $downloads,
            'categoryDownloads' => $categoryDownloads,
            'userId' =>$userId,
        ]);
    }

    public function update(Request $request, $id)
    {
        $userId = Auth::id();
        $messages = [
            'file.required' => 'Berkas wajib diunggah.',
            'file.file' => 'Yang diunggah harus berupa berkas.',
            'file.mimes' => 'Format berkas harus PDF, Word, Excel, dan PowerPoint.',
            'file.max' => 'Ukuran berkas maksimal 5MB.',
            'title.required' => 'Judul wajib diisi.',
            'category_download_id.required' => 'Kategori unduhan wajib dipilih.',
        ];
    
        try {
            $request->validate([
                'category_download_id' => 'required',
                'title' => 'required',
                'file' => 'nullable|file|mimes:pdf,docx,docx,xls,xlsx,ppt,pptx|max:5120', // Sesuaikan aturan validasi file sesuai kebutuhan
            ], $messages);
    
            $download = Download::findOrFail($id);
    
            // Simpan nama file lama
            $oldFileName = 'storage/download/original/' . $userId . '/' . $download->file;
        
            // Jika ada perubahan judul
            if ($request->has('title') && !$request->hasFile('file')) {
                // Ubah nama file sesuai judul baru
                $newFileName = $request->title . '.' . pathinfo($oldFileName, PATHINFO_EXTENSION);

                // Dapatkan jalur file lama dan jalur yang baru
                $oldPath = str_replace('storage/', 'public/', $oldFileName);
                $newPath = 'public/download/original/' . $userId . '/'  . $newFileName;

                // Pindahkan file dengan nama baru
                Storage::move($oldPath, $newPath);

                // Perbarui jalur file dalam database
                $download->file = basename(str_replace('public/', 'storage/', $newPath));
            }

            // Jika ada file baru yang diunggah
            if ($request->hasFile('file')) {
                $file = $request->file('file');

                // Hapus file lama dari penyimpanan lokal dan dari database jika ada
                if ($oldFileName) {
                    Storage::delete(str_replace('storage/', 'public/', $oldFileName));
                    $download->file = null; // Atau sesuaikan dengan kolom file yang sesuai pada model
                }

                $file_name = $request->title . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs("public/download/original/{$userId}", $file_name);
                $storedPath = str_replace('public/', 'storage/', $path);
                $download->file = basename($storedPath);
            }
    
            // Update data
            $download->category_download_id = $request->category_download_id;
            $download->title = $request->title;
            $download->desc = $request->desc;
            $download->status = $request->status;
            $download->save();

            $response = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'message' => 'Data berhasil diubah.',
                'data' => $download,
            ];
            return response()->json($response);
        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
            $response = [
                'icon' => 'error',
                'title' => 'Gagal!',
                'message' =>   $errorMessage,
                'data' => null,
            ];
            return response()->json($response);
        }
    }

    public function delete($id)
    {
        try {
            // Menemukan data Download termasuk data soft deleted
            $download = Download::withTrashed()->find($id);
        
            $storagePath = asset('storage/download/original'. $download->file);
            // Jika data benar-benar tidak ada (tidak ditemukan termasuk soft deleted), hapus file
                if (!$download) {
                    if (Storage::exists($storagePath)) {
                        // Hapus file asli
                        Storage::delete($storagePath);
                    }
                } else {
                    // Jika data ada (termasuk soft deleted), hanya lakukan soft delete pada data
                    $download->delete();
        
                    $response = [
                        'icon' => 'success',
                        'title' => 'Berhasil!', 
                        'message' => 'Data berhasil dihapus',
                        'data' => '',
                    ];
                }
            return response()->json($response);
        } catch (\Exception $e) {
            $response = [
                'icon' => 'error',
                'title' => 'Gagal!',
                'message' => 'Data gagal dihapus',
                'data' => null,
            ];
            return response()->json($response);
        }
    }
    
    public function status($id)
    {
        try {
            $status_download = Download::find($id);

            if (!$status_download) {
                return redirect()->route('download.index')->with('error', 'Data tidak ditemukan.');
            }

            $status_download->status = !$status_download->status;
            $status_download->save();   

            return redirect()->route('download.index')->with('success', 'Status berhasil diubah.');
        } catch (\Exception $e) {
            return redirect()->route('download.index')->with('error', 'Data gagal diubah ');
        }
    }

}
