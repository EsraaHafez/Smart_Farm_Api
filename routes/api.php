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


Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@Login');

/*
Route::middleware('jwt.auth')->get('/users',function (Request $request) {
    return auth()->user();
}); */

Route::middleware('auth:api')->get('/users',function (Request $request) {
    return auth()->user();
    return Passport::tokensExpireIn(Carbon::now()->addDays(15));
});

//all routes /api here must be api authenticated .

// Route::group(['middleware' => ['api' , 'checkPassword'] , 'namespace' => 'Api'], function(){});

 Route::middleware('auth:api')->group(function () {

    Route::resource('Crops', 'Api\CropController');
    Route::get('Crops/Field/{id}', 'Api\CropController@Field');

    Route::resource('fields', 'Api\FieldController');
    Route::get('fields/Harvest/{id}', 'Api\FieldController@Harvest');

    Route::resource('Disease', 'Api\DiseaseController');

    Route::resource('Harvest', 'Api\HarvestController');

    Route::resource('Storage', 'Api\StorageController');

    Route::resource('StorageHarvest', 'Api\StorageHarvestController');
    Route::get('StorageHarvest/Harvest/{id}', 'Api\StorageHarvestController@Harvest');
    Route::get('StorageHarvest/Storage/{id}', 'Api\StorageHarvestController@Storage');

    Route::resource('Harvest of Crops', 'Api\HarvestofCropsController');
    Route::get('Harvest of Crops/Harvest/{id}', 'Api\HarvestofCropsController@Harvest');
    Route::get('Harvest of Crops/Crops/{id}', 'Api\HarvestofCropsController@Crops');


    Route::resource('type_treatment', 'Api\TypeTreatmentController');
    Route::get('type_treatment/Farmer/{id}', 'Api\TypeTreatmentController@Farmer');
    Route::get('type_treatment/Disease/{id}', 'Api\TypeTreatmentController@Disease');

    Route::resource('farmer', 'Api\FarmerController');
    Route::get('farmer/Harvest/{id}', 'Api\FarmerController@Harvest');
    Route::get('farmer/Actor/{name}', 'Api\FarmerController@Actor');

    Route::resource('Farmersoffields', 'Api\FarmersoffieldsController');
    Route::get('Farmersoffields/Field/{id}', 'Api\FarmersoffieldsController@Field');
    Route::get('Farmersoffields/Farmer/{id}', 'Api\FarmersoffieldsController@Farmer');

    Route::resource('Storageofusers', 'Api\StorageofClientController');
    Route::get('Storageofusers/users/{id}', 'Api\StorageofClientController@users');
    Route::get('Storageofusers/Storge/{id}', 'Api\StorageofClientController@Storge');

    Route::resource('CartStorge', 'Api\CartStorgeController');
    Route::get('CartStorge/Cart/{id}', 'Api\CartStorgeController@Cart');
    Route::get('CartStorge/Storge/{id}', 'Api\CartStorgeController@Storge');

    Route::resource('Order', 'Api\OrderController');
    Route::get('Order/user/{id}', 'Api\OrderController@user');
    Route::get('Order/Cart/{id}', 'Api\OrderController@Cart');


    Route::resource('HarvestCart', 'Api\HarvestCartController');
    Route::get('HarvestCart/Harvest/{id}', 'Api\HarvestCartController@Harvest');
    Route::get('HarvestCart/Cart/{id}', 'Api\HarvestCartController@Cart');

    Route::resource('CropsDisease', 'Api\CropsDiseaseController');
    Route::get('CropsDisease/Crops/{Crops_Name}', 'Api\CropsDiseaseController@Crops');

    Route::resource('Farmers_Phone', 'Api\FarmersPhoneController');
    Route::get('Farmers_Phone/Farmer/{id}', 'Api\FarmersPhoneController@Farmer');

    Route::resource('Reasons_Disease', 'Api\ReasonsDiseaseController');
    Route::get('Reasons_Disease/Disease/{id}', 'Api\ReasonsDiseaseController@Disease');

    Route::resource('Actors_Phone', 'Api\ActorsPhoneController');
    Route::get('Actors_Phone/Actor/{Name}', 'Api\ActorsPhoneController@Actor');


    Route::resource('Users_Phone', 'Api\UsersPhoneController');
     Route::get('Users_Phone/user', 'Api\UsersPhoneController@user');




 });

 Route::post('actors/register', 'Api\ActorController@register');
 Route::post('actors/login', 'Api\ActorController@login');

