<?php

namespace App\Http\Controllers\Api;

use App\Models\field;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Validator;
use App\Http\Resources\Field as FieldResource;

class FieldController extends Basecontroller
{

    public function index()
    {
          $fields = field::all();
        return $this->sendResponse(FieldResource::collection($fields) , 'All fields sent');

    }

    public function Harvest($Harvest_id)
    {
        $Fields = field::where('Harvest_id' , $Harvest_id )->get();
        return $this->sendResponse(FieldResource::collection($Fields) , 'All fields sent');

    }

    public function store(Request $request)
    {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'Name'   => 'required',
            'Last_Harvest_Date'  => 'required',
            'Harvest_id' => 'required' ,



        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

          $field = field::create($input);
         return $this->sendResponse(new FieldResource($field), 'field create  successfully');
    }


    public function show($id)
    {
        $field = field::find($id);
        if(is_null($field)){

            return $this->sendError('field Not Found');

        }
        return $this->sendResponse(new FieldResource($field), 'field Found  successfully');

    }



    public function update(Request $request, field $field)
    {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'Name'   => 'required',
            'Last_Harvest_Date'  => 'required',
            'Harvest_id' => 'required' ,

        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

       /*  if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $validator->errors());

        } */

         // first Crops_Name from database and second from user.
          $field->Name = $input['Name'];
          $field->Last_Harvest_Date = $input['Last_Harvest_Date'];
          $field->Harvest_id  = $input['Harvest_id'];


          $field->save();
         return $this->sendResponse(new FieldResource($field), 'field update  successfully');

    }


    public function destroy(field $field)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        $field->delete();
        return $this->sendResponse(new FieldResource($field), 'field deleted  successfully');

    }
}
