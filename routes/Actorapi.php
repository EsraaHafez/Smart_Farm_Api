<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});


Route::middleware('checkActoreToken:Actorapi')->group(function () {

    Route::resource('Crops', 'Api\CropController');
    Route::get('Crops/Field/{id}', 'Api\CropController@Field');

});
