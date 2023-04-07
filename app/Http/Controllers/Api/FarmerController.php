<?php

namespace App\Http\Controllers\Api;

use App\Models\Farmer;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Validator;
use App\Http\Resources\Farmer as FarmerResource;


class FarmerController extends Basecontroller
{


    public function index()
    {
        $Farmer = Farmer::all();
        return $this->sendResponse(FarmerResource::collection($Farmer) , 'All Farmer sent');

    }

    public function Harvest($Harvest_id)
    {
        $Farmer = Farmer::where('Harvest_id' , $Harvest_id)->get();
        return $this->sendResponse(FarmerResource::collection($Farmer) , 'All Farmer sent');

    }

    public function Actor($Actor_Name)
    {
        $Farmer = Farmer::where('Actor_Name' , $Actor_Name)->get();
        return $this->sendResponse(FarmerResource::collection($Farmer) , 'All Farmer sent');

    }


    public function store(Request $request)
    {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'firstname'   => 'required',
            'lastname'   => 'required',
            'email'   => 'required|email',
            'Address'   => 'required',
            'Harvest_id'   => 'required',
            'Actor_Name'   => 'required',

        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

          $Farmer = Farmer::create($input);
          return $this->sendResponse(new FarmerResource($Farmer), 'Farmer create  successfully');
    }



    public function show($Treatment_ID)
    {
        $Farmer = Farmer::find($Treatment_ID);
        if(is_null($Farmer)){

            return $this->sendError('Farmer Not Found');

        }
        return $this->sendResponse(new FarmerResource($Farmer), 'Farmer Found  successfully');

    }


    public function update(Request $request, Farmer $Farmer)
     {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'firstname'   => 'required',
            'lastname'   => 'required',
            'email'   => 'required|email',
            'Address'   => 'required',
            'Harvest_id'   => 'required',
            'Actor_Name'   => 'required',


        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

       /*  if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $validator->errors());

        } */

         // first Crops_Name from database and second from user.
        $Farmer->firstname = $input['firstname'];
        $Farmer->lastname = $input['lastname'];
        $Farmer->email = $input['email'];
        $Farmer->Address = $input['Address'];
        $Farmer->Harvest_id = $input['Harvest_id'];
        $Farmer->Actor_Name = $input['Actor_Name'];



        $Farmer->save();
         return $this->sendResponse(new FarmerResource($Farmer), 'Farmer update  successfully');

    }


    public function destroy(Farmer $Farmer)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        $Farmer->delete();
        return $this->sendResponse(new FarmerResource($Farmer), 'Farmer deleted  successfully');

    }
}
