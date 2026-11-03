<?php

namespace App\Http\Controllers\Web\LP;
use Exception;

use App\Models\Galery;
use App\Models\Master;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LPGaleryController extends Controller
{
    // Gambar functions
    public function gambar_index($slug, Request $request)
    {
        DB::beginTransaction();
        try {
            $s_paging = $request['s_paging'] ? $request['s_paging'] : 10;
            $s_title = $request['s_title'] ? $request['s_title'] : null;
            $s_category = $request['s_category'] ? $request['s_category'] : null;

            $created_by = Setting::withoutGlobalScope('user_query_scope')
            ->where('slug', $slug)
            ->where('status', 1)
            ->select('created_by')
            ->first();


            if(!$created_by) {
                return redirect()->route('landing_page')->with('error', 'Sekolah tidak ditemukan');
            } else {
                $created_by = $created_by['created_by'];
            }

            $datas = Galery::withoutGlobalScope('user_query_scope')
            ->where('type', 'photo')
            ->where('status', 1)
            ->where('created_by', $created_by)
            ->when($s_title, function($q, $s_title){
                $q->where('title', 'LIKE', '%' . $s_title . '%');
            })
            ->when($s_category, function($q, $s_category){
                $q->whereHas('category_galery', function ($q) use($s_category) {
                    $q->withoutGlobalScope('user_query_scope')->where('id', $s_category);
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($s_paging)
            ->withQueryString();

            $categories = Master::withoutGlobalScope('user_query_scope')
            ->select(['id', 'name', 'type'])
            ->where('created_by', $created_by)
            ->where('type', 'Galeri')
            ->where('status', 1)
            ->get();

            if(is_object($created_by) && property_exists($created_by, 'error')) {
                throw new Exception($created_by->error);
            } else if(is_object($datas) && property_exists($datas, 'error')) {
                throw new Exception($datas->error);
            } else if(is_object($categories) && property_exists($categories, 'error')) {
                throw new Exception($categories->error);
            } else {
                DB::commit();

                if(isset($s_title) || $s_paging > 10 || isset($request['page']) || isset($s_category)) {
                    return response()->json($datas);
                } else {
                    return view('landing_page.galery.lp_galery', compact('datas', 'categories'));
                }
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }
    
    public function gambar_show($slug, $id)
    {
        DB::commit();
        try {
            $created_by = Setting::withoutGlobalScope('user_query_scope')
            ->where('slug', $slug)
            ->select('created_by')
            ->first()['created_by'];

            $datas = Galery::withoutGlobalScope('user_query_scope')
            ->where('type', 'photo')
            ->where('created_by', $created_by)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

            $data = Galery::withoutGlobalScope('user_query_scope')
            ->with('category_galery:id,name')
            ->find($id);

            if(is_object($created_by) && property_exists($created_by, 'error')) {
                throw new Exception($created_by->error);
            } else if(is_object($datas) && property_exists($datas, 'error')) {
                throw new Exception($datas->error);
            } else if(is_object($data) && property_exists($data, 'error')) {
                throw new Exception($data->error);
            } else {
                DB::commit();
                return view('landing_page.galery.lp_galery_show', compact('datas', 'data'));
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Video functions
    public function video_index($slug, Request $request)
    {
        DB::beginTransaction();
        try {
            $s_paging = $request['s_paging'] ? $request['s_paging'] : 10;
            $s_title = $request['s_title'] ? $request['s_title'] : null;
            $s_category = $request['s_category'] ? $request['s_category'] : null;

            $created_by = Setting::withoutGlobalScope('user_query_scope')
            ->where('slug', $slug)
            ->select('created_by')
            ->first();

            if(!$created_by) {
                return redirect()->route('landing_page');
            } else {
                $created_by = $created_by['created_by'];
            }

            $datas = Galery::withoutGlobalScope('user_query_scope')
            ->where('type', 'video')
            ->where('status', 1)
            ->where('created_by', $created_by)
            ->when($s_title, function($q, $s_title){
                $q->where('title', 'LIKE', '%' . $s_title . '%');
            })
            ->when($s_category, function($q, $s_category){
                $q->whereHas('category_galery', function ($q) use($s_category) {
                    $q->withoutGlobalScope('user_query_scope')->where('id', $s_category);
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($s_paging)
            ->withQueryString();

            $categories = Master::withoutGlobalScope('user_query_scope')
            ->select(['id', 'name', 'type'])
            ->where('created_by', $created_by)
            ->where('type', 'Galeri')
            ->where('status', 1)
            ->get();

            if(is_object($created_by) && property_exists($created_by, 'error')) {
                throw new Exception($created_by->error);
            } else if(is_object($datas) && property_exists($datas, 'error')) {
                throw new Exception($datas->error);
            } else if(is_object($categories) && property_exists($categories, 'error')) {
                throw new Exception($categories->error);
            } else {
                DB::commit();
                
                if(isset($s_title) || $s_paging > 10 || isset($request['page']) || isset($s_category)) {
                    return response()->json($datas);
                } else {
                    return view('landing_page.galery.lp_video', compact('datas', 'categories'));
                }
                
            }
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    public function video_show($slug, $id)
    {
        DB::commit();
        try {
            $created_by = Setting::withoutGlobalScope('user_query_scope')
            ->where('slug', $slug)
            ->select('created_by')
            ->first()['created_by'];

            $datas = Galery::withoutGlobalScope('user_query_scope')
            ->where('type', 'video')
            ->where('created_by', $created_by)
            ->orderBy('created_at', 'asc')
            ->take(5)
            ->get();

            $data = Galery::withoutGlobalScope('user_query_scope')
            ->find($id);

            if(is_object($created_by) && property_exists($created_by, 'error')) {
                throw new Exception($created_by->error);
            } else if(is_object($datas) && property_exists($datas, 'error')) {
                throw new Exception($datas->error);
            } else if(is_object($data) && property_exists($data, 'error')) {
                throw new Exception($data->error);
            } else {
                DB::commit();
                return view('landing_page.galery.lp_video_show', compact('datas', 'data'));
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }
}
