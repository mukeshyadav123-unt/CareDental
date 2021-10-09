<?php

use App\Http\Controllers\DoctorAuthController;
use App\Http\Controllers\PatientAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group(['middleware' => 'auth:sanctum'] , function (){
   Route::get('' ,function (){
       return response()->json([
           'message' => 'you are logged in'
       ]);
   });

});

Route::group(['prefix' => 'patient'] , function (){
   Route::post('login' , [PatientAuthController::class  , 'login']);
   Route::post('signup' , [PatientAuthController::class  , 'signup']);
});

Route::group(['prefix' => 'doctor'] , function (){
   Route::post('login' , [DoctorAuthController::class  , 'login']);
   Route::post('signup' , [DoctorAuthController::class  , 'signup']);
});
