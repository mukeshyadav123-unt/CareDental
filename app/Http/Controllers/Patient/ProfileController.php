<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePatientProfileRequest;
use App\Http\Resources\PatientResource;
use App\Models\Patient;

class ProfileController extends Controller
{
    public function getProfile()
    {
        $patient = Patient::query()
            ->where('id', auth()->id())
            ->with(['contactInformation', 'details'])
            ->first();
        return new PatientResource($patient);
    }

    public function update(UpdatePatientProfileRequest $request)
    {
        $patient = Patient::find(auth()->id());
        $validated = $request->validated();
        $details = $patient->details()->firstOrCreate();
        if (isset($validated['user'])) {
            $patient->update($validated['user']);
        }
        if (isset($validated['details'])) {
            $details->update($validated['details']);
        }
        $contact = $patient->contactInformation()->firstOrCreate();
        if (isset($validated['contact_information'])) {
            $contact->update($validated['contact_information']);
        }
        return $this->getProfile();
    }
}
