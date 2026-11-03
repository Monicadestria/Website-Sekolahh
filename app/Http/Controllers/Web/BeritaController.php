<?php

namespace App\Http\Controllers\Web;

use App\Models\Berita;
use App\Models\Master;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::with('CategoryBerita')->orderBy('created_at', 'desc')->get();
        return view('berita.view_berita', [
            'berita' => $berita,
            'title' => 'Berita',
        ]);
    }


    public function create()
    {
        $categoryBerita = Master::where('type', 'berita')->where('status', 1)->pluck('name', 'id');
        return view('berita.add_berita',  [
            'title' => 'Tambah Berita',
            'categoryBerita' => $categoryBerita,
        ]);
    }

    public function store(Request $request)
    {
        try {
            // Validasi
            $validatedData = $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // Validasi upload foto
                'title' => 'required|max:100',
                'slug' => 'required|unique:beritas',
                'body' => 'required',
                'category_berita_id' => 'required|uuid',
                'status' =>  'nullable|boolean',
            ]);
            
            // Upload File
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->storeAs('public/berita', $imageName);
                $validatedData['photo'] = $imageName;
            }

            // Menyimpan data dalam database
            $berita = new Berita();
            $berita->id = Str::uuid(); // Hasilkan UUID untuk kolom 'id'
            $berita->user_id = Auth::id();
            $berita->category_berita_id = $validatedData['category_berita_id'];
            $berita->title = $validatedData['title'];
            $berita->slug = $validatedData['slug'];
            $berita->body = $validatedData['body'];
            $berita->status = $validatedData['status'] ?? false;
            $berita->photo = $imageName; // Menyimpan foto dalam storage/app
            $berita->save();

            // Redirect back with success message
            // return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');

            $response = [
                'icon' => 'success',
                'title' => 'Berhasil!', 
                'message' => 'Data berhasil ditambahkan.',
                'data' => '',
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'icon' => 'error',
                'title' => 'Gagal!',
                'message' => $th->getMessage(),
                'data' => '', 
            ];

            return response()->json($response);
        }
    }

    public function show($id)
    {
    $berita = Berita::findOrFail($id);
    
    return view('berita.read_berita', [
        'active' => 'berita', 
        'class' => 'card shadow bg-light text-dark',
        'class2' => 'text-dark',
        'title' => 'Lihat Berita',
        'berita' => $berita, // Memasukkan data $berita ke dalam view
    ]);
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        $categoryBerita = Master::where('type', 'berita')->where('status', 1)->pluck('name', 'id'); // Ambil semua kategori berita
        
        return view('berita.edit_berita',  [
            'berita' => $berita,
            'categoryBerita' => $categoryBerita, // Kirim data kategori berita ke view
            'title' => 'Edit Berita',
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
                'title' => 'required|max:100',
                'slug' => 'required|max:255',
                'body' => 'required',
                'category_berita_id' => 'required|uuid',
                'status' => 'nullable|boolean',
            ]);
    
            $berita = Berita::findOrFail($id);
    
            if ($request->input('slug') !== $berita->slug) {
                $request->validate([
                    'slug' => 'unique:beritas',
                ]);
            }
    
            if ($request->hasFile('photo')) {
                // Hapus foto lama
                Storage::delete('public/berita'.$berita->photo);
    
                // Upload foto baru
                $image = $request->file('photo');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->storeAs('public/berita', $imageName);
                $validatedData['photo'] = $imageName;
            }
    
            $berita->category_berita_id = $validatedData['category_berita_id'];
            $berita->title = $validatedData['title'];
            // $berita->slug = $validatedData['slug'];
            $berita->slug = $request->input('slug', $berita->slug);
            $berita->body = $validatedData['body'];
            $berita->status = $validatedData['status'] ?? false;
    
            if(isset($validatedData['photo'])){
                $berita->photo = $validatedData['photo'];
            }
            $berita->save();
    
            // return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
            $response = [
                'icon' => 'success',
                'title' => 'Berhasil!', 
                'message' => 'Data berhasil diubah.',
                'data' => '',
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'icon' => 'error',
                'title' => 'Gagal!',
                'message' => $th->getMessage(),
                'data' => '',
            ];

            return response()->json($response);
        }
    }

    public function delete($id)
    {
        try {
            $berita = Berita::findOrFail($id);
            Storage::delete($berita->photo);
            $berita->delete();

            // return redirect()->back()->with('success', 'Berita berhasil dihapus.');
            $response = [
                'icon' => 'success',
                'title' => 'Berhasil!', 
                'message' => 'Data berhasil dihapus.',
                'data' => '',
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'icon' => 'error',
                'title' => 'Gagal!',
                'message' => $th->getMessage(),
                'data' => '',
            ];

            return response()->json($response);
        }
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Berita::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

    public function upload(Request $request)
    {
        if (!$request->hasFile('file')) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }
        $file = $request->file('file');

        // Simpan file ke dalam penyimpanan
        $path = $file->store('public/uploads');

        // Dapatkan URL gambar dari penyimpanan
        $url = Storage::url($path);

        return response()->json(['url' => $url]);
    }

    public function status(Request $request, $id){
        $berita =  Berita::findOrFail($id);
        $status = $request->input('status');
        $berita->update(['status' => $status]);

        return redirect()->back()->with('success', 'Status berhasil ditambahkan');
    }
}
