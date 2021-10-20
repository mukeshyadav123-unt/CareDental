<?php

use App\Actions\Doctor\DoctorIndex;
use App\Actions\Doctor\ShowDoctor;
use App\Http\Controllers\DoctorAuthController;
use App\Http\Controllers\DoctorTimesController;
use App\Http\Controllers\PatientAuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'patient'] , function (){
   Route::post('login' , [PatientAuthController::class  , 'login']);
   Route::post('signup' , [PatientAuthController::class  , 'signup']);
});

Route::group(['prefix' => 'doctor'] , function (){
   Route::post('login' , [DoctorAuthController::class  , 'login']);
   Route::post('signup' , [DoctorAuthController::class  , 'signup']);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get("me", [ProfileController::class, 'showMe']);
    Route::post("me/delete", [ProfileController::class, 'destroy']);
    Route::put("me", [ProfileController::class, 'update']);
    Route::group(['prefix' => 'doctor'] , function (){
        Route::resource('times', DoctorTimesController::class);
        Route::get('', DoctorIndex::class);
        Route::post('details', [ProfileController::class, 'updateDetails']);
        Route::get('{doctor}', ShowDoctor::class);
    });
});
