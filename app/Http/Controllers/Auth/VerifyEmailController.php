<?php

namespace App\Http\Controllers\Auth;

use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        DB::beginTransaction();
        try {
            if ($request->user()->hasVerifiedEmail()) {
                return redirect()->intended(RouteServiceProvider::HOME.'?verified=1')->with('login_success', 'Selamat Anda berhasil login');
            }
            
            if ($request->user()->markEmailAsVerified()) {
                $user_id = auth()->user()->id;
                $setting = Setting::where('created_by', $user_id)->first()->update(['status' => 1]);
                $section = section_generate($user_id);

                event(new Verified($request->user()));
            }

            DB::commit();
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1')->with('login_success', 'Selamat Anda berhasil login');
        } catch (\Throwable $e) {
            DB::rollback();
            dd($e);
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1')->with('login_error', $e->getMessage());
        }
    }
}
