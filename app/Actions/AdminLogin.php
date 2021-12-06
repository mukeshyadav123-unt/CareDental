<?php

namespace App\Actions;

use Illuminate\Support\Facades\Hash;
use Lorisleiva\Actions\Action;
use Lorisleiva\Actions\Concerns\AsController;
use App\Models\Admin;

class AdminLogin
{
    use AsController;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['email', 'required'],
            'password' => ['required'],
        ];
    }

    public function handle()
    {
        $admin = Admin::query()->where('email', request()->email)->firstOrFail();
        abort_if(!Hash::check(request()->password, $admin->password), 400, 'wrong email or password');
        $token = $admin->createToken($admin->email, ['doctor'])->plainTextToken;
        return response()->json([
            'message' => 'success',
            'token' => $token,
	    'user_id' =>$admin->id
        ]);
    }
}
