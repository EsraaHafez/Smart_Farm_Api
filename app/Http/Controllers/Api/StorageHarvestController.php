<?php

namespace App\Http\Controllers\Api;

use App\Models\StorageHarvest;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Validator;
use App\Http\Resources\StorageHarvest as StorageHarvestResource;


class StorageHarvestController extends Basecontroller
{

    public function index()
    {
        $StorageHarvest = StorageHarvest::orderBy('id' , 'asc')->get();
        return $this->sendResponse(StorageHarvestResource::collection($StorageHarvest) , 'All StorageHarvests sent');

    }

    public function Harvest($Harvest_id)
    {
        $StorageHarvest = StorageHarvest::where('Harvest_id' , $Harvest_id)->get();
        return $this->sendResponse(StorageHarvestResource::collection($StorageHarvest) , 'All StorageHarvest sent');

    }

    public function Storage($Storge_id)
    {
        $StorageHarvest = StorageHarvest::where('Storge_id' , $Storge_id)->get();
        return $this->sendResponse(StorageHarvestResource::collection($StorageHarvest) , 'All StorageHarvest sent');

    }

    public function store(Request $request)
    {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'id'           => 'required',
            'Harvest_id'   => 'required',
            'Storge_id'   => 'required',


        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

          $StorageHarvest = StorageHarvest::create($input);
          return $this->sendResponse(new StorageHarvestResource($StorageHarvest), 'StorageHarvest create  successfully');
    }



      public function show($id)
    {
        $StorageHarvest = StorageHarvest::find($id);
        if(is_null($StorageHarvest)){

            return $this->sendError('Disease Not Found');

        }
        return $this->sendResponse(new StorageHarvestResource($StorageHarvest), 'StorageHarvest Found  successfully');

    }


    public function update(Request $request, StorageHarvest $StorageHarvest)
     {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'id'   => 'required',
            'Harvest_id'   => 'required',
            'Storge_id'   => 'required',


        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

       /*  if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $validator->errors());

        } */

         // first Crops_Name from database and second from user.
        $StorageHarvest->Harvest_id = $input['Harvest_id'];
        $StorageHarvest->Storge_id = $input['Storge_id'];


        $StorageHarvest->save();
         return $this->sendResponse(new StorageHarvestResource($StorageHarvest), 'StorageHarvest update  successfully');

    }


    public function destroy(StorageHarvest $StorageHarvest)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        $StorageHarvest->delete();

        return $this->sendResponse(new StorageHarvestResource($StorageHarvest), 'StorageHarvest deleted  successfully');

    }
}
