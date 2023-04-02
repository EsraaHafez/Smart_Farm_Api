<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/*
Route::post('register', 'Api\RegisterController@register');
Route::post('login', 'Api\RegisterController@Login'); */



///////////////////////////////////Routes of prohect///////////////////////////////////

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@Login');





Route::middleware('auth:api')->group(function () {

    Route::resource('Crops', 'Api\CropController');
    Route::get('Crops/Field/{id}', 'Api\CropController@Field');

 });
