<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use JWTFactory;
use JWTAuth;
use Response;
class AuthController extends Basecontroller
{
        public function register(Request $request){

             $validator = Validator::make($request->all() , [
                'name' => 'required' ,
                'email' => 'required|email|string|max:255|unique:users' ,
                'password' => 'required' ,
                'c_password' => 'required|same:password'


            ]);

            if($validator->fails()){

                return $this->sendError('please validate error' , $validator->errors());

            }
              $input = $request->all();
              $input['password'] = Hash::make($input['password']);
              $user = User::create($input);
              //$success['token'] = $user->createToken('Esraa')->accessToken;
              $success['token'] = JWTAuth::fromUser($user);
              $success['name'] = $user->name;

             return $this->sendResponse($success  , 'User registered successfully');

        }
        public function Login(Request $request){

              if(Auth::attempt(['email' => $request->email , 'password' => $request->password])){

                $user = Auth::user();
                //$success['token'] = $user->createToken('Esraa')->accessToken;
                $success['token'] = JWTAuth::fromUser($user);
                $success['name'] = $user->name;
                return $this->sendResponse($success , 'User Login successfully');

              }

           else{

            return $this->sendError('please Check your Auth' , ['error' =>   'Unauthorised']);

           }

        }





}
