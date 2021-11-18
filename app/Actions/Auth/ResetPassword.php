<?php

namespace App\Actions\Auth;

use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Lorisleiva\Actions\Concerns\AsController;

class ResetPassword
{
    use AsController;

    public function handle(ResetPasswordRequest $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();
        $userReset = $user->userResetPassword;
        abort_if(
            !$userReset ||
            $userReset->expire_at < now() ||
            $userReset->used_at ||
            $userReset->code != $request->code,
            400,
            'cannot reset, please ask for new code');
        $password = \Hash::make($request->input('new_password'));
        $userReset->used_at = now();
        $userReset->save();
        $user->password = $password;
        $user->save();
        return response()->json([
            'message' => 'password reset please login',
        ]);
    }
}
