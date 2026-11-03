<?php

namespace App\Http\Controllers\Web;

use App\Models\Staf;
use App\Models\Master;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class StafController extends Controller
{
    public function index()
    {
        $staf = Staf::with('category')->orderBy('created_at', 'desc')->get();
        // dd($staff
        return view('staf.view_staf', [
            'staf' => $staf,
            'title' => 'Staf',
        ]);
    }

    public function create()
    {
        $categoryStaf = Master::where('type', 'staf')->where('status',1)->pluck('name', 'id');
        return view('staf.add_staf', [
            'title' => 'Tambah Staf',
            'categoryStaf' => $categoryStaf,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nip' => [
                    'required',
                    'numeric',
                    Rule::unique('stafs')
                ],
                'name' => 'required|max:255',
                'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2084',
                'phone_number' => [
                    'nullable',
                    Rule::unique('stafs')
                ],
                'email' => ['nullable', Rule::unique('stafs')],
                'status' => 'nullable|boolean',
                'category_staf_id' => 'required|uuid',
            ]);
    
    
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/staff', $imageName);
                $validatedData['photo'] = $imageName;
            }
    
            $staf = new Staf();
            $staf->id = Str::uuid();
            $staf->category_staf_id = $validatedData[ 'category_staf_id'];
            $staf->nip = $validatedData['nip'];
            $staf->name = $validatedData['name'];
            $staf->photo = $imageName;
            $staf->phone_number = $validatedData['phone_number'];
            $staf->email = $validatedData['email'];
            $staf->status = $validatedData['status'] ?? false;
            $staf->save();
    
            // return redirect()->route('staf.index')->with('success', 'Data berhasil ditambahkan');
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
        $staf = Staf::findorFail($id);

        return view('staf.read_staf', [
            'active' => 'staf',
            'class' => 'card shadow bg-light text-dark',
            'class2' => 'text-dark',
            'title' => 'Lihat Staf',
            'staf' => $staf,
        ]);
    }

    public function edit($id)
    {
        $staf = Staf::findOrFail($id);
        $categoryStaf = Master::where('type', 'staf')->where('status', 1)->pluck('name', 'id');
        return view('staf.edit_staf', [
            'staf' => $staf,
            'title' => 'Edit Staf',
            'categoryStaf' => $categoryStaf,
        ]);
    }

    public function update(Request $request, $id)
{
    try {
        $validatedData = $request->validate([
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'name' => 'required|max:255',
            // 'email' => 'nullable|email',
            'status' => 'nullable|boolean',
            'category_staf_id' => 'required|uuid',
        ]);

        $staf = Staf::findOrFail($id);

        // Validate nip if it has been changed
        if ($request->input('nip') !== $staf->nip) {
            $request->validate([
                'nip' => 'required|numeric|unique:stafs',
            ]);
            $validatedData['nip'] = $request->input('nip');
        } else {
            $validatedData['nip'] = $staf->nip;
        }

        // Validate phone number if it has been changed
        if ($request->input('phone_number') !== $staf->phone_number) {
            $request->validate([
                'phone_number' => 'nullable|unique:stafs',
            ]);
            $validatedData['phone_number'] = $request->input('phone_number');
        } else {
            $validatedData['phone_number'] = $staf->phone_number;
        }

        if ($request->input('email') !== $staf->email) {
            $request->validate([
                'email' => 'nullable|email|unique:stafs',
            ]);
            $validatedData['email'] = $request->input('email');
        } else {
            $validatedData['email'] = $staf->email;
        }

        if ($request->hasFile('photo')) {
            // Delete the old photo
            Storage::delete('public/' . $staf->photo);

            // Upload the new photo
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/staff', $imageName);
            $validatedData['photo'] = $imageName;
        }

        $staf->category_staf_id = $validatedData['category_staf_id'];
        $staf->nip = $validatedData['nip'];
        $staf->name = $validatedData['name'];
        if (isset($validatedData['photo'])) {
            $staf->photo = $validatedData['photo'];
        }
        $staf->phone_number = $validatedData['phone_number'];
        $staf->email = $validatedData['email'];
        $staf->status = $validatedData['status'] ?? false;
        $staf->save();

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
            $staf = Staf::findOrFail($id);
            Storage::delete($staf->photo);
            $staf->delete();

            // return redirect()->back()->with('success', 'Data berhasil dihapus.');
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

    public function status(Request $request, $id){
        $staf =  Staf::findOrFail($id);
        $status = $request->input('status');
        $staf->update(['status' => $status]);

        return redirect()->back()->with('Berhasil', 'Status berhasil ditambahkan');
    }
}