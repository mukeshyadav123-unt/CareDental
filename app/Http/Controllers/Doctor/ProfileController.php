<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateDoctorProfileRequest;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use App\Models\Patient;
use PhpParser\Comment\Doc;

class ProfileController extends Controller
{
    public function getProfile()
    {
        $doctor = Doctor::query()
            ->where('id', auth()->id())
            ->with(['details'])
            ->first();
        return new DoctorResource($doctor);
    }

    public function update(UpdateDoctorProfileRequest $request)
    {
        $doctor = Doctor::find(auth()->id());
        $validated = $request->validated();
        $details = $doctor->details()->firstOrCreate();
        if (isset($validated['user'])) {
            $doctor->update($validated['user']);
        }
        if (isset($validated['details'])) {
            $details->update($validated['details']);
        }
        return $this->getProfile();
    }
}
