<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Models\Access;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class AccessController extends Controller
{
    function index() {
        DB::beginTransaction();
        try {
            $datas = Access::all();
            
            DB::commit();
            return view('super_admin.access.access_index', compact('datas'));
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
        }
    }

    function sync() {
        try {
            DB::beginTransaction();

            $routes = Route::getRoutes();
            $new_routes = [];
    
            foreach ($routes as $route) {
                if($route->getName() != null) {
                    $new_routes[] = [
                        'name' => $route->getName(),
                    ];
                }
            }

            $new_routes = array_column($new_routes, 'name');
            
            $existing_routes = Access::pluck('name')->toArray();
            $routes_to_add = array_diff($new_routes, $existing_routes);
        
            foreach ($routes_to_add as $route) {
                Access::create([
                    'id' => Str::uuid(),
                    'name' => $route
                ]);
            }

            $routes_to_delete = array_diff($existing_routes, $new_routes);

            Access::whereIn('name', $routes_to_delete)->delete();

            DB::commit();

            $datas = Access::all();

            $response = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'message' => 'Berhasil memperbarui data.',
                'data' => $datas,
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            DB::rollback();

            $response = [
                'icon' => 'error',
                'title' => 'Gagal!',
                // 'message' => 'Data gagal dihapus',
                'message' => $th->getMessage(),
                'data' => '',
            ];

            return response()->json($response);
        }
    }
}
