<?php

namespace App\Http\Controllers\Api;

use App\Models\Crop;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Validator;
use App\Http\Resources\Crop as CropResource;

use Auth;

class CropController extends Basecontroller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Crops = Crop::all();
        return $this->sendResponse(CropResource::collection($Crops) , 'All Crops sent');

    }

    public function Field($Field_id)
    {
        $Crops = Crop::where('Field_id' , $Field_id)->get();
        return $this->sendResponse(CropResource::collection($Crops) , 'All Crops sent');

    }

    public function store(Request $request)
    {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'Crops_Name'=> 'required',
            'Life_Cycle'=>'required',
            'Temp'=>'required' ,
            'Fertilisers'=> 'required',
            'Price'=>'required',
            'Type'=>'required' ,
            'Field_id'=>'required',
            'Disease_id'=>'required'

        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

          $Crop = Crop::create($input);
         return $this->sendResponse(new CropResource($Crop), 'Crop create  successfully');
    }


    public function show($Crops_Name)
    {
        $Crop = Crop::find($Crops_Name);
        if(is_null($Crop)){

            return $this->sendError('Crop Not Found');

        }
        return $this->sendResponse(new CropResource($Crop), 'Crop Found  successfully');

    }



    public function update(Request $request, Crop $crop)
    {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'Crops_Name' => 'required',
            'Life_Cycle' =>'required',
            'Temp' =>'required' ,
            'Fertilisers' => 'required',
            'Price' =>'required',
            'Type' =>'required' ,
            'Field_id' =>'required',
            'Disease_id' =>'required'

        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

       /*  if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $validator->errors());

        } */

         // first Crops_Name from database and second from user.
          $Crop->Crops_Name = $input['Crops_Name'];
          $Crop->Life_Cycle = $input['Life_Cycle'];
          $Crop->Temp = $input['Temp'];
          $Crop->Fertilisers = $input['Fertilisers'];
          $Crop->Price = $input['Price'];
          $Crop->Type = $input['Type'];
          $Crop->Field_id = $input['Field_id'];
          $Crop->Disease_id = $input['Disease_id'];

          $crop->save();
         return $this->sendResponse(new CropResource($Crop), 'Crop update  successfully');

    }


    public function destroy(Crop $Crop)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        $Crop->delete();
        return $this->sendResponse(new CropResource($Crop), 'Crop deleted  successfully');

    }
}
