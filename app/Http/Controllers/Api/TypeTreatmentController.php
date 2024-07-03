<?php

namespace App\Http\Controllers\Api;

use App\Models\TypeTreatment;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Validator;
use App\Http\Resources\TypeTreatment as TypeTreatmentResource;


class TypeTreatmentController extends Basecontroller
{

    public function index()
    {
        $TypeTreatment = TypeTreatment::all();
        return $this->sendResponse(TypeTreatmentResource::collection($TypeTreatment) , 'All TypeTreatment sent');

    }

    public function Farmer($Farmer_id)
    {
        $TypeTreatment = TypeTreatment::where('Farmer_id' , $Farmer_id)->get();
        return $this->sendResponse(TypeTreatmentResource::collection($TypeTreatment) , 'All TypeTreatment sent');

    }

    public function Disease($Disease_id)
    {
        $TypeTreatment = TypeTreatment::where('Disease_id' , $Disease_id)->get();
        return $this->sendResponse(TypeTreatmentResource::collection($TypeTreatment) , 'All TypeTreatment sent');

    }


    public function store(Request $request)
    {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'Name'   => 'required',
            'Farmer_id'   => 'required',
            'Disease_id'   => 'required',


        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

          $TypeTreatment = TypeTreatment::create($input);
          return $this->sendResponse(new TypeTreatmentResource($TypeTreatment), 'TypeTreatment create  successfully');
    }



    public function show($Treatment_ID)
    {
        $TypeTreatment = TypeTreatment::find($Treatment_ID);
        if(is_null($TypeTreatment)){

            return $this->sendError('TypeTreatment Not Found');

        }
        return $this->sendResponse(new TypeTreatmentResource($TypeTreatment), 'TypeTreatment Found  successfully');

    }


    public function update(Request $request, TypeTreatment $TypeTreatment)
     {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'Name'   => 'required',
            'Farmer_id'   => 'required',
            'Disease_id'   => 'required',


        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

       /*  if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $validator->errors());

        } */

         // first Crops_Name from database and second from user.
        $TypeTreatment->Name = $input['Name'];
        $TypeTreatment->Farmer_id = $input['Farmer_id'];
        $TypeTreatment->Disease_id = $input['Disease_id'];



        $TypeTreatment->save();
         return $this->sendResponse(new TypeTreatmentResource($TypeTreatment), 'TypeTreatment update  successfully');

    }


    public function destroy(TypeTreatment $TypeTreatment)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        $TypeTreatment->delete();
        return $this->sendResponse(new TypeTreatmentResource($TypeTreatment), 'TypeTreatment deleted  successfully');

    }

    public function deletetype_treatment($Treatment_ID)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        if($TypeTreatment = TypeTreatment::find($Treatment_ID)){
        $TypeTreatment->delete();
        return $this->sendResponse(new TypeTreatmentResource($TypeTreatment), 'TypeTreatment deleted  successfully');
    }
    else{
        return response()->json([
            'status' => 0,
            'msg' => 'fail'
        ]);
    }
    }

    public function updatetype_treatment(Request $request,   $Treatment_ID)
    {
        if($TypeTreatment = TypeTreatment::find($Treatment_ID)){
       $input = $request->all() ;
       $validator = Validator::make($input , [
           'Name'   => 'required',
           'Farmer_id'   => 'required',
           'Disease_id'   => 'required',


       ]) ;

       if($validator->fails()){

           return $this->sendError('please validate error' , $validator->errors());

       }
       /*  if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $validator->errors());

        } */

         // first Crops_Name from database and second from user.
         $TypeTreatment->Name = $input['Name'];
         $TypeTreatment->Farmer_id = $input['Farmer_id'];
         $TypeTreatment->Disease_id = $input['Disease_id'];



         $TypeTreatment->save();
          return $this->sendResponse(new TypeTreatmentResource($TypeTreatment), 'TypeTreatment update  successfully');
    }
    else{
        return response()->json([
            'status' => 0,
            'msg' => 'fail'
        ]);
    }
     }


}
