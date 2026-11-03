<?php

namespace App\Http\Controllers\Web\LP;

use App\Models\Setting;
use App\Models\Download;
use App\Models\Master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class LPDownloadController extends Controller
{
    public function landing_download($slug)
    {
        // Validasi 1: Pastikan slug tidak mengandung spasi di depan atau di belakangnya
        if (trim($slug) !== $slug) {
            abort(404);
        }

        // Validasi 2: Pastikan slug yang diberikan sesuai dengan data dalam database
        $settings = Setting::withoutGlobalScope('user_query_scope')
            ->where('slug', $slug)
            ->first();

        // Jika tidak ada data settings yang sesuai, atau slug tidak sesuai, abort 404
        if (!$settings) {
            abort(404);
        }

        $categories = Master::withoutGlobalScope('user_query_scope')
            ->select(['id', 'name', 'type'])
            ->where('created_by', $settings->created_by)
            ->where('type', 'Unduh')
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        if (request()->ajax()) {
            $landing_downloads_query = Download::withoutGlobalScope('user_query_scope')
                ->where('status', 1)
                ->where('created_by', $settings->created_by)
                ->whereHas('CategoryDownloads', function ($query) use ($categories) {
                    // Tambahkan withoutGlobalScope di dalam closure ini
                    $query->withoutGlobalScope('user_query_scope')
                        ->whereIn('category_download_id', $categories->pluck('id'));
                })
                ->orderBy('created_at', 'desc');

            $s_category = request()->get('s_category', 'Semua');
            if ($s_category !== 'Semua') {
                $landing_downloads_query->where('category_download_id', $s_category);
            }

            $searchValue = request()->get('search', '');
            if (!empty($searchValue)) {
                $landing_downloads_query->where(function ($query) use ($searchValue) {
                    $query->where('title', 'like', "%{$searchValue}%")
                        ->orWhere('desc', 'like', "%{$searchValue}%")
                        ->orWhere('file', 'like', "%{$searchValue}%");
                });
            }

            $landing_downloads = $landing_downloads_query->get();

            return datatables()->of($landing_downloads)
                ->addColumn('no', function ($row) {
                    static $no = 1;
                    return '<div class="number_columns text-center">' . $no++ . '</div>';
                })
                ->addColumn('aksi', function ($row) use ($settings) {
                    $btn = '
                    <div class="text-center" style="width:130px;">
                        <form method="post" action="' . route('lp.download.click', ['slug' => $settings->slug, 'id' => $row->id]) . '">
                            ' . csrf_field() . '
                            <input type="hidden" name="id" value="' . $row->id . '">
                            <button type="submit" class="btn btn-primary btn-sm" style="border-radius:9px;" name="click_download">Unduh</button>
                        </form>
                    </div>
                    ';
                    return $btn;
                })
                ->rawColumns(['no', 'aksi'])
                ->make(true);
        }

        $s_category = request()->get('s_category', 'Semua');
        $length = request()->get('length', 10);

        return view('landing_page.download.lp_download', compact('categories', 's_category', 'settings', 'length'));
    }

    public function tekan_unduh(Request $request, $slug)
    {
        $id = $request->input('id');
        $download = DB::table('downloads')->where('id', $id)->first();

        if (!$download) {
            abort(404);
        }

        // Validasi 1: Pastikan slug tidak mengandung spasi di depan atau di belakangnya
        if (trim($slug) !== $slug) {
            abort(404);
        }

        // Validasi 2: Pastikan slug yang diberikan sesuai dengan data dalam database
        $settings = Setting::withoutGlobalScope('user_query_scope')
            ->where('slug', $slug)
            ->first();

        // Jika tidak ada data settings yang sesuai, atau slug tidak sesuai, abort 404
        if (!$settings) {
            abort(404);
        }

        $nilai_sekarang = $download->click_download;
        $nilai_baru = $nilai_sekarang + 1;

        // Perbarui nilai unduhan di database
        DB::table('downloads')->where('id', $id)->update(['click_download' => $nilai_baru]);

         // Dapatkan userId dari created_by pada setting
        $userId = $settings->created_by;

        // URL file yang benar untuk diunduh
        $file_url = 'storage/download/original/'. $userId . '/' . $download->file;

        // Periksa apakah file ada
        if (!Storage::disk('public')->exists($file_url)) {
            abort(404);
        }

        // Redirect ke file yang benar untuk diunduh
        return response()->download($file_url);
    }

    public function getCategories($slug)
    {
        // Validasi 1: Pastikan slug tidak mengandung spasi di depan atau di belakangnya
        if (trim($slug) !== $slug) {
            abort(404);
        }

        // Validasi 2: Pastikan slug yang diberikan sesuai dengan data dalam database
        $settings = Setting::withoutGlobalScope('user_query_scope')
            ->where('slug', $slug)
            ->first();

        // Jika tidak ada data settings yang sesuai, atau slug tidak sesuai, abort 404
        if (!$settings) {
            abort(404);
        }

        $categories = Master::withoutGlobalScope('user_query_scope')
        ->select(['id', 'name', 'type'])
        ->where('created_by', $settings->created_by)
        ->where('type', 'Unduh')
        ->where('status', 1)
        ->orderBy('created_at', 'desc')
        ->get();

        return response()->json($categories);
    }
}
