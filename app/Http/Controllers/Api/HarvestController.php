<?php

namespace App\Http\Controllers\Api;

use App\Models\Harvest;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Validator;
use App\Http\Resources\Harvest as HarvestResource;


class HarvestController extends Basecontroller
{


    public function index()
    {
        $Harvest = Harvest::all();
        return $this->sendResponse(HarvestResource::collection($Harvest) , 'All Harvests sent');

    }
//////////////////////////////////////////////////////////////////////////////////////////////
    public function store1(Request $request)
    {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'Name'   => 'required',
            'Harvest_Date'   => 'required',
            'Price'   => 'required',
            'Type'   => 'required',
            'Quantity'   => 'required'

        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

          $Harvest = Harvest::create($input);
          return $this->sendResponse(new HarvestResource($Harvest), 'Harvest create  successfully');
    }
///////////////////////////////////////////////////////////////////////////////////////////
public function store(Request $request){

    if($request->Image != null){
      $ImgName = time() . $request->Image->getClientOriginalName();
      $profilePath = 'Harvest';
      $request->Image->move($profilePath, $ImgName);
      $Harvest = Harvest::create([
          "Name" => $request->Name ,
          "Harvest_Date" => $request->Harvest_Date ,
          "Price" => $request->Price,
          "Type" => $request->Type ,
          "Quantity" => $request->Quantity,
          "Image" => $ImgName]);
     }
      return $this->sendResponse(new HarvestResource($Harvest), 'Harvest create  successfully');

  }
///////////////////////////////////////////////////////////////////////////////////////
    public function show($Harvest_id)
    {
        $Harvest = Harvest::find($Harvest_id);
        if(is_null($Harvest)){

            return $this->sendError('Harvest Not Found');

        }
        return $this->sendResponse(new HarvestResource($Harvest), 'Harvest Found  successfully');

    }

    public function updateHarvestt(Request $request,   $Harvest_id)
    {
       if($Harvest = Harvest::find($Harvest_id)){
       $input = $request->all() ;
       $validator = Validator::make($input , [
           'Name'   => 'required',
           'Harvest_Date'   => 'required',
           'Price'   => 'required',
           'Type'   => 'required',
           'Quantity'   => 'required'

       ]) ;

       if($validator->fails()){

           return $this->sendError('please validate error' , $validator->errors());

       }

       /*  if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $validator->errors());

        } */

         // first Crops_Name from database and second from user.
         $Harvest->Name = $input['Name'];
         $Harvest->Harvest_Date = $input['Harvest_Date'];
         $Harvest->Price = $input['Price'];
         $Harvest->Type = $input['Type'];
         $Harvest->Quantity = $input['Quantity'];

         $Harvest->save();
          return $this->sendResponse(new HarvestResource($Harvest), 'Harvest update  successfully');
    }
    else{
        return response()->json([
            'status' => 0,
            'msg' => 'fail'
        ]);
    }
     }




    public function update(Request $request, Harvest $Harvest)
     {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'Name'   => 'required',
            'Harvest_Date'   => 'required',
            'Price'   => 'required',
            'Type'   => 'required',
            'Quantity'   => 'required'

        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

       /*  if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $validator->errors());

        } */

         // first Crops_Name from database and second from user.
        $Harvest->Name = $input['Name'];
        $Harvest->Harvest_Date = $input['Harvest_Date'];
        $Harvest->Price = $input['Price'];
        $Harvest->Type = $input['Type'];
        $Harvest->Quantity = $input['Quantity'];

        $Harvest->save();
         return $this->sendResponse(new HarvestResource($Harvest), 'Harvest update  successfully');

    }


    public function destroy(Harvest $Harvest)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        $Harvest->delete();
        return $this->sendResponse(new HarvestResource($Harvest), 'Harvest deleted  successfully');

    }

    public function deleteHarvest($Harvest_id)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        if($Harvest = Harvest::find($Harvest_id)){
        $Harvest->delete();
        return $this->sendResponse(new HarvestResource($Harvest), 'Harvest deleted  successfully');
    }
        else{
            return response()->json([
                'status' => 0,
                'msg' => 'fail'
            ]);
        }
    }

 //////////////////////////////////////////////////////////////////////////////////////
 public function updateHarvest(Request $request,    $Harvest_id)
{

 if($Harvest = Harvest::find($Harvest_id)){
    $input = $request->all() ;
    $validator = Validator::make($input , [
        'Name'   => 'required',
        'Harvest_Date'   => 'required',
        'Price'   => 'required',
        'Type'   => 'required',
        'Quantity'   => 'required',
        'Image' =>'required'


    ]) ;

    $Harvest = Harvest::where('Harvest_id' , $Harvest_id)->first();
    //dd($cart);
    if($validator->fails()){

        return $this->sendError('please validate error' , $validator->errors());

    }

        //photo name in request
if($request->Image  != ''){
    $path = public_path().'/Harvest/';

    //code for remove old file
    if($Harvest->Image != ''  && $Harvest->Image != null){
         $file_old = $path.$Harvest->Image;
         unlink($file_old);
    }
    $newphoto = $request->Image;
    $new_image_name = time().'.'.$newphoto->getClientOriginalName();
    $newphoto->move($path, $new_image_name);
    Harvest::where('Harvest_id',$Harvest_id)->update(array(
    'Image'=>$new_image_name
      ));
  }

         // first Cart_Name from database and second from user.
         $Harvest->Name = $input['Name'];
         $Harvest->Harvest_Date = $input['Harvest_Date'];
         $Harvest->Price = $input['Price'];
         $Harvest->Type = $input['Type'];
         $Harvest->Quantity = $input['Quantity'];
        // $Harvest->Image = $input['Image'];



         $Harvest->save();
         $Harvest = Harvest::where('Harvest_id' , $Harvest_id)->get('Image');
         print  $Harvest;
         //print   '"Image" -> ' . $new_image_name  ;
        //return $this->sendResponse(new CropResource($Crop),'Crop update  successfully');
        return response()->json([
            'status' => 1,
            'msg' => 'Harvest update  successfully'
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
