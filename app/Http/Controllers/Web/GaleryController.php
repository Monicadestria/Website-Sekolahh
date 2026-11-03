<?php

namespace App\Http\Controllers\Web;

use Exception;
use App\Models\Galery;
use App\Models\Master;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\GaleryRequest;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class GaleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        DB::beginTransaction();
        try {
            $datas = Galery::
            with('category_galery')
            ->orderBy('created_at', 'desc')
            ->get();
            if(is_object($datas) && property_exists($datas, 'error')) {
                throw new Exception($datas->error);
            } else {
                DB::commit();
                $title = "Galery";

                return view('galery.galery_index', compact('datas', 'title'));
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Galery';
        $category_galery = Master::where('type', 'galeri')
        ->where('status', 1)
        ->get();

        return view('galery.galery_create', compact('title', 'category_galery'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->merge([
                'id' => Str::uuid(),
            ]);

            $rules = (new GaleryRequest)->rules();
            $validator = Validator::make($request->all(), $rules);
            
            if($validator->fails()) {
                throw new Exception(validator_errors($validator));
            }

            $new_data = [];
            $photo = '';

            foreach ($request->all() as $key => $value) {
                if($key == 'photo') {
                    $photo = $value;
                } else {
                    $new_data[$key] = $value;
                }
            }

            if($photo) {
                $photo_name = $request['id'] . '.' . $photo->getClientOriginalExtension();
                $photo->storeAs('/public/galery', $photo_name);
                $new_data['photo'] = $photo_name;
            }

            $result = Galery::create($new_data);

            if(is_object($result) && property_exists($result, 'error')) {
                throw new Exception($result->error);
            } else {
                DB::commit();

                $response = [
                    'icon' => 'success',
                    'title' => 'Berhasil!',
                    'message' => 'Data berhasil ditambahkan.',
                    'data' => $result,
                ];

                return response()->json($response);
            }
        } catch (\Throwable $th) {
            DB::rollback();

            $response = [
                'icon' => 'error',
                'title' => 'Gagal!',
                'message' => $th->getMessage(),
                'data' => $request->all(),
            ];

            return response()->json($response);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        DB::beginTransaction();
        try {
            $data = Galery::with('category_galery:id,name')->find($id);
            if(is_object($data) && property_exists($data, 'error')) {
                throw new Exception($data->error);
            } else {
                if (!$data) {
                    throw new Exception('Not Found', 404);
                } else {
                    $category_galery = Master::where('type', 'galery')->get();
                    DB::commit();
                    $title = 'Galery';

                    return view('galery.galery_show', compact('data', 'category_galery', 'title'));
                }
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        DB::beginTransaction();
        try {
            $data = Galery::find($id);
            if(is_object($data) && property_exists($data, 'error')) {
                throw new Exception($data->error);
            } else {
                if(!$data) {
                    throw new Exception('Not Found', 404);
                } else {
                    $category_galery = Master::where('type', 'galeri')
                    ->where('status', 1)
                    ->get();
                    DB::commit();

                    return view('galery.galery_edit', compact('data', 'category_galery'));
                }
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        DB::beginTransaction();
        try {
            $rules = (new GaleryRequest)->rules();
            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {
                throw new Exception(validator_errors($validator));
            }

            $request->merge([
                'updated_by' => auth()->user()->id,
            ]);
            $new_data = [];
            $photo = '';

            foreach ($request->all() as $key => $value) {
                if($key == 'photo') {
                    $photo = $value;
                } else {
                    $new_data[$key] = $value;
                }
            }

            if($photo) {
                $photo_name = $id . '.' . $photo->getClientOriginalExtension();
                $photo->storeAs('/public/galery', $photo_name);
                $new_data['photo'] = $photo_name;
            }

            $find = Galery::find($id);
            
            if(is_object($find) && property_exists($find, 'error')) {
                throw new Exception($find->error);
            } else {
                if(!$find) {
                    throw new Exception('Not Found', 404);
                } else {
                    $result = $find->update($new_data);

                    if(is_object($result) && property_exists($result, 'error')) {
                        throw new Exception($result->error);
                    } else {
                        DB::commit();

                        $response = [
                            'icon' => 'success',
                            'title' => 'Berhasil!',
                            'message' => 'Data berhasil diubah.',
                            'data' => $find,
                        ];

                        return response()->json($response);
                    }
                }
            }
        } catch (\Throwable $th) {
            DB::rollback();

            $response = [
                'icon' => 'error',
                'title' => 'Gagal!',
                'message' => $th->getMessage(),
                'data' => '',
            ];

            return response()->json($response);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $data = Galery::find($id);
            if(is_object($data) && property_exists($data, 'error')) {
                throw new Exception($data->error);
            } else {
                if(!$data) {
                    throw new Exception('Not Found', 404);
                } else {
                    if($data['photo']) {
                        $delete_photo = Storage::disk('public')->delete('galery/' . $data['photo']);
                        if(is_object($delete_photo) && property_exists($delete_photo, 'error')) {
                            throw new Exception($delete_photo->error);
                        }
                    }

                    $result = $data->delete();
    
                    if(is_object($result) && property_exists($result, 'error')) {
                        throw new Exception($result->error);
                    } else {
                        DB::commit();

                        $response = [
                            'icon' => 'success',
                            'title' => 'Berhasil!',
                            'message' => 'Data berhasil dihapus',
                            'data' => '',
                        ];

                        return response()->json($response);
                    }
                }
            }
        } catch (\Throwable $th) {
            DB::rollback();
            
            $response = [
                'icon' => 'error',
                'title' => 'Gagal!',
                'message' => 'Data gagal dihapus',
                'data' => '',
            ];

            return response()->json($response);
        }
    }
}
