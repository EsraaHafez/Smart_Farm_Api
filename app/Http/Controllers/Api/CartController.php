<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Validator;
use App\Http\Resources\Cart as CartResource;

use Auth;
class CartController extends Basecontroller
{
    public function index()
    {
        $Cart = Cart::all();
        return $this->sendResponse(CartResource::collection($Cart) , 'All Cart sent');

    }

    public function user($id)
    {
        $Cart = Cart::where('id' , $id)->get();
        return $this->sendResponse(CartResource::collection($Cart) , 'All Cart sent');

    }

    public function store(Request $request)
    {
         $Cart = new Cart();
         $input = $request->all() ;
         $validator = Validator::make($input , [
            'Name'=> 'required',
            'Image'=>'required',
            'Quantity'=>'required' ,
            'Price'=>'required',



        ]) ;



        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }


          $Cart = Cart::create($input);
         return $this->sendResponse(new CartResource($Cart), 'Cart create  successfully');
    }


    public function show($Cart_id )
    {
        $Cart = Cart::find($Cart_id );
        if(is_null($Cart)){

            return $this->sendError('Cart Not Found');

        }
        return $this->sendResponse(new CartResource($Cart), 'Cart Found  successfully');

    }



    public function update(Request $request, Cart $Cart)
    {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'Name'=> 'required',
            'Image'=>'required',
            'Quantity'=>'required' ,
            'Price'=>'required',

        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

       /*  if($Cart->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $validator->errors());

        } */

         // first Cart_Name from database and second from user.
          $Cart->Name = $input['Name'];
          $Cart->Image = $input['Image'];
          $Cart->Quantity = $input['Quantity'];
          $Cart->Price = $input['Price'];


          $Cart->save();
         return $this->sendResponse(new CartResource($Cart), 'Cart update  successfully');

    }


    public function destroy(Cart $Cart)
    {
      /*       $errorMessage = [] ;

            if($Cart->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        $Cart->delete();
        return $this->sendResponse(new CartResource($Cart), 'Cart deleted  successfully');

    }
}
