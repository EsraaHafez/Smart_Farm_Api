<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\resetpasswordrequest ;
use App\Notifications\ResetNotification ;
use App\Http\Controllers\Controller ;
use Otp;
use Hash;
use Illuminate\Support\Facades\Validator;


class resetpassword extends Controller
{
    //
    private $Otp;

    public function __construct(){

        $this->Otp = new  Otp;


    }


    public function passwordReset(Request $request){

         $otp2 = $this->Otp->validate($request->email , $request->Otp);
         if(! $otp2->status){

          return response()->json(['error' => $otp2] , 401);

         }

         $user = User::where('email' , $request->email)->first();
         $user->update(['password' => Hash::make( $request->password)]);
         $user->tokens()->delete();
         //$success['success'] = true;
         //return response()->json($success , 200);
         return response()->json([
            'success' => true,
            'message' => 'PASSWORD HAS BEEN RESET'
            ]);


    }
}
