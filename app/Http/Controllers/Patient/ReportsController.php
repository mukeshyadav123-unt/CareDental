<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowMyReportsRequest;
use App\Http\Resources\ReportResource;
use App\Models\Patient;

class ReportsController extends Controller
{
    public function index(ShowMyReportsRequest $request)
    {
        $patient = Patient::find(auth()->id());
        return ReportResource::collection(
            $patient->reports()
                ->when($request->doctor_id, fn ($q) => $q->where('doctor_id', $request->doctor_id))
                ->with('doctor')
                ->get()
        );
    }
}
