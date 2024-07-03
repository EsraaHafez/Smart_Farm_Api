<?php

namespace App\Http\Controllers\Api;

use App\Models\Users_Phone;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Validator;
use App\Http\Resources\Users_Phone as  Users_PhoneResource;
use App\Http\Resources\User_Phone as  User_PhoneResource;
use App\Http\Resources\UsersPhone_All as  UsersPhone_AllResource;

use Auth;
use App\Models\User;

class UsersPhoneController extends Basecontroller
{

    public function userPhone()
    {


        //$Order = Order::all();
        $Users_Phone = Users_Phone::where('id' , Auth::id())->get();
        return $this->sendResponse(User_PhoneResource::collection($Users_Phone) , 'All Users_Phone sent');

    }



    public function index()
    {
         $Users_Phone =  Users_Phone::all();
        //$Users_Phone = Users_Phone::orderBy('created_at' , 'DESC')->get();
        return $this->sendResponse(UsersPhone_AllResource::collection($Users_Phone) , 'All Users_Phone sent');

    }


     public function user($id)
    {
       // $Users_Phone = User::findOrFail('id' , Auth::User()->id);
       $Users_Phone = Users_Phone::where('id' , $id)->get();
        return $this->sendResponse(UsersPhone_AllResource::collection($Users_Phone) , 'All Users_Phone sent');

    }


    public function sendPhone(Request $request)
    {
        $input = $request->all() ;
        $input['id'] =  Auth::User()->id;
        $validator = Validator::make($input , [

            //'Phone'   => 'required|unique:phone_users',
            'Phone'   =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11',


        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

          $Users_Phone = Users_Phone::create($input);
          return $this->sendResponse(new User_PhoneResource($Users_Phone), 'Users_Phone create  successfully');
    }



       /* public function show($Phone)
    {
        //$Users_Phone = Users_Phone::find($phone_users_id);
        //$Users_Phone->id = $Users_Phone->User->id;
        //$id = Users_Phone::all();
        $Phone = Users_Phone::find($Phone)->all();
        if(is_null($Phone)){

            return $this->sendError('Actors_Phone Not Found');

        }
        return $this->sendResponse(new UsersPhone_AllResource($Phone), 'Users_Phone Found  successfully');

    } */

/*

    public function update( Request $request)
    {
        $Users_Phone = Users_Phone::first(); //missed line
        $Users_Phone->id = Auth::User()->id;
        $Users_Phone->Phone = $request['Phone'];

        $Users_Phone->save();

        return $this->sendResponse(new Users_PhoneResource($Users_Phone), 'Users_Phone update  successfully');
    }
 */




    public function updatephone(Request $request,$Phone)

    {
        /*  $errorMessage = [] ;
         if($Phone->id != Auth::id()){

        return $this->sendError('you dont have rights' , $errorMessage);

    } */
        if($Phone = Users_Phone::where('Phone', $Phone)->where('id' , Auth::id())->update($request->all()))
        {
        //return $this->sendResponse(new Users_PhoneResource($Phone),'Users_Phone update  successfully');
        return response()->json([
            'status' => 1,
            'msg' => 'your Phone update  successfully'
        ]);
    }

    else{
        return response()->json([
            'status' => 0,
            'msg' => 'fail'
        ]);
    }
    }






    public function delete( $Phone)
    {

        if($Phone = Users_Phone::where('Phone', $Phone)->where('id' , Auth::id())->delete())
        {
        //return $this->sendResponse(new Users_PhoneResource($Phone),'Users_Phone delete  successfully');
        return response()->json([
            'status' => 1,
            'msg' => 'Your Phone delete  Successfully'
        ]);

        }
        else{
            return response()->json([
                'status' => 0,
                'msg' => 'fail'
            ]);
        }
    }
}
