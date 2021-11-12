<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorLoginRequest;
use App\Http\Requests\DoctorSignupRequest;
use App\Mail\LoginCodeMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Mail;

class DoctorAuthController extends Controller
{
    public function login(DoctorLoginRequest $request)
    {
        $user = User::where('email', $request->email)
            ->where('type', 'doctor')
            ->first();

        abort_if(!$user, 400, 'wrong email or password');
        abort_if(Hash::check($user->password, $request->password), 400, 'wrong email or password');
        $token = $user->createToken($user->email, ['doctor'])->plainTextToken;
        return response()->json([
            'message' => 'success',
            'token' => $token,
        ]);
    }

    public function signup(DoctorSignupRequest $request)
    {
        $validated = $request->validated();
        $validated['birthday'] = Carbon::parse($validated['birthday']);

        abort_if($validated['birthday']->diffInYears(now()) < 21, 400
            , 'you have be older than 21 to register for doctor account');
        abort_if(User::where('phone_number', $validated['phone_number'])->first() != null,
            400, 'phone already in use');

        $validated = array_merge($validated, ['type' => 'doctor']);
        $validated['password'] = Hash::make($validated['password']);

        $code = rand(1000, 9999);
        $validated['login_code'] = $code;
        $user = User::create($validated);
        Mail::to([$user])->send(new LoginCodeMail([
            'code' => $code,
        ]));
        return response()->json([
            'message' => 'user register successfully',
        ]);
    }
}
