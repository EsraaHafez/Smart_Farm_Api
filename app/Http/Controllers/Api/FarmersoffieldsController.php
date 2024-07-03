<?php

namespace App\Http\Controllers\Api;

use App\Models\Farmersoffields;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Validator;
use App\Http\Resources\Farmersoffields as FarmersoffieldsResource;


class FarmersoffieldsController extends Basecontroller
{
    public function index()
    {
        $Farmersoffields = Farmersoffields::orderBy('id' , 'asc')->get();
        return $this->sendResponse(FarmersoffieldsResource::collection($Farmersoffields) , 'All Farmersoffields sent');

    }

    public function Field($Field_id)
    {
        $Farmersoffields = Farmersoffields::where('Field_id' , $Field_id)->get();
        return $this->sendResponse(FarmersoffieldsResource::collection($Farmersoffields) , 'All Farmersoffields sent');

    }

    public function Farmer($Farmer_id)
    {
        $Farmersoffields = Farmersoffields::where('Farmer_id' , $Farmer_id)->get();
        return $this->sendResponse(FarmersoffieldsResource::collection($Farmersoffields) , 'All Farmersoffields sent');

    }


    public function store(Request $request)
    {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'id'   => 'required',
            'Field_id'   => 'required',
            'Farmer_id'   => 'required',


        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

          $Farmersoffields = Farmersoffields::create($input);
          return $this->sendResponse(new FarmersoffieldsResource($Farmersoffields), 'Farmersoffields create  successfully');
    }



   public function show($id)
    {
        $Farmersoffields = Farmersoffields::find($id);
        if(is_null($Farmersoffields)){

            return $this->sendError('Farmersoffield Not Found');

        }
        return $this->sendResponse(new FarmersoffieldsResource($Farmersoffields), 'Farmersoffields Found  successfully');

    }


    public function update(Request $request, Farmersoffields $Farmersoffield)
     {
        $input = $request->all() ;
        $validator = Validator::make($input , [

            'Field_id'   => 'required',
            'Farmer_id'   => 'required',


        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

       /*  if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $validator->errors());

        } */

         // first Crops_Name from database and second from user.

        $Farmersoffield->Field_id = $input['Field_id'];
        $Farmersoffield->Farmer_id = $input['Farmer_id'];




        $Farmersoffield->save();
         return $this->sendResponse(new FarmersoffieldsResource($Farmersoffield), 'Farmersoffields update  successfully');

    }


    public function destroy(Farmersoffields $Farmersoffield)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        $Farmersoffield->delete();
        return $this->sendResponse(new FarmersoffieldsResource($Farmersoffield), 'Farmersoffields deleted  successfully');

    }

    public function deleteFarmersoffield($id)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        if($Farmersoffield = Farmersoffields::find($id)){
        $Farmersoffield->delete();
        return $this->sendResponse(new FarmersoffieldsResource($Farmersoffield), 'FarmersoffieldsResource deleted  successfully');
    }
    else{
        return response()->json([
            'status' => 0,
            'msg' => 'fail'
        ]);
    }
    }


    public function updateFarmersoffield(Request $request,   $id)
     {
        if($Farmersoffield = Farmersoffields::find($id)){
        $input = $request->all() ;
        $validator = Validator::make($input , [

            'Field_id'   => 'required',
            'Farmer_id'   => 'required',


        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

       /*  if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $validator->errors());

        } */

        // first Crops_Name from database and second from user.
        $Farmersoffield->Field_id = $input['Field_id'];
        $Farmersoffield->Farmer_id = $input['Farmer_id'];


        $Farmersoffield->save();
         return $this->sendResponse(new FarmersoffieldsResource($Farmersoffield), 'Farmersoffields update  successfully');
    }
    else{
        return response()->json([
            'status' => 0,
            'msg' => 'fail'
        ]);
    }
    }
}
