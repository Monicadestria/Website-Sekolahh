<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Section;
use App\Models\Setting;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'school_name' => ['required', 'string', 'max:255'],
        ]);
    
        DB::beginTransaction();
        try {
            $user_id = (string) Str::uuid();
    
            $user = User::create([
                'id' => $user_id,
                'role' => 'admin',
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'created_by' => $user_id,
            ]);
    
            Setting::create([
                'id' => Str::uuid(),
                'slug' => Str::slug($request['school_name']),
                'school_name' => $request['school_name'],
                'created_by' => $user_id,
            ]);
    
            access_generate($user->id);
            menu_generate($user->id);
    
            event(new Registered($user));
    
            Auth::login($user);
    
            DB::commit();
            return redirect('/verify-email')->with('register_success', 'Akun Anda Berhasil Dibuat');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
    

}
