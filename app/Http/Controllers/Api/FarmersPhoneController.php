<?php

namespace App\Http\Controllers\Api;

use App\Models\Farmers_Phone;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Validator;
use App\Http\Resources\Farmers_Phone as Farmers_PhoneResource;

class FarmersPhoneController extends Basecontroller
{
    public function index()
    {
        $Farmers_Phone = Farmers_Phone::orderBy('id' , 'asc')->get();
        return $this->sendResponse(Farmers_PhoneResource::collection($Farmers_Phone) , 'All Farmers_Phone sent');

    }

    public function Farmer($Farmer_id)
    {
        $Farmers_Phone = Farmers_Phone::where('Farmer_id' , $Farmer_id)->get();
        return $this->sendResponse(Farmers_PhoneResource::collection($Farmers_Phone) , 'All Farmers_Phone sent');

    }


    public function store(Request $request)
    {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'id'   => 'required',
            'Farmer_id'   => 'required',
            'Mobile'   => 'required',

        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

          $Farmers_Phone = Farmers_Phone::create($input);
          return $this->sendResponse(new Farmers_PhoneResource($Farmers_Phone), 'Farmers_Phone create  successfully');
    }



    public function show($id)
    {
        $Farmers_Phone = Farmers_Phone::find($id);
        if(is_null($Farmers_Phone)){

            return $this->sendError('Farmers_Phone Not Found');

        }
        return $this->sendResponse(new Farmers_PhoneResource($Farmers_Phone), 'Farmers_Phone Found  successfully');

    }


    public function update(Request $request, Farmers_Phone $Farmers_Phone)
     {
        $input = $request->all() ;
        $validator = Validator::make($input , [

            'Farmer_id'   => 'required',
            'Mobile'   => 'required',


        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

       /*  if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $validator->errors());

        } */

         // first Crops_Name from database and second from user.
        $Farmers_Phone->Farmer_id = $input['Farmer_id'];
        $Farmers_Phone->Mobile = $input['Mobile'];




        $Farmers_Phone->save();
         return $this->sendResponse(new Farmers_PhoneResource($Farmers_Phone), 'Farmers_Phone update  successfully');

    }


    public function destroy(Farmers_Phone $Farmers_Phone)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        $Farmers_Phone->delete();
        return $this->sendResponse(new Farmers_PhoneResource($Farmers_Phone), 'Farmers_Phone deleted  successfully');

    }
}
