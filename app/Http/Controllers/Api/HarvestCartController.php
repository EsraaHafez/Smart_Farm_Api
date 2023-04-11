<?php

namespace App\Http\Controllers\Api;

use App\Models\HarvestCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Validator;
use App\Http\Resources\HarvestCart as HarvestCartResource;


class HarvestCartController extends Basecontroller
{
    public function index()
    {
        $HarvestCart = HarvestCart::orderBy('id' , 'asc')->get();
        return $this->sendResponse(HarvestCartResource::collection($HarvestCart) , 'All HarvestCarts sent');

    }

    public function Harvest($Harvest_id)
    {
        $HarvestCart = HarvestCart::where('Harvest_id' , $Harvest_id)->get();
        return $this->sendResponse(HarvestCartResource::collection($HarvestCart) , 'All HarvestCart sent');

    }

    public function Cart($Cart_id)
    {
        $HarvestCart = HarvestCart::where('Cart_id' , $Cart_id)->get();
        return $this->sendResponse(HarvestCartResource::collection($HarvestCart) , 'All HarvestCart sent');

    }

    public function store(Request $request)
    {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'id'   => 'required',
            'Harvest_id'   => 'required',
            'Cart_id'   => 'required'


        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

          $HarvestCart = HarvestCart::create($input);
          return $this->sendResponse(new HarvestCartResource($HarvestCart), 'HarvestCart create  successfully');
    }



    public function show($id)
    {
        $HarvestCart = HarvestCart::find($id);
        if(is_null($HarvestCart)){

            return $this->sendError('HarvestCart Not Found');

        }
        return $this->sendResponse(new HarvestCartResource($HarvestCart), 'StorageHarvest Found  successfully');

    }


    public function update(Request $request, HarvestCart $HarvestCart)
     {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'Harvest_id'   => 'required',
            'Cart_id'   => 'required'


        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

       /*  if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $validator->errors());

        } */

         // first Crops_Name from database and second from user.
        $HarvestCart->Harvest_id = $input['Harvest_id'];
        $HarvestCart->Cart_id = $input['Cart_id'];


        $HarvestCart->save();
         return $this->sendResponse(new HarvestCartResource($HarvestCart), 'HarvestCart update  successfully');

    }


    public function destroy(HarvestCart $HarvestCart)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        $HarvestCart->delete();

        return $this->sendResponse(new HarvestCartResource($HarvestCart), 'HarvestCart deleted  successfully');

    }
}
