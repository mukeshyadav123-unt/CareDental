<?php

namespace App\Http\Controllers;

use App\Http\Requests\VerifyLoginCodeRequest;
use App\Mail\LoginCodeMail;
use Mail;

class VerifyLoginCodeController extends Controller
{
    public function verify(VerifyLoginCodeRequest $request)
    {
        $user = auth()->user();
        abort_if($user->email_verified_at, 400, 'email already verified');
        abort_if($request->input('code') != $user->login_code, 400, 'invalid login code');
        $user->email_verified_at = now();
        $user->save();
        return response()->json(['message' => 'email verified']);
    }

    public function resend()
    {
        $user = auth()->user();
        abort_if($user->email_verified_at, 400, 'email already verified');
        Mail::to([$user])->send(new LoginCodeMail([
            'code' => $user->login_code,
        ]));
        return response()->json(['message' => 'code sent']);
    }
}
