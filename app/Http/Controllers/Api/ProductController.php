<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use Validator;
use App\Http\Resources\Product as ProductResource;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
//use App\Http\Controllers\Controller;



class ProductController extends Basecontroller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return $this->sendResponse(ProductResource::collection($products) , 'All products sent');

    }

     // create()::need to view and blade.



    public function store(Request $request)
    {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'name'=> 'required',
            'detail'=>'required',
            'price'=>'required'

        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

          $product = Product::create( $input);
         return $this->sendResponse(new ProductResource($product), 'product create  successfully');

    }


    public function show($id)
    {
        $products = Product::find($id);
        if(is_null($products)){

            return $this->sendError('product Not Found');

        }
        return $this->sendResponse(new ProductResource($product), 'product Found  successfully');

    }



    public function update(Request $request, Product $product)
    {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'name'=> 'required',
            'detail'=>'required',
            'price'=>'required'

        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }
           // first name from database and second from user
          $product->name = $input['name'];
          $product->detail = $input['detail'];
          $product->price = $input['price'];
          $product->save();
         return $this->sendResponse(new ProductResource($product), 'product update  successfully');

    }


    public function destroy(Product $product)
    {
        $product->delete();
        return $this->sendResponse(new ProductResource($product), 'product deleted  successfully');

    }
}
