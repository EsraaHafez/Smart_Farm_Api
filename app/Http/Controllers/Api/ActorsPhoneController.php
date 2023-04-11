<?php

namespace App\Http\Controllers\Api;

use App\Models\Actors_Phone;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Validator;
use App\Http\Resources\Actors_Phone as   Actors_PhoneResource;

class ActorsPhoneController extends Basecontroller
{
    public function index()
    {
        $Actors_Phone = Actors_Phone::orderBy('id' , 'asc')->get();
        return $this->sendResponse(Actors_PhoneResource::collection($Actors_Phone) , 'All Actors_Phone sent');

    }

    public function Actor($Actor_Name)
    {
        $Actors_Phone = Actors_Phone::where('Actor_Name' , $Actor_Name)->get();
        return $this->sendResponse(Actors_PhoneResource::collection($Actors_Phone) , 'All Actors_Phone sent');

    }


    public function store(Request $request)
    {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'id'   => 'required',
            'Actor_Name'   => 'required',
            'Phone'   => 'required',

        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

          $Actors_Phone = Actors_Phone::create($input);
          return $this->sendResponse(new Actors_PhoneResource($Actors_Phone), 'Actors_Phone create  successfully');
    }



    public function show($id)
    {
        $Actors_Phone = Actors_Phone::find($id);
        if(is_null($Actors_Phone)){

            return $this->sendError('Actors_Phone Not Found');

        }
        return $this->sendResponse(new Actors_PhoneResource($Actors_Phone), 'Actors_Phone Found  successfully');

    }


    public function update(Request $request, Actors_Phone $Actors_Phone)
     {
        $input = $request->all() ;
        $validator = Validator::make($input , [

            'Actor_Name'   => 'required',
            'Phone'   => 'required',


        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

       /*  if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $validator->errors());

        } */

         // first Crops_Name from database and second from user.
        $Actors_Phone->Actor_Name = $input['Actor_Name'];
        $Actors_Phone->Phone = $input['Phone'];




        $Actors_Phone->save();
         return $this->sendResponse(new Actors_PhoneResource($Actors_Phone), 'Actors_Phone update  successfully');

    }


    public function destroy(Actors_Phone $Actors_Phone)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        $Actors_Phone->delete();
        return $this->sendResponse(new Actors_PhoneResource($Actors_Phone), 'Actors_Phone deleted  successfully');

    }
}
