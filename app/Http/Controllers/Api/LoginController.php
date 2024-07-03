<?php

namespace App\Http\Controllers\Api;

use App\Models\Login;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Auth;
use App\Http\Resources\Login as LoginResource;

class LoginController extends Basecontroller
{
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
}
