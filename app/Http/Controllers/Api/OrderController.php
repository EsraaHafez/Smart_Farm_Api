<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Validator;
use App\Http\Resources\Order as OrderResource;
use Auth;

class OrderController extends Basecontroller
{
    public function userOwn()
    {


        //$Order = Order::all();
        $Order = Order::where('id' , Auth::id())->get();
        return $this->sendResponse(OrderResource::collection($Order) , 'All Order sent');

    }

    public function AllOrder()
    {
        $Order = Order::all();
        return $this->sendResponse(OrderResource::collection($Order) , 'All Order sent');

    }


    public function user($id)
    {
        $Order = Order::where('id' , $id)->get();
        return $this->sendResponse(OrderResource::collection($Order) , 'All Order sent');

    }

    public function Cart($Cart_id)
    {
        $Order = Order::where('Cart_id' , $Cart_id)->get();
        return $this->sendResponse(OrderResource::collection($Order) , 'All Order sent');

    }


    public function store(Request $request)
    {
        $input = $request->all() ;
        $input['id'] =  Auth::User()->id;
        $validator = Validator::make($input , [
            //'Date'   => 'required|date',
            'Quantity'   => 'required',
            'Total_Price'   => 'required',
            'id'   => 'required',
            'Cart_id'   => 'required'


        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

          $Order = Order::create($input);
          return $this->sendResponse(new OrderResource($Order), 'Order create  successfully');
    }



      public function showorder($order_id)
    {
        $Order = Order::find($order_id);
        if(is_null($Order)){

            return $this->sendError('Order Not Found');

        }
        return $this->sendResponse(new OrderResource($Order), 'Order Found  successfully');

    }


    public function update(Request $request, Order $Order)
     {
        $input = $request->all() ;
        $input['id'] =  Auth::User()->id;
        $validator = Validator::make($input , [

            'Quantity'   => 'required',
            'Total_Price'   => 'required',
            'id'   => 'required',
            'Cart_id'   => 'required'


        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

         if($Order->id != Auth::id()){

            return $this->sendError('you dont have rights' , $validator->errors());

        }

         // first Crops_Name from database and second from user.

        $Order->Quantity = $input['Quantity'];
        $Order->Total_Price = $input['Total_Price'];
        $Order->id = $input['id'];
        $Order->Cart_id = $input['Cart_id'];



        $Order->save();
         return $this->sendResponse(new OrderResource($Order), 'Order update  successfully');

    }


    public function destroy(Order $Order)
    {
         $errorMessage = [] ;

            if($Order->id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        }
        $Order->delete();
        return $this->sendResponse(new OrderResource($Order), 'Order deleted  successfully');

    }
}
