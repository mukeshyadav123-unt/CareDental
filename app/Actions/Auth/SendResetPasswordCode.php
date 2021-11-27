<?php

namespace App\Actions\Auth;

use App\Mail\SendResetCodeMail;
use App\Models\User;
use Lorisleiva\Actions\Concerns\AsController;
use Mail;

class SendResetPasswordCode
{
    use AsController;

    public function handle()
    {
        request()->validate(['email' => 'required|email']);

        $user = User::query()
            ->where('email', request('email'))
            ->firstOrFail();
        $userReset = $user->userResetPassword()->where('user_id', $user->id)->firstOrCreate([], [
            'code' => $this->generateRandomString(),
        ]);
        $this->validate($userReset);

        $userReset->update([
            'code' => $this->generateRandomString(),
            'expire_at' => now()->addMinutes(10),
        ]);
        Mail::to([$user])
            ->send(new SendResetCodeMail([
                'code' => $userReset->code,
            ]));

        return response()->json([
            'message' => 'code sent',
        ]);
    }

    private function generateRandomString($length = 5): string
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * @param $userReset
     */
    private function validate($userReset): void
    {
        abort_if(
            $userReset && $userReset->used_at && $userReset->used_at->diffInMinutes(now()) < 10,
            400,
            'you reset your password less than 10 minutes ago, please wait'
        );
    }
}
