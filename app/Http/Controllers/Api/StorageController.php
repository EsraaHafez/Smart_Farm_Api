<?php

namespace App\Http\Controllers\Api;

use App\Models\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Validator;
use App\Http\Resources\Storage as StorageResource;

class StorageController extends Basecontroller
{

    public function index()
    {
        $Storage = Storage::all();
        return $this->sendResponse(StorageResource::collection($Storage) , 'All Storages sent');

    }

    public function store(Request $request)
    {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'Size'   => 'required',
            'Availability'   => 'required'

        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

          $Storage = Storage::create($input);
          return $this->sendResponse(new StorageResource($Storage), 'Storage create  successfully');
    }



    public function show($Storge_id)
    {
        $Storage = Storage::find($Storge_id);
        if(is_null($Storage)){

            return $this->sendError('Storage Not Found');

        }
        return $this->sendResponse(new StorageResource($Storage), 'Storage Found  successfully');

    }

    public function updateStorage(Request $request,   $Storge_id)
    {
       if($Storage = Storage::find($Storge_id)){
       $input = $request->all() ;
       $validator = Validator::make($input , [
           'Size'   => 'required',
           'Availability'   => 'required'

       ]) ;

       if($validator->fails()){

           return $this->sendError('please validate error' , $validator->errors());

       }

      /*  if($crop->user_id != Auth::id()){

           return $this->sendError('you dont have rights' , $validator->errors());

       } */

        // first Crops_Name from database and second from user.
       $Storage->Size = $input['Size'];
       $Storage->Availability = $input['Availability'];

       $Storage->save();
       return $this->sendResponse(new StorageResource($Storage), 'Storage update  successfully');
    }
    else{
        return response()->json([
            'status' => 0,
            'msg' => 'fail'
        ]);
    }
  }


    public function update(Request $request, Storage $Storage)
     {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'Size'   => 'required',
            'Availability'   => 'required'

        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

       /*  if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $validator->errors());

        } */

         // first Crops_Name from database and second from user.
        $Storage->Size = $input['Size'];
        $Storage->Availability = $input['Availability'];


        $Storage->save();
         return $this->sendResponse(new StorageResource($Storage), 'Storage update  successfully');

    }


    public function destroy(Storage $Storage)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        $Storage->delete();
        return $this->sendResponse(new StorageResource($Storage), 'Storage deleted  successfully');

    }

    public function deleteStorage($Storge_id)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        if($Storage = Storage::find($Storge_id)){
        $Storage->delete();
        return $this->sendResponse(new StorageResource($Storage), 'Storage deleted  successfully');
    }
    else{
        return response()->json([
            'status' => 0,
            'msg' => 'fail'
        ]);
    }
    }


}
