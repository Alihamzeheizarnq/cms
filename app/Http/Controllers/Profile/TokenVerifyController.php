<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\ActiveCode;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class TokenVerifyController extends Controller
{
    public function verify_tow_refactor(Request $request)
    {
        $request->session()->reflash();
        if (!$request->session()->has('auth.sms')) {
            return redirect('/login');
        }

        return view('profile.tow-factor-verify-to-login');
    }

    public function post_verify_tow_refactor(Request $request)
    {
        if (!$request->session()->has('auth.sms')) {
            return redirect('/login');
        }
        $request->validate([
            'token' => 'required'
        ]);

        $status = ActiveCode::validationCode($request->input('token'), User::find($request->session()->get('auth.user_id')));

        if (!$status) {
            alert()->error('کد وارد شده معتبر نیست لطفا دوباره تلاش کنید ' , 'خطای عدم دسترسی');
            return redirect('/login');

        }
        if ($status) {
            auth()->loginUsingId($request->session()->get('auth.user_id'), $request->session()->get('auth.remember'));
            alert()->success('احراز هویت شما با موفقیت انجام شد' , 'موفق');
            return redirect(RouteServiceProvider::HOME);
        }

    }
}
