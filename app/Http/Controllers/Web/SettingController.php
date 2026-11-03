<?php

namespace App\Http\Controllers\Web;

use Exception;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\SettingRequest;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        DB::beginTransaction();
        try {
            $data = Setting::with('theme')->where('created_by', auth()->user()->id)->first();
            if(is_object($data) && property_exists($data, 'error')) {
                throw new Exception($data->error);
            } else {
                DB::commit();
                $title = 'Setting';
                $id = $data['id'];
                return view('setting.setting_index', compact('data', 'id', 'title'));
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update($id, Request $request)
    {
        DB::beginTransaction();
        try {
            $rules = (new SettingRequest)->rules();
            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {
                throw new Exception(validator_errors($validator));
            } else {
                $find = Setting::find($id);
                if(is_object($find) && property_exists($find, 'error')) {
                    throw new Exception($find->error);
                } else {
                    if(!$find) {
                        throw new Exception("Not Found", 404);
                    } else {
                        $new_data = [
                            'updated_by' => auth()->user()->id,
                            'slug' => Str::slug($request['school_name']),
                        ];
                        $logo = '';

                        foreach ($request->all() as $key => $val) {
                            if($key == 'logo') {
                                $logo = $val;
                            } else {
                                $new_data[$key] = $val;
                            }
                        }

                        if($logo) {
                            $logo_name = $id . '.' . $logo->getClientOriginalExtension();
                            $logo->storeAs('/public/setting', $logo_name);
                            $new_data['logo'] = $logo_name;
                        }

                        $data = $find->update($new_data);
                        if(is_object($data) && property_exists($data, 'error')) {
                            throw new Exception($data->error);
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
}
