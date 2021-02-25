<?php

namespace App\Http\Controllers\Auth;


use App\Channels\SmsChannel;
use App\Models\ActiveCode;
use App\Models\User;
use App\Notifications\SendSms;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

trait AuthTokenStatus
{
    public function CheckClassTokenStatus($request)
    {
        /** @var Request $request */
        /** @var User $user */
        $user = User::findOrfail($request->user()->id);
        if ($user->type_factor != 'off') {
            auth()->logout();
            $request->session()->flash('auth', [
                'user_id' => $user->id,
                'remember' => !!$request->remember,
                'sms' => false
            ]);

            if ($user->type_factor == 'sms') {

                $request->session()->put('auth.sms', true);

                $code = ActiveCode::generateUniqueCode($user);
                $user->notify(new SendSms($code, $user->phone_number));
                return redirect(route('verify-tow-refactor'));
            }


        } else {
            return redirect(RouteServiceProvider::HOME);
        }


    }
}
