<?php

namespace App\Http\Controllers;

use App\Models\Access;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class UtilsController extends Controller
{
    function access_generate() {
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
            
            // dd($new_routes);
            $existing_routes = Access::pluck('name')->toArray();
            // dd($existing_routes);
            $routes_to_add = array_diff($new_routes, $existing_routes);
            // dd($routes_to_add);
        
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

            return response()->json([
                'status' => 200,
                'icon' => 'success',
                'title' => 'Berhasil',
                'message' => 'Berhasil memperbarui data',
                'data' => $datas,
            ], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
        }
    }
}
