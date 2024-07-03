<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Illuminate\Support\Facades\Validator;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use JWTFactory;
use JWTAuth;
use Response;
use Mail;
use Illuminate\Support\Facades\Password;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use App\Http\Resources\User as UserResource;
use App\Notifications\ResetNotification ;
use App\Mail\MailNotify;


class AuthController extends Basecontroller
{
    public function All_Users()
    {
        $User = User::all();
        return $this->sendResponse(UserResource::collection($User) , 'All Users sent');

    }
    public function User($id)
    {
        $User = User::find($id);
        if(is_null($User)){

            return $this->sendError('User Not Found');

        }
        return $this->sendResponse(new UserResource($User), 'User Found  successfully');

    }
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
              $user = User::create($input);
              $success['token'] = $user->createToken('Esraa')->accessToken;
              //$success['token'] = JWTAuth::fromUser($user);
              $success['name'] = $user->name;

             return $this->sendResponse($success  , 'User registered successfully');

        }
        public function Login(Request $request){

              if(Auth::attempt(['email' => $request->email , 'password' => $request->password])){

                $user = Auth::user();
                $success['token'] = $user->createToken('Esraa')->accessToken;
                //$success['token'] = JWTAuth::fromUser($user);
                $success['name'] = $user->name;
                return $this->sendResponse($success , 'User Login successfully');

              }

           else{

            return $this->sendError('please Check your Auth' , ['error' =>   'Unauthorised']);

           }

        }

         public function logout ()
    {
        $tokenRepository = app('Laravel\Passport\TokenRepository');

        $user = auth('api')->user();

        if ($user) {
            $tokenRepository->revokeAccessToken($user->token()->id);
            return 'logged out';
        } else {
            return 'already logged out';
        }
    }

  /*
    public function logout ()
    {

        Auth::logout();
        return   response()->json([
         'message' => 'User Logged out successfully'

        ]);


     }
*/

/*
    public function forgot_Password(Request $request){
        $input = $request->only('email');
        $validator = Validator::make($input, [
            'email' => "required|email"
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $response = Password::sendResetLink($input);

        $message = $response == Password::RESET_LINK_SENT ? 'Mail send successfully' : GLOBAL_SOMETHING_WANTS_TO_WRONG;

        return response()->json($message);
    } */

/*     public function passwordReset(Request $request){
        $input = $request->only('email','token', 'password', 'password_confirmation');
        $validator = Validator::make($input, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $response = Password::reset($input, function ($user, $password) {
            $user->password = Hash::make($password);
            $user->save();
        });
        $message = $response == Password::PASSWORD_RESET ? 'Password reset successfully' : GLOBAL_SOMETHING_WANTS_TO_WRONG;
        return response()->json($message);
    } */



    public function changePassword(Request $request){

        $randomId = rand(4,5000) ;
        $useremail = $request->email ;
        $data = [

            'subject' => "SmART Farming System",
            'body' =>  "SFS_".$randomId,
        ];
        if(User::where('email' , $useremail)->exists()){

            Mail::to($useremail)->send(new  MailNotify($data));
            $newpass = User::where('email' , "=" ,  $useremail)->first();
            if($newpass){

                $newpass->update([

                    'password' => Hash::make($data['body']),
                ]);

                     return response()->json([

                    'status' => 200,
                    'message' => "Password  sent successfully  . Please verify your email ",
                    //'data'   => $newpass




                ]);



            }
        }

            else{

                return response()->json([

                    'status' => 404,
                    'message' => "this User Email not Exist",
                    'data'   => null




                ]);

            }


    }
}

