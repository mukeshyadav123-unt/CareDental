<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateDetailsRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function request;

class ProfileController extends Controller
{
    public function showMe()
    {
        $user = auth()->user();
        if ($user->type == 'doctor') {
            $user = Doctor::find($user->id);
            $user->load('details');
        }
        return response()->json($user);
    }

    public function destroy()
    {
        abort_if(!Hash::check(request()->password, Auth::user()->password), 401, "invalid password");
        $authed_user = Auth::user();
        // delete all access tokens
        $authed_user->tokens()->delete();
        $authed_user->delete();

        return response()->json([]);
    }

    public function update(UpdateProfileRequest $request)
    {
        $validated = $request->validated();
        $authed_user = Auth::user();
        $validated['birthday'] = Carbon::parse($validated['birthday']);

        if (!Hash::check($request->current_password, $authed_user->password)) {
            return response('current password is wrong', 401);
        }
        if (isset($validated['new_password'])) {
            $validated['password'] = Hash::make($validated['new_password']);
        }

        try {
            $authed_user->update($validated);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }
        return [
            'user' => $authed_user,
        ];
    }

    public function updateDetails(UpdateDetailsRequest $request)
    {
        $doctor = Doctor::find(auth()->id());
        $doctor->details()->updateOrCreate([], array_filter($request->validated()));
        $doctor->load('details');
        return new DoctorResource($doctor);
    }
}
