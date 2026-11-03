<?php

namespace App\Http\Controllers\Web;

use App\Models\Menu;
use App\Models\User;
use App\Models\Access;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\MenuRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    function index() {
        DB::beginTransaction();
        try {
            $datas = Menu::with('access')
            ->orderBy('sequence', 'asc')
            ->get();

            return view('super_admin.menu.menu', compact('datas'));
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
        }
    }

    function create() {
        DB::beginTransaction();
        try {
            $datas['access'] = Access::all();
            $datas['menu'] = Menu::orderBy('sequence', 'asc')->get('sequence');

            return view('super_admin.menu.menu_create', compact('datas'));
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
        }
    }

    function store(Request $request) {
        DB::beginTransaction();
        try {
            $rules = (new MenuRequest)->rules();
            $validator = Validator::make($request->all(), $rules);
            
            $menus_for_update = Menu::where('sequence', '>=', $request['sequence'])->get();
            foreach ($menus_for_update as $menu) {
                $menu->update([
                    'sequence' => $menu->sequence + 1,
                ]);
            }

            $request->merge([
                'id' => Str::uuid(),
                'sequence' => $request['sequence'],
            ]);
            
            $datas = Menu::create($request->all());
            DB::commit();

            $response = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'message' => 'Data berhasil ditambahkan.',
                'data' => $datas,
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            DB::rollback();
            
            $response = [
                'icon' => 'error',
                'title' => 'Gagal!',
                'message' => $th->getMessage(),
                'data' => $request->all(),
            ];

            return response()->json($response);
        }
    }

    public function edit( $id)
    {
        DB::beginTransaction();
        try {
            $data = Menu::find($id);
            $access = Access::all();
            $menus = Menu::orderBy('sequence', 'asc')->get('sequence');

            return view('super_admin.menu.menu_edit', compact('data', 'access', 'menus'));
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function update(Request $request,  $id)
    {
        DB::beginTransaction();
        try {
            $rules = (new MenuRequest)->rules($id);
            $validator = Validator::make($request->all(), $rules);

            $find = Menu::find($id);
            $sequnce_before = $find['sequence'];
            $sequnce_after = $request['sequence'];
            
            if($sequnce_after > $sequnce_before) {
                $menus_for_update = Menu::whereBetween('sequence', [$sequnce_before, $sequnce_after])->get();
                foreach ($menus_for_update as $menu) {
                    $menu->update([
                        'sequence' => $menu->sequence - 1,
                    ]);
                }
            } else if($sequnce_after < $sequnce_before) {
                $menus_for_update = Menu::whereBetween('sequence', [$sequnce_after, $sequnce_before])->get();
                foreach ($menus_for_update as $menu) {
                    $menu->update([
                        'sequence' => $menu->sequence + 1,
                    ]);
                }
            }
            
            $result = $find->update($request->all());
            
            DB::commit();

            $response = [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'message' => 'Data berhasil diubah.',
                // 'message' => $menus_for_update[0]->name,
                'data' => $find,
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            DB::rollback();

            $response = [
                'icon' => 'error',
                'title' => 'Gagal!',
                'message' => $th->getMessage(),
                'data' => $find,
            ];

            return response()->json($response);
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $data = Menu::find($id);

            $menus_for_update = Menu::where('sequence', '>', $data['sequence'])->get();
            foreach ($menus_for_update as $menu) {
                $menu->update([
                    'sequence' => $menu->sequence - 1,
                ]);
            }

            $result = $data->delete();
    
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
                'message' => 'Data gagal dihapus',
                'data' => '',
            ];

            return response()->json($response);
        }
    }

}
