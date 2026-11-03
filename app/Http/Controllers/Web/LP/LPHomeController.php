<?php

namespace App\Http\Controllers\Web\LP;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Setting;

class LPHomeController extends Controller
{
    public function index($slug)
    {
        $setting = Setting::withoutGlobalScope('user_query_scope')->where('slug', $slug)->first();
        if (!$setting || $setting->slug !== $slug || trim($slug) !== $slug) {
            abort(404);
        }
        if (!($setting->status)) {
            return redirect()->route('landing_page')->with('warning', 'Website sekolah dinonaktifkan.');
        }

        $section = Section::withoutGlobalScope('section_query_scope')->where('active', true)->where('created_by', $setting->created_by)->orderBy('urutan')->get();
        $data = [
            'slug' => $slug,
            'sections' => $section,
            'settings' => $setting,
            'title' => 'Beranda',
        ];
        // dd($section);
        return view('landing_page.home.lp_home', $data);
    }
}
