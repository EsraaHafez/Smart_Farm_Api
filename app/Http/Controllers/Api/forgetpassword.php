<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\forgetpasswordrequest ;
use App\Notifications\ResetNotification ;
use App\Http\Controllers\Controller ;


class forgetpassword extends Controller
{
    //
    public function forgotpassword(Request $request){

        $input = $request->only('email');
        if($user = User::where('email' , $input)->first()){
        $user->notify(new ResetNotification());
       // $success['success'] = true ;
       // return response()->json($success , 200 );

        return response()->json([
            'success' => true,
            'message' => 'Please verify your email'
            ]);

}
    else{

                return response()->json([

                    'status' => 404,
                    'message' => "this User Email not Exist",

                ]);
}



    }
}
