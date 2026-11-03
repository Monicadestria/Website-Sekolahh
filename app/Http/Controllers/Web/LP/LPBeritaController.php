<?php

namespace App\Http\Controllers\Web\LP;

use App\Models\Berita;
use App\Models\Master;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LPBeritaController extends Controller
{
    public function landing($slug, Request $request) {
        $s_paging = $request->input('s_paging', 10);
        $s_category = $request->input('s_category', 'semua');
        $s_title = $request->input('s_title');
    
        $setting = Setting::withoutGlobalScope('user_query_scope')->where('slug', $slug)->first();
        $created_by = $setting->created_by;
        
        $query = Berita::withoutGlobalScope('user_query_scope')
            ->where('created_by', $setting->created_by)
            ->where('status', 1);
    
        if ($s_category !== 'semua') {
            $query->whereHas('CategoryBerita', function ($q) use ($s_category) {
                $q->withoutGlobalScope('user_query_scope')->where('id', $s_category);
            });
        }
    
        if ($s_title) {
            $query->where('title', 'like', '%' . $s_title . '%');
        }
    
        $datas = $query->orderBy('created_at', 'desc')
            ->paginate($s_paging);
    
        $categories = Master::withoutGlobalScope('user_query_scope')
            ->select(['id', 'name', 'type'])
            ->where('created_by', $created_by)
            ->where('type', 'Berita')
            ->where('status', 1)
            ->get();
    
        $mainBerita = $datas->take(2);
        $otherBerita = $datas->slice(2);
    
        if (!($setting->status)) {
            return redirect()->route('landing_page')->with('warning', 'Website sekolah dinonaktifkan.');
        }
    
        if ($request->expectsJson()) {
            return response()->json($datas);
        } else {
            return view('landing_page.berita.landing_berita', [
                'mainBerita' => $mainBerita,
                'otherBerita' => $otherBerita,
                'datas' => $datas,
                'title' => 'Berita',
                'settings' => $setting,
                'categories' => $categories,
                'slug' => $slug,
                's_category' => $s_category,
            ]);
        }
    }    

    public function detail($slug, $id) {
        try {
            $berita = Berita::withoutGlobalScope('user_query_scope')
                            ->with('CategoryBerita')
                            ->where('status', 1)
                            ->findOrFail($id);
            $viewedBerita = Session::get('viewed_berita', []);
            
            // Periksa apakah berita sudah dilihat oleh pengguna di sesi ini
            if (!in_array($id, $viewedBerita)) {
                $berita->increment('view_count');
    
                // Tambahkan berita ke sesi tersebut
                Session::push('viewed_berita', $id);
            }
            
            return view('landing_page.berita.landing_detail', [
                'berita' => $berita,
                'title' => $berita->title,
                'slug' => $slug,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404);
        }
    }

    // public function search(Request $request, $slug) {
    //     $keyword = $request->input('keyword');
    //     if ($keyword) {
    //         $berita = Berita::withoutGlobalScope('user_query_scope')
    //                         ->where('status', 1)
    //                         ->where('title', 'LIKE', "%{$keyword}%")
    //                         ->get();
    //     } else {
    //         $berita = Berita::withoutGlobalScope('user_query_scope')->where('status', 1)->get(); // Dapatkan semua berita ketika tidak ada kata kunci
    //     }
    
    //     if ($request->ajax()) {
    //         if ($berita->isEmpty()) {
    //             return response()->json(['error' => 'No news found'], 200); // Tetap mengembalikan status 200
    //         }
    //         return response()->json([
    //             'berita' => $berita->map(function($brt) use ($slug) {
    //                 return [
    //                     'title' => $brt->title,
    //                     'photo' => asset('storage/berita/' . $brt->photo),
    //                     'body' => $brt->body,
    //                     'timeAgo' => timeAgo($brt->created_at),
    //                     'url' => route('lp.berita.show', ['slug' => $slug, 'id' => $brt->id])
    //                 ];
    //             })
    //         ]);
    //     }
    
    //     return view('landing_page.berita.landing_berita', compact('berita', 'slug'));
    // }    
}
