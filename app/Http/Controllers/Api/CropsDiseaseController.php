<?php

namespace App\Http\Controllers\Api;

use App\Models\CropsDisease;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Validator;
use App\Http\Resources\CropsDisease as CropsDiseaseResource;

class CropsDiseaseController extends Basecontroller
{
    public function index()
    {
        $CropsDisease = CropsDisease::orderBy('id' , 'asc')->get();
        return $this->sendResponse(CropsDiseaseResource::collection($CropsDisease) , 'All CropsDisease sent');

    }

    public function Crops($Crops_Name)
    {
        $CropsDisease = CropsDisease::where('Crops_Name' , $Crops_Name)->get();
        return $this->sendResponse(CropsDiseaseResource::collection($CropsDisease) , 'All CropsDisease sent');

    }


    public function store(Request $request)
    {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'id'   => 'required',
            'Crops_Name'   => 'required',
            'Disease'   => 'required',

        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

          $CropsDisease = CropsDisease::create($input);
          return $this->sendResponse(new CropsDiseaseResource($CropsDisease), 'CropsDisease create  successfully');
    }



    public function show($id)
    {
        $CropsDisease = CropsDisease::find($id);
        if(is_null($CropsDisease)){

            return $this->sendError('CropsDisease Not Found');

        }
        return $this->sendResponse(new CropsDiseaseResource($CropsDisease), 'CropsDisease Found  successfully');

    }


    public function update(Request $request, CropsDisease $CropsDisease)
     {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'Crops_Name'   => 'required',
            'Disease'   => 'required',


        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

       /*  if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $validator->errors());

        } */

         // first Crops_Name from database and second from user.
        $CropsDisease->Crops_Name = $input['Crops_Name'];
        $CropsDisease->Disease = $input['Disease'];




        $CropsDisease->save();
         return $this->sendResponse(new CropsDiseaseResource($CropsDisease), 'CropsDisease update  successfully');

    }


    public function destroy(CropsDisease $CropsDisease)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        $CropsDisease->delete();
        return $this->sendResponse(new CropsDiseaseResource($CropsDisease), 'CropsDisease deleted  successfully');

    }
}
