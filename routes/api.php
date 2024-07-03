<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CropController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ActorController;
use App\Http\Controllers\Api\AuthController;

use App\Http\Controllers\Api\forgetpassword;
use App\Http\Controllers\Api\resetpassword;

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

Route::post('changepassword', 'Api\AuthController@changePassword');

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@Login');
Route::post('logout', 'Api\AuthController@logout');

Route::post('password/forgot-password', 'Api\forgetpassword@forgotpassword');
Route::post('password/reset', 'Api\resetpassword@passwordReset');


Route::middleware('auth:api')->group(function () {
    Route::post('change-password', 'Api\AuthController@change_password');
});




Route::post('login/User', 'Api\LoginController@login');
Route::post('login/Admin', 'Api\LoginController@login');



/*
Route::middleware('jwt.auth')->get('/users',function (Request $request) {
    return auth()->user();
}); */


Route::middleware('auth:api')->get('/users',function (Request $request) {
    return auth()->user();
    //return Passport::tokensExpireIn(Carbon::now()->addDays(15));
});



//all routes /api here must be api authenticated .

// Route::group(['middleware' => ['api' , 'checkPassword'] , 'namespace' => 'Api'], function(){});

 Route::middleware('auth:api')->group(function () {

           //////////////////Actor//////////////////////
/*
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

    Route::resource('HarvestofCrops', 'Api\HarvestofCropsController');
    Route::get('HarvestofCrops/Harvest/{id}', 'Api\HarvestofCropsController@Harvest');
    Route::get('HarvestofCrops/Crops/{id}', 'Api\HarvestofCropsController@Crops');

    Route::resource('type_treatment', 'Api\TypeTreatmentController');
    Route::get('type_treatment/Farmer/{id}', 'Api\TypeTreatmentController@Farmer');
    Route::get('type_treatment/Disease/{id}', 'Api\TypeTreatmentController@Disease'); */

/*     Route::resource('farmer', 'Api\FarmerController');
    Route::get('farmer/Harvest/{id}', 'Api\FarmerController@Harvest');
    Route::get('farmer/Actor/{name}', 'Api\FarmerController@Actor'); */

/*     Route::resource('Farmersoffields', 'Api\FarmersoffieldsController');
    Route::get('Farmersoffields/Field/{id}', 'Api\FarmersoffieldsController@Field');
    Route::get('Farmersoffields/Farmer/{id}', 'Api\FarmersoffieldsController@Farmer'); */


/*
    Route::resource('CartStorge', 'Api\CartStorgeController');
    Route::get('CartStorge/Cart/{id}', 'Api\CartStorgeController@Cart');
    Route::get('CartStorge/Storge/{id}', 'Api\CartStorgeController@Storge'); */


      //////////Users/////////////////////////////Actor/////////////////////////////////

     Route::resource('Storageofusers', 'Api\StorageofClientController');
     Route::post('updatestorage/{Storge_id}', 'Api\StorageofClientController@updatestorage');
     Route::post('Dstorage/{Storge_id}', 'Api\StorageofClientController@delete');
     Route::get('Storageofuser', 'Api\StorageofClientController@Storageofuser');

   /*   Route::get('Storageofusers/users/{id}', 'Api\StorageofClientController@users');
     Route::get('Storageofusers/Storge/{id}', 'Api\StorageofClientController@Storge'); */



     Route::get('CartUser', 'Api\CartController@userCart');
     Route::post('CartUser', 'Api\CartController@store');
     Route::post('updateCartUser/{Cart_id}', 'Api\CartController@updateCart');
     Route::post('deleteCartUser/{Cart_id}', 'Api\CartController@delete');



    Route::resource('Order', 'Api\OrderController');
    Route::get('Orderuser', 'Api\OrderController@userOwn');
    Route::post('updateOrderuser/{order_id}', 'Api\OrderController@updateOrder');
    Route::post('deleteOrderuser/{order_id}', 'Api\OrderController@deleteOrder');
    //Route::get('Order/Cart/{id}', 'Api\OrderController@Cart');


 /*    Route::resource('HarvestCart', 'Api\HarvestCartController');
    Route::get('HarvestCart/Harvest/{id}', 'Api\HarvestCartController@Harvest');
    Route::get('HarvestCart/Cart/{id}', 'Api\HarvestCartController@Cart'); */

/*     Route::resource('CropsDisease', 'Api\CropsDiseaseController');
    Route::get('CropsDisease/Crops/{Crops_Name}', 'Api\CropsDiseaseController@Crops'); */

/*     Route::resource('Farmers_Phone', 'Api\FarmersPhoneController');
    Route::get('Farmers_Phone/Farmer/{id}', 'Api\FarmersPhoneController@Farmer'); */

/*     Route::resource('Reasons_Disease', 'Api\ReasonsDiseaseController');
    Route::get('Reasons_Disease/Disease/{id}', 'Api\ReasonsDiseaseController@Disease'); */
/*
    Route::resource('Actors_Phone', 'Api\ActorsPhoneController');
    Route::get('Actors_Phone/Actor/{Name}', 'Api\ActorsPhoneController@Actor'); */


    Route::resource('Users_Phone', 'Api\UsersPhoneController');
    Route::get('PhoneUser', 'Api\UsersPhoneController@userPhone');
    Route::post('PhoneUser', 'Api\UsersPhoneController@sendPhone');
    Route::post('updatePhoneUser/{phone_User}', 'Api\UsersPhoneController@updatephone');
    Route::post('DeletePhoneUser/{phone_User}', 'Api\UsersPhoneController@delete');
    //Route::get('Users_Phone/user', 'Api\UsersPhoneController@user');
 });

  ///////////////////// Route Actor ///////////////////////////////////////////////////

 Route::post('actors/register', 'Api\ActorController@register');
 Route::post('actors/login', 'Api\ActorController@login');
 Route::post('actors/logout', 'Api\ActorController@logout');


 Route::post('Actor/forgot-password', 'Api\forgetpassword@forgotpassword');
 Route::post('Actor/reset-password', 'Api\resetpassword@passwordReset');





 //Route::middleware('auth:Actorapi')->group(function () {

 Route::middleware('checkActoreToken:Actorapi')->group(function () {

           //Crops
    Route::resource('Crops', 'Api\CropController');
    Route::get('Crops/Field/{Field_id}', 'Api\CropController@Field');
    Route::post('Crop/{Crops_Name}', 'Api\CropController@updatecrops');
    Route::post('deleteCrop/{Crops_Name}', 'Api\CropController@deleteCrops');

      //Fields
    Route::resource('fields', 'Api\FieldController');
    Route::get('fields/Harvest/{id}', 'Api\FieldController@Harvest');
    Route::post('field/{id}', 'Api\FieldController@updatefields');
    Route::post('deletefield/{id}', 'Api\FieldController@deletefields');

      //Disease
    Route::resource('Disease', 'Api\DiseaseController');
    Route::post('Disease/{Disease_id}', 'Api\DiseaseController@updateDisease');
    Route::post('deleteDisease/{Disease_id}', 'Api\DiseaseController@deleteDisease');

     //Harvest
    Route::resource('Harvest', 'Api\HarvestController');
    Route::post('Harvest/{Harvest_id}', 'Api\HarvestController@updateHarvest');
    Route::post('deleteHarvest/{Harvest_id}', 'Api\HarvestController@deleteHarvest');

     //Storage
    Route::resource('Storage', 'Api\StorageController');
    Route::post('Storage/{Storge_id}', 'Api\StorageController@updateStorage');
    Route::post('deleteStorage/{Storge_id}', 'Api\StorageController@deleteStorage');

     //StorageHarvest
    Route::resource('StorageHarvest', 'Api\StorageHarvestController');
    Route::get('StorageHarvest/Harvest/{id}', 'Api\StorageHarvestController@Harvest');
    Route::get('StorageHarvest/Storage/{id}', 'Api\StorageHarvestController@Storage');
    Route::post('StorageHarvest/{id}', 'Api\StorageHarvestController@updateStorageHarvest');
    Route::post('deStorageHarvest/{id}', 'Api\StorageHarvestController@deleteStorageHarvest');

    //HarvestofCrops
    Route::resource('HarvestofCrops', 'Api\HarvestofCropsController');
    Route::get('HarvestofCrops/Harvest/{id}', 'Api\HarvestofCropsController@Harvest');
    Route::get('HarvestofCrops/Crops/{id}', 'Api\HarvestofCropsController@Crops');
    Route::post('HarvestofCrop/{id}', 'Api\HarvestofCropsController@updateHarvestofCrops');
    Route::post('deHarvestofCrops/{id}', 'Api\HarvestofCropsController@deleteHarvestofCrops');

     //type_treatment
    Route::resource('type_treatment', 'Api\TypeTreatmentController');
    Route::get('type_treatment/Farmer/{id}', 'Api\TypeTreatmentController@Farmer');
    Route::get('type_treatment/Disease/{id}', 'Api\TypeTreatmentController@Disease');
    Route::post('type_treatments/{Treatment_ID}', 'Api\TypeTreatmentController@updatetype_treatment');
    Route::post('detype_treatment/{Treatment_ID}', 'Api\TypeTreatmentController@deletetype_treatment');

            //Farmer
    Route::resource('farmer', 'Api\FarmerController');
    Route::get('farmer/Harvest/{id}', 'Api\FarmerController@Harvest');
    Route::get('farmer/Actor/{id}', 'Api\FarmerController@Actor');
    Route::post('farmers/{Farmer_id}', 'Api\FarmerController@updatefarmers');
    Route::post('defarmer/{Farmer_id}', 'Api\FarmerController@deletefarmers');

          //Work
    Route::resource('Farmersoffields', 'Api\FarmersoffieldsController');
    Route::get('Farmersoffields/Field/{id}', 'Api\FarmersoffieldsController@Field');
    Route::get('Farmersoffields/Farmer/{id}', 'Api\FarmersoffieldsController@Farmer');
    Route::post('Farmersoffield/{id}', 'Api\FarmersoffieldsController@updateFarmersoffield');
    Route::post('deFarmersoffields/{id}', 'Api\FarmersoffieldsController@deleteFarmersoffield');

        // return all stograge of users[buys]
    Route::get('Storageofusersall', 'Api\StorageofClientController@index');
    Route::get('Storageofusers/users/{id}', 'Api\StorageofClientController@users');
    Route::get('Storageofusers/Storge/{id}', 'Api\StorageofClientController@Storge');

      //[Cart]
    Route::resource('Cart', 'Api\CartController');
    Route::get('Cart/user/{id}', 'Api\CartController@user');

        // contain2
    Route::resource('CartStorge', 'Api\CartStorgeController');
    Route::get('CartStorge/Cart/{id}', 'Api\CartStorgeController@Cart');
    Route::get('CartStorge/Storge/{id}', 'Api\CartStorgeController@Storge');
    Route::post('updateCartStorge/{id}', 'Api\CartStorgeController@updateCartStorge');
    Route::post('deleteCartStorge/{id}', 'Api\CartStorgeController@deleteCartStorge');

      // All order
    Route::get('AllOrders', 'Api\OrderController@AllOrder');
    Route::get('showOrder/{id}', 'Api\OrderController@showorder');
    Route::get('Order/User/{id}', 'Api\OrderController@user');
    Route::get('Order/Cart/{id}', 'Api\OrderController@Cart');

         //add
    Route::resource('HarvestCart', 'Api\HarvestCartController');
    Route::get('HarvestCart/Harvest/{id}', 'Api\HarvestCartController@Harvest');
    Route::get('HarvestCart/Cart/{id}', 'Api\HarvestCartController@Cart');
    Route::post('updateHarvestCart/{id}', 'Api\HarvestCartController@updateHarvestCart');
    Route::post('deleteHarvestCart/{id}', 'Api\HarvestCartController@deleteHarvestCart');


       // crops_disease
    Route::resource('CropsDisease', 'Api\CropsDiseaseController');
    Route::get('CropsDisease/Crops/{Crops_Name}', 'Api\CropsDiseaseController@Crops');
    Route::post('updateCropsDisease/{id}', 'Api\CropsDiseaseController@updateCropsDisease');
    Route::post('deleteCropsDisease/{id}', 'Api\CropsDiseaseController@deleteCropsDisease');

       //farmer_mobile
    Route::resource('Farmers_Phone', 'Api\FarmersPhoneController');
    Route::get('Farmers_Phone/Farmer/{id}', 'Api\FarmersPhoneController@Farmer');
    Route::post('updateFarmers_Phone/{id}', 'Api\FarmersPhoneController@updateFarmers_Phone');
    Route::post('deleteFarmers_Phone/{id}', 'Api\FarmersPhoneController@deleteFarmers_Phone');


       //reasons_diseases
    Route::resource('Reasons_Disease', 'Api\ReasonsDiseaseController');
    Route::get('Reasons_Disease/Disease/{id}', 'Api\ReasonsDiseaseController@Disease');
    Route::post('updateReasons_Disease/{id}', 'Api\ReasonsDiseaseController@updateReasons_Disease');
    Route::post('deleteReasons_Disease/{id}', 'Api\ReasonsDiseaseController@deleteReasons_Disease');

       // Actor Phone
    Route::resource('Actors_Phone', 'Api\ActorsPhoneController');
    Route::get('Actors_Phone/Actor/{Name}', 'Api\ActorsPhoneController@Actor');
    Route::post('updateActors_Phone/{id}', 'Api\ActorsPhoneController@updateActors_Phone');
    Route::post('deleteActors_Phone/{id}', 'Api\ActorsPhoneController@deleteActors_Phone');

       //sea all phone user
    Route::resource('Users_Phone', 'Api\UsersPhoneController');
    Route::get('Users_Phone/user/{user_id}', 'Api\UsersPhoneController@user');

    //get all Users
    Route::get('All_Users', 'Api\AuthController@All_Users');
    Route::get('User/{id}', 'Api\AuthController@User');


});

//get_image
Route::get('image/{Crops_Name}', 'Api\CropController@get_image');


