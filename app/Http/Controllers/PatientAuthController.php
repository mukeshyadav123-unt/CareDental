<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientLoginRequest;
use App\Http\Requests\PatientSignupRequest;
use App\Mail\LoginCodeMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Mail;

class PatientAuthController extends Controller
{
    public function login(PatientLoginRequest $request)
    {
        $user = User::where('email', $request->email)
            ->where('type', 'patient')
            ->first();

        abort_if(!$user, 400, 'wrong email or password');
        abort_if(!Hash::check($request->password, $user->password), 400, 'wrong email or password');

        $token = $user->createToken($user->email, ['patient'])->plainTextToken;
        return response()->json([
            'message' => 'success',
            'token' => $token,
        ]);
    }

    public function signup(PatientSignupRequest $request)
    {
        $validated = $request->validated();
        $validated = array_merge($validated, ['type' => 'patient']);
        $validated['password'] = Hash::make($validated['password']);
        $validated['birthday'] = Carbon::parse($validated['birthday']);

        abort_if(User::where('phone_number', $validated['phone_number'])->first() != null,
            400, 'phone already in use');

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
