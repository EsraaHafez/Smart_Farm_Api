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

    public function Cart($Cart_id)
    {
        $CartStorge = CartStorge::where('Cart_id' , $Cart_id)->get();
        return $this->sendResponse(CartStorgeResource::collection($CartStorge) , 'All CartStorge sent');

    }

    public function Storge($Storge_id)
    {
        $CartStorge = CartStorge::where('Storge_id' , $Storge_id)->get();
        return $this->sendResponse(CartStorgeResource::collection($CartStorge) , 'All CartStorge sent');

    }


    public function store(Request $request)
    {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'id'   => 'required',
            'Cart_id'   => 'required',
            'Storge_id'   => 'required',


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

            return $this->sendError('CartStorge Not Found');

        }
        return $this->sendResponse(new CartStorgeResource($CartStorge), 'CartStorge Found  successfully');

    }


    public function update(Request $request, CartStorge $CartStorge)
     {
        $input = $request->all() ;
        $validator = Validator::make($input , [

            'Cart_id'   => 'required',
            'Storge_id'   => 'required',


        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

       /*  if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $validator->errors());

        } */

         // first Crops_Name from database and second from user.


        $CartStorge->Cart_id = $input['Cart_id'];
        $CartStorge->Storge_id = $input['Storge_id'];




        $CartStorge->save();
         return $this->sendResponse(new CartStorgeResource($CartStorge), 'CartStorge update  successfully');

    }


    public function destroy(CartStorge $CartStorge)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        $CartStorge->delete();
        return $this->sendResponse(new CartStorgeResource($CartStorge), 'CartStorge deleted  successfully');

    }
}
