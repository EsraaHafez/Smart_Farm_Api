<?php

namespace App\Http\Controllers\Api;

use App\Models\Users_Phone;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Validator;
use App\Http\Resources\Users_Phone as  Users_PhoneResource;
use Auth;
use App\Models\User;

class UsersPhoneController extends Basecontroller
{
    public function index()
    {
        //$Users_Phone =  Users_Phone::all();
        $Users_Phone = Users_Phone::orderBy('created_at' , 'DESC')->get();
        return $this->sendResponse(Users_PhoneResource::collection($Users_Phone) , 'All Users_Phone sent');

    }


     public function user($id)
    {
        $Users_Phone = User::findOrFail('id' , Auth::User()->id);
        return $this->sendResponse(Users_PhoneResource::collection($Users_Phone) , 'All Users_Phone sent');

    }


    public function store(Request $request)
    {
        $input = $request->all() ;
        $input['id'] =  Auth::User()->id;
        $validator = Validator::make($input , [

            'Phone'   => 'required|unique:phone_users',


        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

          $Users_Phone = Users_Phone::create($input);
          return $this->sendResponse(new Users_PhoneResource($Users_Phone), 'Users_Phone create  successfully');
    }



      public function show($id)
    {
        //$Users_Phone = Users_Phone::find($phone_users_id);
        //$Users_Phone->id = $Users_Phone->User->id;
        $Users_Phone = auth()->User();
         if(is_null($Users_Phone)){

            return $this->sendError('Users_Phone Not Found');

        }
        return $this->sendResponse(new Users_PhoneResource($Users_Phone), 'Users_Phone Found  successfully');

    }


    public function update(Request $request,  Users_Phone $Phone)
     {
        $input = $request->all() ;
        $input['id'] =  Auth::User()->id;
        $validator = Validator::make($input , [

           'id'   => 'required',
            'Phone'   => 'required',


        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }
         // first Crops_Name from database and second from user.
        $Phone->id = $input['id'];
        $Phone->Phone = $input['Phone'];

        $Phone->save();
         return $this->sendResponse(new Users_PhoneResource($Phone), 'Users_Phone update  successfully');

    }


    public function destroy( Users_Phone $Phone)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */

        $Phone->delete($Phone);
        return $this->sendResponse(new Users_PhoneResource($Phone, 'Phone'), 'Users_Phones deleted  successfully');

    }
}
