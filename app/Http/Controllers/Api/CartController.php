<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Validator;
use App\Http\Resources\Cart as CartResource;
use App\Http\Resources\CartUser as CartUserResource;
use App\Http\Resources\CartUpdateUser as CartUpdateUserResource;

use User;
use Auth;
class CartController extends Basecontroller
{

    public function userCart()
    {


        //$Order = Order::all();
        $Cart = Cart::where('id' , Auth::id())->get();
        return $this->sendResponse(CartResource::collection($Cart) , 'All Cart sent');

    }

    public function index()
    {
        $Cart = Cart::all();
        return $this->sendResponse(CartUserResource::collection($Cart) , 'All Cart sent');

    }

    public function user($id)
    {
        $Cart = Cart::where('id' , $id)->get();
        return $this->sendResponse(CartUserResource::collection($Cart) , 'All Cart sent');

    }
    // ______________________________________________________________________________

    public function store1(Request $request)
    {
         $input = $request->all() ;
         $input['id'] =  Auth::User()->id;
        $input['Image'] = $request->file('Image')->store('Carts');
        $validator = Validator::make($input , [
           'Name'=> 'required',
           'Image'=>'required|max:2047',
           'Quantity'=>'required' ,
           'Price'=>'required',
           'id'   => 'required'


        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

        $Cart = Cart::create($input , $input['Image']);
        return $this->sendResponse(new CartResource($Cart), 'Cart create  successfully');
    }
// ______________________________________________________________________________

public function store(Request $request){

    $id =  Auth::User()->id;
    if($request->Image != null){
    $ImgName = time() . $request->Image->getClientOriginalName();
    $profilePath = 'Carts';
    $request->Image->move($profilePath, $ImgName);
    $Cart = Cart::create([
        "Name" => $request->Name ,
        "Quantity" => $request->Quantity ,
        "Total_Price" => $request->Total_Price,
        "id" => $id ,
        "Image" => $ImgName]);
   }
   return $this->sendResponse(new CartResource($Cart), 'Cart successfully added');

}

// ______________________________________________________________________________
    public function show($Cart_id)
    {
        $Cart = Cart::find($Cart_id );
        if(is_null($Cart)){

            return $this->sendError('Cart Not Found');

        }
        return $this->sendResponse(new CartUserResource($Cart), 'Cart Found  successfully');

    }


//______________________fact_update__________________________________________________________

    public function updateCart(Request $request,   $Cart_id)
    {
        $input = $request->all() ;
       // $input['id'] =  Auth::User()->id;
        $id =  Auth::User()->id;
        $validator = Validator::make($input , [
            'Name'=> 'required',
            'Image'=>'required',
            'Quantity'=>'required' ,
            'Total Price'=>'required',
            //'id'   => 'required'

        ]) ;

        $cart = Cart::where('Cart_id',$Cart_id )->first();
        //dd($cart);
        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

     // if($Cart_id->id != Auth::id()){
     if($cart->id != $id){

            return $this->sendError('you dont have rights' , $validator->errors());

        }
        //photo name in request
if($request->Image  != ''){
    $path = public_path().'/Carts/';

    //code for remove old file
    if($cart ->Image != ''  && $cart->Image != null){
         $file_old = $path.$cart->Image;
         unlink($file_old);
    }
    $newphoto = $request->Image;
    $new_image_name = time().'.'.$newphoto->getClientOriginalName();
    $newphoto->move($path, $new_image_name);
     Cart::where('id',$id)->update(array(
    'Image'=>$new_image_name
      ));
  }

         // first Cart_Name from database and second from user.
          $cart->Name = $input['Name'];
          //$cart->Image = $input['Image'];
          $cart->Quantity = $input['Quantity'];
          $cart->Total_Price = $input['Total_Price'];
          //$cart->id = $input['id'];


          $cart->save();
          $Cart = Cart::where('Cart_id' , $Cart_id)->get('Image');
          print  $Cart;
          //print   '"Image" -> ' . $new_image_name  ;
         return $this->sendResponse(new CartUpdateUserResource($cart),'Cart update  successfully');
     }
 //___________________________________________________________________________________

    public function delete(Cart $Cart_id)
    {
             $errorMessage = [] ;

            if($Cart_id->id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        }
        $Cart_id->delete();
        return $this->sendResponse(new CartResource($Cart_id), 'Cart deleted  successfully');

    }
}
