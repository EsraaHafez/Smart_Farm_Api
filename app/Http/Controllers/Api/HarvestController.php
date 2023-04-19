<?php

namespace App\Http\Controllers\Api;

use App\Models\Harvest;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Validator;
use App\Http\Resources\Harvest as HarvestResource;


class HarvestController extends Basecontroller
{


    public function index()
    {
        $Harvest = Harvest::all();
        return $this->sendResponse(HarvestResource::collection($Harvest) , 'All Harvests sent');

    }

    public function store(Request $request)
    {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'Name'   => 'required',
            'Harvest_Date'   => 'required',
            'Price'   => 'required',
            'Type'   => 'required',
            'Quantity'   => 'required'

        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

          $Harvest = Harvest::create($input);
          return $this->sendResponse(new HarvestResource($Harvest), 'Harvest create  successfully');
    }



    public function show($Harvest_id)
    {
        $Harvest = Harvest::find($Harvest_id);
        if(is_null($Harvest)){

            return $this->sendError('Harvest Not Found');

        }
        return $this->sendResponse(new HarvestResource($Harvest), 'Harvest Found  successfully');

    }


    public function update(Request $request, Harvest $Harvest)
     {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'Name'   => 'required',
            'Harvest_Date'   => 'required',
            'Price'   => 'required',
            'Type'   => 'required',
            'Quantity'   => 'required'

        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

       /*  if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $validator->errors());

        } */

         // first Crops_Name from database and second from user.
        $Harvest->Name = $input['Name'];
        $Harvest->Harvest_Date = $input['Harvest_Date'];
        $Harvest->Price = $input['Price'];
        $Harvest->Type = $input['Type'];
        $Harvest->Quantity = $input['Quantity'];

        $Harvest->save();
         return $this->sendResponse(new HarvestResource($Harvest), 'Harvest update  successfully');

    }


    public function destroy(Harvest $Harvest)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        $Harvest->delete();
        return $this->sendResponse(new HarvestResource($Harvest), 'Harvest deleted  successfully');

    }
}
