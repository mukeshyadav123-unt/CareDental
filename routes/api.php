<?php

use App\Http\Controllers\DoctorAuthController;
use App\Http\Controllers\PatientAuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get("me", [ProfileController::class, 'showMe']);
    Route::post("me/delete", [ProfileController::class, 'destroy']);
    Route::put("me", [ProfileController::class, 'update']);



});

Route::group(['prefix' => 'patient'] , function (){
   Route::post('login' , [PatientAuthController::class  , 'login']);
   Route::post('signup' , [PatientAuthController::class  , 'signup']);
});

Route::group(['prefix' => 'doctor'] , function (){
   Route::post('login' , [DoctorAuthController::class  , 'login']);
   Route::post('signup' , [DoctorAuthController::class  , 'signup']);
});
