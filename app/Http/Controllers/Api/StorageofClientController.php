<?php

namespace App\Http\Controllers\Api;

use App\Models\StorageofClient;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Validator;
use App\Http\Resources\StorageofClient as StorageofClientsResource;

class StorageofClientController extends Basecontroller
{


    public function index()
    {
        $StorageofClient = StorageofClient::orderBy('id' , 'asc')->get();
        return $this->sendResponse(StorageofClientsResource::collection($StorageofClient) , 'All StorageofClient sent');

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
        $validator = Validator::make($input , [

            'Buys_id'   => 'required',
            'id'   => 'required',
            'Storge_id'   => 'required',


        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

          $StorageofClient = StorageofClient::create($input);
          return $this->sendResponse(new StorageofClientsResource($StorageofClient), 'StorageofClient create  successfully');
    }



     public function show($id)
    {
        $StorageofClient = StorageofClient::find($id);
        if(is_null($StorageofClient)){

            return $this->sendError('Farmer Not Found');

        }
        return $this->sendResponse(new StorageofClientsResource($StorageofClient), 'StorageofClient Found  successfully');

    }


    public function update(Request $request, StorageofClient $StorageofClient)
     {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'Client_id'   => 'required',
            'Storge_id'   => 'required',



        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

       /*  if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $validator->errors());

        } */

         // first Crops_Name from database and second from user.
        $StorageofClient->Client_id = $input['Client_id'];
        $StorageofClient->Storge_id = $input['Storge_id'];



        $StorageofClient->save();
         return $this->sendResponse(new StorageofClientsResource($StorageofClient), 'StorageofClient update  successfully');

    }


    public function destroy(StorageofClient $StorageofClients)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        $StorageofClients->delete();
        return $this->sendResponse(new StorageofClientsResource($StorageofClients), 'StorageofClient deleted  successfully');

    }
}
