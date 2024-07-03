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

    public function Actor($id)
    {
        $Farmer = Farmer::where('id' , $id)->get();
        return $this->sendResponse(FarmerResource::collection($Farmer) , 'All Farmer sent');

    }


    public function store(Request $request)
    {
        $input = $request->all() ;
        $input['id'] =  Auth::User()->id;
        $validator = Validator::make($input , [
            'firstname'   => 'required',
            'lastname'   => 'required',
            'Gender'   => 'required',
            'Address'   => 'required',
            'Mobile'   =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11',
            'Harvest_id'   => 'required',
            'id'   => 'required',

        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

          $Farmer = Farmer::create($input);
          return $this->sendResponse(new FarmerResource($Farmer), 'Farmer create  successfully');
    }



    public function show($Farmer_id)
    {
        $Farmer = Farmer::find($Farmer_id);
        if(is_null($Farmer)){

            return $this->sendError('Farmer Not Found');

        }
        return $this->sendResponse(new FarmerResource($Farmer), 'Farmer Found  successfully');

    }


    public function update(Request $request, Farmer $Farmer)
     {
        $input = $request->all() ;
        $input['id'] =  Auth::User()->id;
        $validator = Validator::make($input , [
            'firstname'   => 'required',
            'lastname'   => 'required',
            'Gender'   => 'required',
            'Address'   => 'required',
            'Mobile'   =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11',
            'Harvest_id'   => 'required',
            'id'   => 'required',


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
        $Farmer->Gender = $input['Gender'];
        $Farmer->Mobile = $input['Mobile'];
        $Farmer->Address = $input['Address'];
        $Farmer->Harvest_id = $input['Harvest_id'];
        $Farmer->id = $input['id'];



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

    public function deletefarmers($Farmer_id)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        if($Farmer = Farmer::find($Farmer_id)){
        $Farmer->delete();
        return $this->sendResponse(new FarmerResource($Farmer), 'Farmer deleted  successfully');
    }
    else{
        return response()->json([
            'status' => 0,
            'msg' => 'fail'
        ]);
    }
    }

       public function updatefarmers(Request $request,   $Farmer_id)
     {
        if($Farmer = Farmer::find($Farmer_id)){
        $input = $request->all() ;
        $input['id'] =  Auth::User()->id;
        $validator = Validator::make($input , [
            'firstname'   => 'required',
            'lastname'   => 'required',
            'Gender'   => 'required',
            'Mobile'   =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11',
            'Address'   => 'required',
            'Harvest_id'   => 'required',
            'id'   => 'required',


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
         $Farmer->Gender = $input['Gender'];
         $Farmer->Mobile = $input['Mobile'];
         $Farmer->Address = $input['Address'];
         $Farmer->Harvest_id = $input['Harvest_id'];
         $Farmer->id = $input['id'];



         $Farmer->save();
          return $this->sendResponse(new FarmerResource($Farmer), 'Farmer update  successfully');
        }

        else{
            return response()->json([
                'status' => 0,
                'msg' => 'fail'
            ]);
        }
     }
}
