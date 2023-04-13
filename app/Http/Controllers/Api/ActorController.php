<?php

namespace App\Http\Controllers\Api;

use App\Models\Actor;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
//use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;
use Response;

class ActorController extends Basecontroller
{

    public function register(Request $request){

        $validator = Validator::make($request->all() , [
           'Actor_Name' => 'required' ,
           'email' => 'required|email|string|max:255|unique:users' ,
           'Password' => 'required|max:30' ,



       ]);

       if($validator->fails()){

           return $this->sendError('please validate error' , $validator->errors());

       }
       if(Auth::guard('actors')){

        $input = $request->all();
        $input['Password'] = Hash::make($input['Password']);
        $actor = Actor::create($input);
        $success['token'] = $actor->createToken('Esraa')->accessToken;
        //$success['token'] = JWTAuth::fromUser($user);
        $success['Actor_Name'] = $actor->Actor_Name;

       return $this->sendResponse($success  , 'Actor registered successfully');

       }


   }


  public function login(Request $request)
  {
      //dd($req->all());
      $validator = Validator::make($request->all() , [
        'Actor_Name' => 'required' ,
        'email' => 'required|email|string|max:255|unique:users' ,
        'Password' => 'required|max:30' ,



    ]);

    if($validator->fails()){

        return $this->sendError('please validate error' , $validator->errors());

    }
    if(Auth::guard('Actor')->attempt(['email' => $request->email , 'password' => $request->password])){

        $data = \Auth::guard('Actor')->user();
        dd($data);


    }
  }

}
