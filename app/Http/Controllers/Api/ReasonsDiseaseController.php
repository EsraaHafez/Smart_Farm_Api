<?php

namespace App\Http\Controllers\Api;

use App\Models\Reasons_Disease;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Validator;
use App\Http\Resources\Reasons_Disease as Reasons_DiseaseResource;

class ReasonsDiseaseController extends Basecontroller
{
    public function index()
    {
        $Reasons_Disease = Reasons_Disease::orderBy('id' , 'asc')->get();
        return $this->sendResponse(Reasons_DiseaseResource::collection($Reasons_Disease) , 'All Reasons_Disease sent');

    }

    public function Disease($Disease_id)
    {
        $Reasons_Disease = Reasons_Disease::where('Disease_id' , $Disease_id)->get();
        return $this->sendResponse(Reasons_DiseaseResource::collection($Reasons_Disease) , 'All Reasons_Disease sent');

    }


    public function store(Request $request)
    {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'id'   => 'required',
            'Disease_id'   => 'required',
            'Reasons'   => 'required',

        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

          $Reasons_Disease = Reasons_Disease::create($input);
          return $this->sendResponse(new Reasons_DiseaseResource($Reasons_Disease), 'Reasons_Disease create  successfully');
    }



    public function show($id)
    {
        $Reasons_Disease = Reasons_Disease::find($id);
        if(is_null($Reasons_Disease)){

            return $this->sendError('Reasons_Disease Not Found');

        }
        return $this->sendResponse(new Reasons_DiseaseResource($Reasons_Disease), 'Reasons_Disease Found  successfully');

    }


    public function update(Request $request, Reasons_Disease $Reasons_Disease)
     {
        $input = $request->all() ;
        $validator = Validator::make($input , [

            'Disease_id'   => 'required',
            'Reasons'   => 'required',


        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

       /*  if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $validator->errors());

        } */

         // first Crops_Name from database and second from user.
        $Reasons_Disease->Disease_id = $input['Disease_id'];
        $Reasons_Disease->Reasons = $input['Reasons'];




        $Reasons_Disease->save();
         return $this->sendResponse(new Reasons_DiseaseResource($Reasons_Disease), 'Reasons_Disease update  successfully');

    }


    public function destroy(Reasons_Disease $Reasons_Disease)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        $Reasons_Disease->delete();
        return $this->sendResponse(new Reasons_DiseaseResource($Reasons_Disease), 'Reasons_Disease deleted  successfully');

    }

    public function deleteReasons_Disease($id)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        if($Reasons_Disease = Reasons_Disease::find($id)){
        $Reasons_Disease->delete();
        return $this->sendResponse(new Reasons_DiseaseResource($Reasons_Disease), 'Reasons_Disease deleted  successfully');
        }
        else{
            return response()->json([
                'status' => 0,
                'msg' => 'fail'
            ]);
        }
    }

    public function updateReasons_Disease(Request $request,   $id)
    {
        if($Reasons_Disease = Reasons_Disease::find($id)){
       $input = $request->all() ;
       $validator = Validator::make($input , [

           'Disease_id'   => 'required',
           'Reasons'   => 'required',


       ]) ;

       if($validator->fails()){

           return $this->sendError('please validate error' , $validator->errors());

       }

      /*  if($crop->user_id != Auth::id()){

           return $this->sendError('you dont have rights' , $validator->errors());

       } */

        // first Crops_Name from database and second from user.
       $Reasons_Disease->Disease_id = $input['Disease_id'];
       $Reasons_Disease->Reasons = $input['Reasons'];

       $Reasons_Disease->save();
        return $this->sendResponse(new Reasons_DiseaseResource($Reasons_Disease), 'Reasons_Disease update  successfully');
    }

    else{
        return response()->json([
            'status' => 0,
            'msg' => 'fail'
        ]);
    }

   }
}
