<?php

namespace App\Http\Controllers\Api;

use App\Models\Login;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Login as LoginResource;

class LoginController extends Basecontroller
{
    public function store(Request $request)
    {
        $input = $request->all() ;
        //$input['id'] =  Auth::User()->id;
        $validator = Validator::make($input , [

            'Name'   => 'required',
            'Password'   => 'required',

        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

          $Login = Login::create($input);
          return $this->sendResponse(new LoginResource($Login), 'Login create  successfully');
    }



}
