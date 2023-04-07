<?php

namespace App\Http\Controllers\Api;

use App\Models\CartStorge;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Validator;
use App\Http\Resources\CartStorge as CartStorgeResource;


class CartStorgeController extends Basecontroller
{
    public function index()
    {
        $CartStorge = CartStorge::orderBy('id' , 'asc')->get();
        return $this->sendResponse(CartStorgeResource::collection($CartStorge) , 'All CartStorge sent');

    }

    public function Cart($Field_id)
    {
        $CartStorge = CartStorge::where('Field_id' , $Field_id)->get();
        return $this->sendResponse(CartStorgeResource::collection($CartStorge) , 'All CartStorge sent');

    }

    public function Storge($Farmer_id)
    {
        $CartStorge = CartStorge::where('Farmer_id' , $Farmer_id)->get();
        return $this->sendResponse(CartStorgeResource::collection($CartStorge) , 'All CartStorge sent');

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

          $CartStorge = CartStorge::create($input);
          return $this->sendResponse(new CartStorgeResource($CartStorge), 'CartStorge create  successfully');
    }



   public function show($id)
    {
        $CartStorge = CartStorge::find($id);
        if(is_null($CartStorge)){

            return $this->sendError('Farmer Not Found');

        }
        return $this->sendResponse(new CartStorgeResource($CartStorge), 'CartStorge Found  successfully');

    }


    public function update(Request $request, CartStorge $CartStorge)
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

       /*  if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $validator->errors());

        } */

         // first Crops_Name from database and second from user.
         $CartStorge->id = $input['id'];

        $CartStorge->Field_id = $input['Field_id'];
        $CartStorge->Farmer_id = $input['Farmer_id'];




        $CartStorge->save();
         return $this->sendResponse(new CartStorgeResource($CartStorge), 'CartStorge update  successfully');

    }


    public function destroy(CartStorge $Farmersoffield)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        $Farmersoffield->delete();
        return $this->sendResponse(new CartStorgeResource($Farmersoffield), 'CartStorge deleted  successfully');

    }
}
