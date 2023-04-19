<?php

namespace App\Http\Controllers\Api;

use App\Models\Actor;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
//use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Response;


class ActorController extends Basecontroller
{

    public function register(Request $request){

        $validator = Validator::make($request->all() , [
           'Actor_Name' => 'required' ,
           'email' => 'required|email|string|max:255|unique:users' ,
           'Password' => 'required'


       ]);

       if($validator->fails()){

           return $this->sendError('please validate error' , $validator->errors());

       }
         $input = $request->all();
         $input['Password'] = Hash::make($input['Password']);
         $actor = Actor::create($input);
         $success['token'] = $actor->createToken('eman')->accessToken;
         $success['Actor_Name'] = $actor->Actor_Name;

        return $this->sendResponse($success  , 'actor registered successfully');

   }
/* public function Login(Request $request){

    if(Auth::guard('Actortapi')->attempt(['email' => $request->email , 'Password' => $request->Password])){
      $Actor = Auth::guard('Actortapi')->user();
      //$token = $Actor->createToken('eman', ['Actor'])->accessToken;
      $success['token'] = $Actor->createToken('eman')->accessToken;
      //$success['token'] = JWTAuth::fromUser($user);

       $success['Actor_Name'] = $Actor->Actor_Name;
       return $this->sendResponse($success , 'Actor Login successfully');
        //return response()->json(['token' => $token ]);

    }

 else{

  return $this->sendError('please Check your Auth' , ['error' =>   'Unauthorised']);

 }

} */



/* public function logout ()
{
    $tokenRepository = app('Laravel\Passport\TokenRepository');

    $Actor = auth('Actortapi')->user();

    if ($Actor) {
        $tokenRepository->revokeAccessToken($Actor->token()->Actor_Name);
        return 'logged out';
    } else {
        return 'already logged out';
    }
}

 */












}

/*
  public function login(Request $request)
  {
      //dd($req->all());
      $validator = Validator::make($request->all() , [
        'email' => 'required|email|string|max:255|unique:users' ,
        'Password' => 'required|max:30' ,

    ]);

    if($validator->fails()){

        return $this->sendError('please validate error' , $validator->errors());

    }
    if(Auth::guard('Actor')->attempt(['email' => $request->email , 'Password' => $request->Password])){

        $data = \Auth::guard('Actor')->user();
        dd($data);


    }
  }

    */

   /* public function Login(Request $request){


   $token = Auth::guard('Actortapi') -> attempt(['email' => $request->email , 'Password' => $request->Password]);
    if( !$token ){

        return $this->sendError('please Check your Auth' , ['error' =>   'Unauthorised']);


    }

 else{

   return $this->sendResponse($token  , 'actor registered successfully');

 }


} */
