<?php

namespace App\Http\Controllers\Web;

use App\Models\Master;
use Illuminate\Http\Request;
use Nwidart\Modules\Routing\Controller;
use Yajra\DataTables\Facades\DataTables;

class MasterController extends Controller
{

    public function index(Request $request)
    {
        try {
            // Ambil data sesuai user yang login
            $query = Master::where('user_id', auth()->id());
    
            // Default sorting by created_at descending
            $query->orderBy('created_at', 'desc');
    
            // Handle sorting if requested
            if ($request->has('order')) {
                $order = $request->get('order')[0];
                $columns = $request->get('columns');
                $columnName = $columns[$order['column']]['data'];
                $direction = $order['dir'];
    
                // Handle custom sorting if column is not in the excluded list
                if (!in_array($columnName, ['DT_RowIndex', 'status', 'name', 'type', 'aksi'])) {
                    $query->orderBy($columnName, $direction);
                }
            }
    
            $data = $query->get();
    
            // Manually handle the row index
            $result = $data->map(function ($item, $key) {
                $item->DT_RowIndex = $key + 1;
                return $item;
            });
    
            return DataTables::of($result)
                ->addColumn('DT_RowIndex', function ($data) {
                    return $data->DT_RowIndex;
                })
                ->addColumn('aksi', function ($data) {
                    return view('category.tombol')->with('data', $data);
                })
                ->editColumn('status', function ($data) {
                    return $data->status == 1 ? 'Aktif' : 'Tidak Aktif';
                })
                ->editColumn('type', function ($data) {
                    return ucwords($data->type); // Title case hanya untuk kolom Type
                })
                ->rawColumns(['status', 'aksi'])
                ->make(true);
        } catch (\Exception $e) {
            return response()->json([
                'icon' => 'error',
                'title' => 'Error!',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ]);
        }
    }
    
    // public function index()
    // {
    //     try {
    //         // Ambil hanya data yang dimiliki oleh pengguna yang sedang masuk
    //         $data = Master::where('user_id', auth()->id())
    //             ->orderBy('created_at', 'desc')
    //             ->get();

    //         return DataTables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('aksi', function ($data) {
    //                 return view('category.tombol')->with('data', $data);
    //             })
    //             ->editColumn('status', function ($data) {
    //                 return $data->status == 1 ? '<div class="text-start">Aktif' : 'Tidak Aktif</div>';
    //             })
    //             ->editColumn('type', function ($data) {
    //                 return ucwords($data->type); // Title case hanya untuk kolom Type
    //             })
    //             ->rawColumns(['no','status', 'aksi'])
    //             ->make(true);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'icon' => 'error',
    //             'title' => 'Error!',
    //             'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
    //         ]);
    //     }
    // }
   

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $cekTrimNama = trim($request->input('name'));
       
        if ($cekTrimNama === '') {
            return response()->json([
                'icon' => 'warning',
                'title' => 'Perhatian!',
                'message' => 'Nama harus diisi.',
            ]);
        }
        try {
            $data = [
                'user_id'=> auth()->user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'status' => $request->status
            ];

            $master = Master::create($data);

            if ($master) {
                return response()->json([
                    'icon' => 'success',
                    'title' => 'Berhasil!',
                    'message' => 'Data berhasil ditambahkan.',
                ]);
            } else {
                return response()->json([
                    'icon' => 'error',
                    'title' => 'Gagal!',
                    'message' => 'Data gagal ditambahkan.',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'icon' => 'error',
                'title' => 'Error!',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ]);
        }
    }

    
    public function edit(string $id)
    {
        try {
            $data = Master::where('id', $id)->first();
            return response()->json(['result' => $data]);
        } catch (\Exception $e) {
            return response()->json([
                'icon' => 'error',
                'title' => 'Error!',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ]);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $data = [
                'name' => $request->name,
                'type' => $request->type,
                'status' => $request->status
            ];

            $updated = Master::where('id', $id)->update($data);

            if ($updated) {
                return response()->json([
                    'icon' => 'success',
                    'title' => 'Berhasil!',
                    'message' => 'Data berhasil diubah.',
                ]);
            } else {
                return response()->json([
                    'icon' => 'error',
                    'title' => 'Gagal!',
                    'message' => 'Data gagal diubah.',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'icon' => 'error',
                'title' => 'Error!',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $deleted = Master::where('id', $id)->delete();

            if ($deleted) {
                return response()->json([
                    'icon' => 'success',
                    'title' => 'Berhasil!',
                    'message' => 'Data berhasil dihapus.',
                    
                ]);
            } else {
                return response()->json([
                    'icon' => 'error',
                    'title' => 'Gagal!',
                    'message' => 'Data gagal dihapus.',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'icon' => 'error',
                'title' => 'Error!',
                'message' => 'Terjadi kesalahan: data tidak bisa dihapus karena masih ada di pakai ', 'data tidak bisa dihapus karena masih ada di pakai',
            ]);
        }
    }
}
