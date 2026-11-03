<?php

namespace App\Http\Controllers\Web;

use Exception;
use App\Models\Theme;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ThemeRequest;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        DB::beginTransaction();
        try {
            $datas = Theme::
            orderBy('created_at', 'desc')
            ->get();
            
            if(is_object($datas) && property_exists($datas, 'error')) {
                throw new Exception($datas->error);
            } else {
                DB::commit();
                $title = "Theme";
                confirmDelete('Delete', 'Apakah anda yakin?');
                return view('theme.theme_index', compact('datas', 'title'));
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
        return view('theme.theme_create');
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

            $rules = (new ThemeRequest)->rules();
            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {
                throw new Exception(validator_errors($validator));
            } else {
                $theme_color_primary = $request['theme_color_primary'];
                $theme_color_secondary = $request['theme_color_secondary'];
                $theme_color_primary_transparant = $request['theme_color_primary'] . 'EE';
                $theme_color_secondary_transparant = $request['theme_color_secondary'] . 'EE' ;
                $theme_color_body = $request['theme_color_body'];
                $theme_color_body_transparant = $request['theme_color_body'] . 'EE' ;
                $font_color_primary = $request['font_color_primary'];
                $font_color_secondary = $request['font_color_secondary'];
                $font_color_body = $request['theme_color_body'];

$css_scheme =
".theme-color-primary {
    background-color : $theme_color_primary !important;
}
.theme-color-secondary {
    background-color : $theme_color_secondary !important;
}
.theme-color-primary-transparant {
    background-color : $theme_color_primary_transparant !important;
}
.theme-color-secondary-transparant {
    background-color : $theme_color_secondary_transparant !important;
}
body, .body {
    background-color : $theme_color_body !important;
}
.theme-color-body-transparant {
    background-color : $theme_color_body_transparant !important;
}
.font-color-primary, h1, h2, h3, h4, h5, .h1, .h2, .h3, .h4, .h5, .fs-1, .fs-2, .fs-3, .fs-4, .fs-5 {
    color : $font_color_primary !important;
    border-color : $font_color_primary !important;
}
.font-color-secondary, p, .p {
    color : $font_color_secondary !important;
    border-color : $font_color_secondary !important;
}
.font-color-body {
    color : $font_color_body !important;
    border-color : $font_color_body !important;
}
";
                $css_name = $request['id'] . '.css';
                $css_store = Storage::disk('public')->put('assets/themes/'.$css_name, $css_scheme);
                
                if(is_object($css_store) && property_exists($css_store, 'error')) {
                    throw new Exception($css_store->error);
                } else {
                    $result = Theme::create($request->all());
    
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
                }
            }
        } catch (\Throwable $th) {
            DB::rollback();

            $response = [
                'icon' => 'error',
                'title' => 'Gagal!',
                'message' => $th->getMessage(),
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
            $data = Theme::find($id);
            if(is_object($data) && property_exists($data, 'error')) {
                throw new Exception($data->error);
            } else {
                if (!$data) {
                    throw new Exception('Not Found', 404);
                } else {
                    DB::commit();
                    $title = 'Theme';

                    return view('theme.theme_show', compact('data', 'title'));
                }
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        DB::beginTransaction();
        try {
            $data = Theme::find($id);
            if(is_object($data) && property_exists($data, 'error')) {
                throw new Exception($data->error);
            } else {
                if(!$data) {
                    throw new Exception('Not Found', 404);
                } else {
                    DB::commit();
                    $title = 'Theme';

                    return view('theme.theme_edit', compact('data', 'title'));
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
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $rules = (new ThemeRequest)->rules();
            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {
                throw new Exception(validator_errors($validator));
            } else {
                $theme_color_primary = $request['theme_color_primary'];
                $theme_color_secondary = $request['theme_color_secondary'];
                $theme_color_primary_transparant = $request['theme_color_primary'] . 'EE';
                $theme_color_secondary_transparant = $request['theme_color_secondary'] . 'EE';
                $theme_color_body = $request['theme_color_body'];
                $theme_color_body_transparant = $request['theme_color_body'].'EE';
                $font_color_primary = $request['font_color_primary'];
                $font_color_secondary = $request['font_color_secondary'];
                $font_color_body = $request['theme_color_body'];

                $css_scheme = 
".theme-color-primary {
    background-color : $theme_color_primary !important;
}
.theme-color-secondary {
    background-color : $theme_color_secondary !important;
}
.theme-color-primary-transparant {
    background-color : $theme_color_primary_transparant !important;
}
.theme-color-secondary-transparant {
    background-color : $theme_color_secondary_transparant !important;
}
body, .body {
    background-color : $theme_color_body !important;
}
.theme-color-body-transparant {
    background-color : $theme_color_body_transparant !important;
}
.font-color-primary, h1, h2, h3, h4, h5, .h1, .h2, .h3, .h4, .h5, .fs-1, .fs-2, .fs-3, .fs-4, .fs-5 {
    color : $font_color_primary !important;
    border-color : $font_color_primary !important;
}
.font-color-secondary, p, .p {
    color : $font_color_secondary !important;
    border-color : $font_color_secondary !important;
}
.font-color-body {
    color : $font_color_body !important;
    border-color : $font_color_body !important;
}
";
                $css_name = $id . '.css';
                $css_store = Storage::disk('public')->put('assets/themes/'.$css_name, $css_scheme);

                if(is_object($css_store) && property_exists($css_store, 'error')) {
                    throw new Exception($css_store->error);
                } else {
                    $find = Theme::find($id);
                    
                    if(is_object($find) && property_exists($find, 'error')) {
                        throw new Exception($find->error);
                    } else {
                        if(!$find) {
                            throw new Exception('Not Found', 404);
                        } else {
                            $result = $find->update($request->all());
    
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
                }

            }
        } catch (\Throwable $th) {
            DB::rollback();

            $response = [
                'icon' => 'error',
                'title' => 'Gagal!',
                'message' => $th->getMessage(),
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
            $data = Theme::with('setting:id,theme_id')->find($id);
            // $setting = Setting::with('theme')->where('created_by', auth()->user()->id)->get();
            if(is_object($data) && property_exists($data, 'error')) {
                throw new Exception($data->error);
            // } else if(is_object($setting) && property_exists($setting, 'error')) {
            //     throw new Exception($setting->error);
            } else {
                if(!$data) {
                    throw new Exception('Not Found', 404);
                } else {
                    if(count($data->setting) > 0) {
                        throw new Exception("Tidak bisa menghapus data tema yang sedang digunakan", 500);
                    } else {
                        $result['file'] = Storage::disk('public')->delete('assets/themes/'.$id . '.css');
                        $result['data'] = $data->delete();
        
                        if(is_object($result['file']) && property_exists($result['file'], 'error')) {
                            throw new Exception($result['file']->error);
                        }else if(is_object($result['data']) && property_exists($result['data'], 'error')) {
                            throw new Exception($result['data']->error);
                        } else {
                            DB::commit();

                            $response = [
                                'icon' => 'success',
                                'title' => 'Berhasil!', 
                                'message' => 'Data berhasil dihapus.',
                                'data' => '',
                            ];

                            return response()->json($response);
                        }
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

    public function use($id)
    {
        DB::beginTransaction();
        try {
            $find = Theme::find($id);
            if(is_object($find) && property_exists($find, 'error')) {
                throw new Exception($find->error);
            } else {
                if(!$find) {
                    throw new Exception('Not Found', 404);
                } else {
                    $title = 'Theme';
                    $toggle = Theme::where('status', 1)->where('created_by', auth()->user()->id)->get();

                    foreach ($toggle as $item) {
                        if($item['status'] == 1) {
                            $result['toggle'] = $item->update([
                                'status' => 0,
                            ]);

                            if(is_object($result['toggle']) && property_exists($result['toggle'], 'error')) {
                                throw new Exception($result['toggle']->error);
                            }
                        }
                    }

                    $datas = Theme::all();

                    $result['setting'] = Setting::where('created_by', auth()->user()->id)->first()->update(['theme_id' => $id]);
                    $result['theme'] = $find->update(['status' => 1]);

                    if(is_object($result['setting']) && property_exists($result['setting'], 'error')) {
                        throw new Exception($result['setting']->error);
                    } else if(is_object($result['theme']) && property_exists($result['theme'], 'error')) {
                        throw new Exception($result['theme']->error);
                    } else if(is_object($datas) && property_exists($datas, 'error')) {
                        throw new Exception($datas->error);
                    } else {
                        DB::commit();
                        
                        $response = [
                            'icon' => 'success',
                            'title' => 'Berhasil!',
                            'message' => 'Tema berhasil digunakan.',
                            'data' => $datas,
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
                'message' => 'Tema gagal digunakan.',
                'daa' => '',
            ];

            return response()->json($response);
        }
    }
}
