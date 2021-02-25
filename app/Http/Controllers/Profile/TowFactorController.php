<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\ActiveCode;
use App\Notifications\SendSms;
use Illuminate\Http\Request;

class TowFactorController extends Controller
{
    public function index()
    {
        return view('profile.tow-factor-view');
    }

    public function store(Request $request)
    {
        // +989221534539
        $request->validate([
            'type' => 'required|in:off,sms',
            'phone' => 'required_unless:type,off',
        ]);

        if ($this->UpdateFactorTypeToOff($request)) return back();

        return $this->VerifyPhoneAndUpdateTypeFactorType($request);


    }

    public function get_verify_phone(Request $request)
    {

        $request->session()->reflash();

        if (!$request->session()->has('phone')) {
            return redirect(route('tow-factor'));
        }
        return view('profile.verify-phone');
    }

    public function post_verify_phone(Request $request)
    {
        if (!$request->session()->has('phone')) {
            return redirect(route('tow-factor'));
        }
        $request->validate([
            'token' => 'required|int'
        ]);

        $status = ActiveCode::validationCode($request->input('token'), $request->user());

        if (!$status) {
            alert()->error('احراز هویت شما با مشکل مواجه شد لظفا دوباره امتحان کنید', 'خطای عدم دسترسی');
            return redirect(route('tow-factor'));
        }

        if ($status) {
            $request->user()->activeCode()->delete();
            $request->user()->update([
                'type_factor' => 'sms',
                'phone_number' => $request->session()->get('phone')
            ]);
            alert()->success('شماره تلفن شما با موفقیت اعتبار سنجی شد', 'موفق');
            return redirect(route('tow-factor'));
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UpdateFactorTypeToOff(Request $request)
    {
        if ($request->input('type') == 'off') {
            $request->user()->update(['type_factor' => 'off']);
            alert()->success('احراز هویت شما غیر فعال شد ', 'موفق');
            return back();
        }


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function VerifyPhoneAndUpdateTypeFactorType(Request $request)
    {
        if ($request->input('type') == 'sms') {
            if ($request->input('phone') != $request->user()->phone_number) {
                $code = ActiveCode::generateUniqueCode($request->user());
                $request->user()->notify(new SendSms($code, $request->input('phone')));
                $request->session()->flash('phone', $request->input('phone'));
                return redirect(route('verify-token'));
            } else {
                $request->user()->update(['type_factor' => 'sms']);
                alert()->success('احراز هویت شما فعال شد ', 'موفق');
                return back();
            }
        }
    }
}
