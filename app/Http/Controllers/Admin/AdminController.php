<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\PatientResource;
use App\Http\Resources\ReportResource;
use App\Http\Resources\VisitResource;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Report;
use App\Models\Visit;
use PhpParser\Comment\Doc;

class AdminController extends Controller
{
    public function doctors()
    {
        $doctors = Doctor::with(['visits', 'patients', 'reports'])
            ->with('details')
            ->withAvg('reviews', 'rate')
            ->paginate();
        return DoctorResource::collection($doctors);
    }

    public function patients()
    {
        $patients = Patient::query()
            ->with(['visits', 'doctors.details', 'reports'])
            ->paginate();
        return PatientResource::collection($patients);
    }

    public function reports()
    {
        $reports = Report::with(['patient', 'doctor'])->paginate();
        return ReportResource::collection($reports);
    }

    public function visits()
    {
        $visits = Visit::with(['patient', 'doctor'])->paginate();
        return VisitResource::collection($visits);
    }
}
