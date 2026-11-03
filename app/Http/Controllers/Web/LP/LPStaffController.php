<?php

namespace App\Http\Controllers\Web\LP;

use App\Models\Staf;
use App\Models\Master;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LPStaffController extends Controller
{
    public function landing($slug, Request $request) {
        $s_paging = $request['s_paging'] ? $request['s_paging'] : 10;
        $s_title = $request['s_title'] ? $request['s_title'] : null;
        $s_category = $request['s_category'] ? $request['s_category'] : null;

        $setting = Setting::withoutGlobalScope('user_query_scope')->where('slug', $slug)->first();
        $datas = Staf::withoutGlobalScope('user_query_scope')
        ->where('created_by', $setting->created_by)
        ->where('status', true)
        ->when($s_title, function($q, $s_title){
            $q->where('name', 'LIKE', '%' . $s_title . '%');
        })
        ->when($s_category, function($q, $s_category){
            $q->whereHas('category', function ($q) use($s_category) {
                $q->where('id', $s_category);
            });
        })
        ->orderBy('created_at', 'desc')
        ->paginate($s_paging)
        ->withQueryString();

        $categories = Master::withoutGlobalScope('user_query_scope')
        ->select(['id', 'name', 'type'])
        ->where('created_by', $setting->created_by)
        ->where('type', 'Staf')
        ->where('status', 1)
        ->get();

        if(isset($s_title) || $s_paging > 10 || isset($request['page']) || isset($s_category)) {
            return response()->json($datas);
        } else {
            return view('landing_page.staff.lp_staff', [
                'datas' => $datas,
                'settings' => $setting,
                'categories' => $categories,
            ]);
        }

    }


    // public function detail($slug, $id)
    // {
    //     try {
    //         $staff = Staf::with('category')->findOrFail($id);
            
    //         return view('landing_page.staff.lp_staff', [
    //             'staff' => $staff,
    //             'title' => 'Deskripsi Staf',
    //         ]);
    //     } catch (\Throwable $e) {
    //         abort(404);
    //     }
    // }
}
