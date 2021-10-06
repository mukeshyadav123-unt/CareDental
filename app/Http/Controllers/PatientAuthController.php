<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientLoginRequest;
use App\Http\Requests\PatientSignupRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PatientAuthController extends Controller
{
    public function login(PatientLoginRequest $request)
    {
        $user = User::where('email', $request->email)
            ->where('password', Hash::make($request->password))->get();
        abort_if(!$user, 400, 'wrong email or password');
        $token = $user->createToken($user->email, ['patient'])->plainTextToken;
        return response()->json([
            'message' => 'success',
            'token' => $token
        ]);
    }

    public function signup(PatientSignupRequest $request)
    {
        $validated = $request->validated();
        $validated = array_merge($validated, ['type' => 'patient']);
        User::create($validated);
        return response()->json([
            'message' => 'user register successfully'
        ]);
    }
}
