<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorLoginRequest;
use App\Http\Requests\DoctorSignupRequest;
use App\Http\Requests\PatientLoginRequest;
use App\Http\Requests\PatientSignupRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DoctorAuthController extends Controller
{

    public function login(DoctorLoginRequest $request)
    {
        $user = User::where('email', $request->email)
            ->where('password', Hash::make($request->password))
            ->where('type' , 'doctor')
            ->get();

        abort_if(!$user, 400, 'wrong email or password');
        $token = $user->createToken($user->email, ['doctor'])->plainTextToken;
        return response()->json([
            'message' => 'success',
            'token' => $token
        ]);
    }

    public function signup(DoctorSignupRequest $request)
    {
        $validated = $request->validated();
        $validated = array_merge($validated, ['type' => 'doctor']);
        User::create($validated);

        return response()->json([
            'message' => 'user register successfully'
        ]);
    }
}
