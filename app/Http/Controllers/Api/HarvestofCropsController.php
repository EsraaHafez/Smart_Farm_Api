<?php

namespace App\Http\Controllers\Api;

use App\Models\HarvestofCrops;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Validator;
use App\Http\Resources\HarvestofCrops as HarvestofCropsResource;


class HarvestofCropsController extends Basecontroller
{
    public function index()
    {
        $HarvestofCrops = HarvestofCrops::orderBy('id' , 'asc')->get();
        return $this->sendResponse(HarvestofCropsResource::collection($HarvestofCrops) , 'All HarvestofCropss sent');

    }

    public function Harvest($Harvest_id)
    {
        $HarvestofCrops = HarvestofCrops::where('Harvest_id' , $Harvest_id)->get();
        return $this->sendResponse(HarvestofCropsResource::collection($HarvestofCrops) , 'All HarvestofCrops sent');

    }

    public function Crops($Crops_Name)
    {
        $HarvestofCrops = HarvestofCrops::where('Crops_Name' , $Crops_Name)->get();
        return $this->sendResponse(HarvestofCropsResource::collection($HarvestofCrops) , 'All HarvestofCrops sent');

    }

    public function store(Request $request)
    {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'id'   => 'required',
            'Harvest_id'   => 'required',
            'Crops_Name'   => 'required'


        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

          $HarvestofCrops = HarvestofCrops::create($input);
          return $this->sendResponse(new HarvestofCropsResource($HarvestofCrops), 'HarvestofCrops create  successfully');
    }



    public function show($id)
    {
        $HarvestofCrops = HarvestofCrops::find($id);
        if(is_null($HarvestofCrops)){

            return $this->sendError('Disease Not Found');

        }
        return $this->sendResponse(new HarvestofCropsResource($HarvestofCrops), 'StorageHarvest Found  successfully');

    }


    public function update(Request $request, HarvestofCrops $HarvestofCrop)
     {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'Harvest_id'   => 'required',
            'Crops_Name'   => 'required'


        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

       /*  if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $validator->errors());

        } */

         // first Crops_Name from database and second from user.
        $HarvestofCrop->Harvest_id = $input['Harvest_id'];
        $HarvestofCrop->Crops_Name = $input['Crops_Name'];


        $HarvestofCrop->save();
         return $this->sendResponse(new HarvestofCropsResource($HarvestofCrop), 'HarvestofCrops update  successfully');

    }


    public function destroy(HarvestofCrops $HarvestofCrop)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        $HarvestofCrop->delete();

        return $this->sendResponse(new HarvestofCropsResource($HarvestofCrop), 'HarvestofCrops deleted  successfully');

    }
}
