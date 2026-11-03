<?php

namespace App\Http\Controllers\Web;

use App\Models\Menu;
use App\Models\User;
use App\Models\Access;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserMenuController extends Controller
{
    function index() {
        DB::beginTransaction();
        try {
            $datas = User::all();
            DB::commit();

            return view('super_admin.user_menu.user_menu_index', compact('datas'));
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
        }
    }

    function create() {
        DB::beginTransaction();
        try {
            // $datas['access'] = Access::all();

            return view('super_admin.menu.user_menu_create');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $data = User::find($id);
            $setting = Setting::where('created_by', $id)->first();
            $result['user'] = $data->delete();
            $result['setting'] = $setting->delete();
    
            DB::commit();

            $response = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'message' => 'Data berhasil dihapus.',
                'data' => '',
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            DB::rollback();
            
            $response = [
                'icon' => 'error',
                'title' => 'Gagal!',
                // 'message' => 'Data gagal dihapus.',
                'message' => $th->getMessage(),
                'data' => '',
            ];

            return response()->json($response);
        }
    }

    function menu($id) {
        DB::beginTransaction();
        try {
            $datas = Menu::with([
                'users' => function ($query) use ($id) {
                    $query->where('id', $id);
                }
            ])
            ->where('status', true)
            ->get();
            $user = User::find($id);

            DB::commit();

            return view('super_admin.user_menu.user_menu_menu', compact('datas', 'user', 'id'));
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
        }
    }

    function menu_store($id, Request $request) {
        DB::beginTransaction();
        try {
            $ids = collect($request->input('ids'));
            if(!$ids) {
                $ids = [];
            }
            $user = User::find($id);
            $result = $user->menus()->sync($ids);
            DB::commit();

            $response = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'message' => 'Berhasil memperbarui data.',
                'data' => '',
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

    function access($id) {
        DB::beginTransaction();
        try {
            $datas = Access::with([
                'users' => function ($query) use ($id) {
                    $query->where('id', $id);
                }
            ])
            ->get();

            $user = User::find($id);

            DB::commit();

            return view('super_admin.user_menu.user_menu_access', compact('datas', 'user', 'id'));
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
        }
    }

    function access_store($id, Request $request) {
        DB::beginTransaction();
        try {
            $ids = collect($request->input('ids'));
            if(!$ids) {
                $ids = [];
            }
            $user = User::find($id);
            $result = $user->accesses()->sync($ids);
            DB::commit();

            $response = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'message' => 'Berhasil memperbarui data.',
                'data' => '',
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            DB::rollback();

            $response = [
                'icon' => 'error',
                'title' => 'Gagal!',
                // 'message' => 'Data gagal diperbarui',
                'message' => $th->getMessage(),
                'data' => '',
            ];

            return response()->json($response);
        }
    }
}
