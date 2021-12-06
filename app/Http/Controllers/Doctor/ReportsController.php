<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReportRequest;
use App\Http\Resources\ReportResource;
use App\Models\Patient;
use Storage;
use Str;

class ReportsController extends Controller
{
    public function showReports(Patient $patient)
    {
        abort_if(!$patient->visits()->where('doctor_id', auth()->id())->exists(), 404, "can't show reports for this patient");
        return ReportResource::collection($patient->reports);
    }

    public function storeReport(StoreReportRequest $request)
    {
        $patient = Patient::findOrFail($request->input('patient_id'));
        abort_if(!$patient->visits()->where('doctor_id', auth()->id())->exists(), 404, "can't show reports for this patient");
        $filename = 'doctor/' . Str::uuid() . '.pdf';
        Storage::disk('s3')->put($filename, $request->file('report')->getContent());
        $url = Storage::cloud()->url($filename);
        $report = $patient->reports()->create([
            'doctor_id' => auth()->id(),
            'link' => $url,
	    'note' => $request->note,
            'visit_id' => $request->visit_id,
        ]);
        return new ReportResource($report);
    }
}
