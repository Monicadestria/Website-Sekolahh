<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Staf;
use App\Models\Berita;
use App\Models\Galery;
use App\Models\Download;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $datas = [
            [
                'title' => 'Berita',
                'total' => Berita::count(),
                'class' => 'bg-info shadow',
                'route' => 'berita.index',
            ],
            [
                'title' => 'Staf',
                'total' => Staf::count(),
                'class' => 'shadow text-dark',
                'route' => 'staf.index',
            ],
            [
                'title' => 'Galeri',
                'total' => Galery::count(),
                'class' => 'shadow text-dark',
                'route' => 'galery.index',
            ],
            [
                'title' => 'Unduh',
                'total' => Download::count(),
                'class' => 'bg-info shadow',
                'route' => 'download.index',
            ],
        ];

        $result = [
            'Berita' => Berita::orderBy('view_count', 'desc')->take(6)->get(),
            'Staf' => Staf::take(6)->get(),
            'Galeri' => Galery::take(6)->get(),
            'Unduh' => Download::orderBy('click_download', 'desc')->take(6)->get(),
        ];

        $data_diagram[]['labels'] = [];
        $data_diagram[]['datas'] = [];
        $i = 0;
        foreach ($result as $key => $val) {
            foreach ($val as $value) {
                if ($key == 'Berita') {
                    $data_diagram[$key]['labels'][] = $value['title'];
                    $data_diagram[$key]['datas'][] = $value['view_count'];
                } else if($key == 'Unduh') {
                    $data_diagram[$key]['labels'][] = $value['title'];
                    $data_diagram[$key]['datas'][] = $value['click_download'];
                } else if($key == 'Galeri') {
                    $data_diagram[$key]['labels'][] = $value['title'];
                    // $data_diagram['data'][] = $value['views'];
                    $data_diagram[$key]['datas'][] = rand(1, 100);
                } else if($key == 'Staf') {
                    $data_diagram[$key]['labels'][] = $value['name'];
                    $data_diagram[$key]['datas'][] = rand(1, 100);
                }
            }
        }

        return view('dashboard.dashboard_index', compact('datas', 'data_diagram'));
    }
}
