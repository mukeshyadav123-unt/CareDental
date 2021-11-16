<?php

use App\Actions\Doctor\DoctorIndex;
use App\Actions\Doctor\ShowDoctor;
use App\Actions\AdminLogin;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Doctor\ReportsController;
use App\Http\Controllers\Doctor\VisitController as DoctorVisitController;
use App\Http\Controllers\DoctorAuthController;
use App\Http\Controllers\DoctorTimesController;
use App\Http\Controllers\Patient\ChatController as PatientChatController;
use App\Http\Controllers\Patient\VisitController;
use App\Http\Controllers\PatientAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VerifyLoginCodeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'patient'], function () {
    Route::post('login', [PatientAuthController::class, 'login']);
    Route::post('signup', [PatientAuthController::class, 'signup']);
});

Route::group(['prefix' => 'staff'], function () {
    Route::post('login', AdminLogin::class);
});

Route::group(['prefix' => 'doctor'], function () {
    Route::post('login', [DoctorAuthController::class, 'login']);
    Route::post('signup', [DoctorAuthController::class, 'signup']);
});

Route::middleware('auth:sanctum')->post('verify-email', [VerifyLoginCodeController::class, 'verify']);
Route::middleware('auth:sanctum')->get('verify-email/resend', [VerifyLoginCodeController::class, 'resend']);
Route::middleware(['auth:sanctum', 'email-verified'])->group(function () {
    Route::get("me", [ProfileController::class, 'showMe']);
    Route::post("me/delete", [ProfileController::class, 'destroy']);
    Route::put("me", [ProfileController::class, 'update']);
    Route::group(['prefix' => 'doctor'], function () {
        Route::get('', DoctorIndex::class);
        Route::post('details', [ProfileController::class, 'updateDetails']);
        Route::get('{doctor}', ShowDoctor::class);
    });

    Route::group(['middleware' => 'is_doctor'], function () {
        Route::group(['prefix' => 'doctor-routes'], function () {
            Route::resource('times', DoctorTimesController::class);
            Route::group(['prefix' => 'reports'], function () {
                Route::get('{patient}', [ReportsController::class, 'showReports']);
                Route::post('', [ReportsController::class, 'storeReport']);
            });
            Route::group(['prefix' => 'visit'], function () {
                Route::get('', [DoctorVisitController::class, 'index']);
                Route::put('{visit}/done', [DoctorVisitController::class, 'markDone']);
                Route::put('{visit}/not-done', [DoctorVisitController::class, 'markNotDone']);
                Route::get('{visit}', [DoctorVisitController::class, 'show']);
            });
        });
    });

    Route::group(['middleware' => 'is_patient'], function () {
        Route::group(['prefix' => 'patient'], function () {
            Route::group(['prefix' => 'profile'], function () {
                Route::get('', [\App\Http\Controllers\Patient\ProfileController::class, 'getProfile']);
                Route::post('', [\App\Http\Controllers\Patient\ProfileController::class, 'update']);
            });
            Route::group(['prefix' => 'reports'], function () {
                Route::get('', [\App\Http\Controllers\Patient\ReportsController::class, 'index']);
            });
            Route::group(['prefix' => 'visit'], function () {
                Route::get('', [VisitController::class, 'index']);
                Route::post('', [VisitController::class, 'store']);
                Route::get('{visit}', [VisitController::class, 'show']);
                Route::post('{visit}/review', [VisitController::class, 'addReview']);
                Route::put('{visit}/cancel', [VisitController::class, 'cancel']);
            });
        });
    });

    Route::group(['prefix' => 'chat'], function () {
        ray()->showQueries();
        Route::get('', [ChatController::class, 'index']);
        Route::post('', [ChatController::class, 'sendMessage']);
        Route::get('contact-list', [ChatController::class, 'contactsList']);
        Route::get('unread-count', [ChatController::class, 'unreadMessagesCount']);
        Route::get('{chat}', [ChatController::class, 'show']);
    });
});
