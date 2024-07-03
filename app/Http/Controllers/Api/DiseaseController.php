<?php

namespace App\Http\Controllers\Api;

use App\Models\Disease;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Validator;
use App\Http\Resources\Disease as DiseaseResource;

class DiseaseController extends Basecontroller
{

    public function index()
    {
        $Disease = Disease::all();
        return $this->sendResponse(DiseaseResource::collection($Disease) , 'All Diseases sent');

    }

    public function store(Request $request)
    {
        $input = $request->all() ;
        $validator = Validator::make($input , [


            'Name'   => 'required'

        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

          $Disease = Disease::create($input);
          return $this->sendResponse(new DiseaseResource($Disease), 'Disease create  successfully');
    }



    public function show($Disease_id)
    {
        $Disease = Disease::find($Disease_id);
        if(is_null($Disease)){

            return $this->sendError('Disease Not Found');

        }
        return $this->sendResponse(new DiseaseResource($Disease), 'Disease Found  successfully');

    }

    public function updateDisease(Request $request,   $Disease_id)
     {
        if($Disease = Disease::find($Disease_id)){
        $input = $request->all() ;
        $validator = Validator::make($input , [


            'Name'   => 'required'


        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

       /*  if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $validator->errors());

        } */

         // first Crops_Name from database and second from user.
         $Disease->Name = $input['Name'];

         $Disease->save();
          return $this->sendResponse(new DiseaseResource($Disease), 'Disease update  successfully');

    }
    else{
        return response()->json([
            'status' => 0,
            'msg' => 'fail'
        ]);
    }
     }


    public function update(Request $request, Disease $Disease)
     {
        $input = $request->all() ;
        $validator = Validator::make($input , [


            'Name'   => 'required'


        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

       /*  if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $validator->errors());

        } */

         // first Crops_Name from database and second from user.
        $Disease->Name = $input['Name'];

        $Disease->save();
         return $this->sendResponse(new DiseaseResource($Disease), 'Disease update  successfully');

    }


    public function destroy(Disease $Disease)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        $Disease->delete();
        return $this->sendResponse(new DiseaseResource($Disease), 'Disease deleted  successfully');

    }

    public function deleteDisease($Disease_id)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        if($Disease = Disease::find($Disease_id)){
        $Disease->delete();
        return $this->sendResponse(new DiseaseResource($Disease), 'Disease deleted  successfully');
        }

        else{
            return response()->json([
                'status' => 0,
                'msg' => 'fail'
            ]);
        }
    }

}
