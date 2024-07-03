<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
//use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Response;
use Illuminate\Support\Facades\Password;
use JWTFactory;
use JWTAuth;

class ActorController extends Basecontroller
{

    public function register(Request $request){

        $validator = Validator::make($request->all() , [
            'name' => 'required|min:3|max:50' ,
            'email' => 'required|email|string|max:255|unique:users' ,
            'password' => 'required|max:20|min:8' ,
            'Phone'   =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11',
            'c_password' => 'required|same:password'
       ]);

       if($validator->fails()){

           return $this->sendError('please validate error' , $validator->errors());

       }
         $input = $request->all();
         $input['password'] = Hash::make($input['password']);
         $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'c_password' => $request->c_password,
            'Phone' => $request->Phone,
            'Role' => 'Admin',

        ]);

         //$actor = User::create($input, $role);
         $success['token'] = $user->createToken('eman')->accessToken;
         //$success['token'] = JWTAuth::fromUser($actor);

         //$success['Actor_Name'] = $actor->Actor_Name;

        return $this->sendResponse($success  , 'actor registered successfully');

   }
//______________________________________________________
/*
   public function Login(Request $request){

    if(Auth::guard('Actorapi')->attempt(['email' => $request->email , 'Password' => $request->Password])){
      $Actor = Auth::guard('Actorapi')->Actor();
      //$token = $Actor->createToken('eman', ['Actor'])->accessToken;
      $success['token'] = $Actor->createToken('eman')->accessToken;
      //$success['token'] = JWTAuth::fromUser($Actor);
       $success['Actor_Name'] = $Actor->Actor_Name;
       return $this->sendResponse($success , 'Actor Login successfully');
        //return response()->json(['token' => $token ]);

    }

    else{

    return $this->sendError('please Check your Auth' , ['error' =>   'Unauthorised']);

    }

    }
*/
//______________________________________________________

        public function Loginm(Request $request){

              if(Auth::attempt(['email' => $request->email , 'password' => $request->password])){

                $user = Auth::user();
                $success['token'] = $user->createToken('eman')->accessToken;
                //$success['token'] = JWTAuth::fromUser($user);
                $success['name'] = $user->name;
                return $this->sendResponse($success , 'User Login successfully');

              }

           else{

            return $this->sendError('please Check your Auth' , ['error' =>   'Unauthorised']);

           }

        }

//___________________________________________________________

public function Login(Request $request)
{
     $email = $request->input('email');
     $password = $request->input('password');

     $user = User::where('email', '=', $email)->first();
     if (!$user) {
        return response()->json(['success'=>false, 'message' => 'Login Fail, please check email id']);
     }
     if (!Hash::check($password, $user->password)) {
        return response()->json(['success'=>false, 'message' => 'Login Fail, pls check password']);
     }
        $success['token'] = $user->createToken('eman')->accessToken;
        return response()->json(['success'=>true,'message'=>'User Login successfully', 'Token'=> $success]);
}

//______________________________________________________

public function logout ()
{
    $tokenRepository = app('Laravel\Passport\TokenRepository');

    $Actor = auth('Actor')->user();

    if ($Actor) {
        $tokenRepository->revokeAccessToken($Actor->token()->Actor_Name);
        return 'logged out';
    } else {
        return 'already logged out';
    }
}
}
////////////////////lastcode_on Hostinger/////////////////////////////////////////////////////////////////////////////////////////////
 /*
    public function login(Request $request)

    {
    if(Auth::attempt(['name' => $request->Name , 'password' => $request->Password])){

        $input = $request->all() ;
        //$m['id'] =  Auth::User()->id;
        //$userId =  Auth::user()->id;
       // $email = Auth::user()->name;
        //$email = Auth::user()->password;
        //$id = Auth::User()->getId($id);
        //$m['id'] = User::where('id' , Auth::id());

        $validator = Validator::make($input , [
            'Name'   => 'required',
            'Password'   => 'required',
            //'id'   => 'required',



        ]) ;



          $Login = Login::create($input);
          return $this->sendResponse(new LoginResource($Login), 'Login  successfully');
    }
    else{

        return $this->sendError('please Check your Auth' , ['error' =>   'Unauthorised']);

       }

}

public function login1(Request $request)

{
if(Auth::guard('Actor')->attempt(['Actor_Name' => $request->Name  , 'Password' => $request->Password])){

    $input = $request->all() ;
    $validator = Validator::make($input , [
        'Name'   => 'required',
        'Password'   => 'required',
        //'id'   => 'required',
    ]) ;
    $Login = Login::create($input);
    return $this->sendResponse(new LoginResource($Login), 'Login  successfully');
}
else{

  return $this->sendError('please Check your Auth' , ['error' =>   'Unauthorised']);

 }

}
*/


