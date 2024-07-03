<?php

namespace App\Http\Controllers\Api;

use App\Models\StorageofClient;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Validator;
use App\Http\Resources\StorageofClient as StorageofClientsResource;
use Auth;
use App\Models\User;
use App\Models\Storage;

class StorageofClientController extends Basecontroller
{


    public function index()
    {
        $StorageofClient = StorageofClient::all();
        return $this->sendResponse(StorageofClientsResource::collection($StorageofClient) , 'All StorageofClient sent');

    }

    public function Storageofuser()
    {
        //$Order = Order::all();
        $StorageofClient = StorageofClient::where('id' , Auth::id())->get();
        return $this->sendResponse(StorageofClientsResource::collection($StorageofClient) , 'All Storage sent');

    }

    public function users($id)
    {
        $StorageofClient = StorageofClient::where('id' , $id)->get();
        return $this->sendResponse(StorageofClientsResource::collection($StorageofClient) , 'All StorageofClient sent');

    }

    public function Storge($Storge_id)
    {
        $StorageofClient = StorageofClient::where('Storge_id' , $Storge_id)->get();
        return $this->sendResponse(StorageofClientsResource::collection($StorageofClient) , 'All StorageofClient sent');

    }


    public function store(Request $request)
    {
        $input = $request->all() ;
        $input['id'] =  Auth::User()->id;
        $validator = Validator::make($input , [


            //'id'   => 'required',
            'Storge_id'   => 'required',


        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

          $StorageofClient = StorageofClient::create($input);
          return $this->sendResponse(new StorageofClientsResource($StorageofClient), 'StorageofClient create  successfully');
    }


    /* public function show($Storge_id)
    {

        $StorageofClient = StorageofClient::where('Storge_id' , $Storge_id)->where('id',Auth::id())->first();
        if(is_null($StorageofClient)){

            return $this->sendError('StorageofClients Not Found');

        }
        return $this->sendResponse(new StorageofClientsResource($StorageofClient), 'StorageofClient Found  successfully');

    } */

    /*  public function show($id)
    {
        $StorageofClient = StorageofClient::find($id);
        if(is_null($StorageofClient)){

            return $this->sendError('Farmer Not Found');

        }
        return $this->sendResponse(new StorageofClientsResource($StorageofClient), 'StorageofClient Found  successfully');

    } */


public function updatestorage(Request $request,$Storge_id)

{
    /*  $errorMessage = [] ;
     if($Phone->id != Auth::id()){

    return $this->sendError('you dont have rights' , $errorMessage);

} */
    if($Storge_id = StorageofClient::where('Storge_id', $Storge_id)->where('id' , Auth::id())->update($request->all()))
    {
    //return $this->sendResponse(new Users_PhoneResource($Phone),'Users_Phone update  successfully');
    return response()->json([
        'status' => 1,
        'msg' => 'your Storge update  successfully'
    ]);

    }

    else{
        return response()->json([
            'status' => 0,
            'msg' => 'fail'
        ]);
    }
}

public function delete( $StorageofClient)
{

    if($StorageofClient = StorageofClient::where('Storge_id', $StorageofClient)->where('id' , Auth::id())->delete())
    {
   /*    return $this->sendResponse(new StorageofClientsResource($StorageofClient)
      , 'Your Storge delete  Successfully' ); */

      return response()->json([
        'status' => 1,
        'msg' => 'Your Storge delete  Successfully'
    ]);
}

    else{
        return response()->json([
            'status' => 0,
            'msg' => 'fail'
        ]);
    }


}

}
