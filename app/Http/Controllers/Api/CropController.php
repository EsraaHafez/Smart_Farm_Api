<?php

namespace App\Http\Controllers\Api;

use App\Models\Crop;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Basecontroller as Basecontroller;
use Validator;
use App\Http\Resources\Crop as CropResource;

use Auth;

class CropController extends Basecontroller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Crops = Crop::all();
        return $this->sendResponse(CropResource::collection($Crops) , 'All Crops sent');

    }

    public function Field($Field_id)
    {
        $Crops = Crop::where('Field_id' , $Field_id)->get();
        return $this->sendResponse(CropResource::collection($Crops) , 'All Crops sent');

    }

    public function store1(Request $request)
    {
         $input = $request->all() ;
         //$input['Image'] =  $request->file('Image')->store('storage/app/Crops');
         if($request->Image != null){
            $ImgName = time() . $request->Image->getClientOriginalName();
            $profilePath = 'images';
            $request->Image->move($profilePath, $ImgName);
            Crop::query()->update(["Image" => $ImgName]);
           };
         $validator = Validator::make($input , [
            'Crops_Name'=> 'required',
            'Life_Cycle'=>'required',
            'Temp'=>'required' ,
            'Fertilisers'=> 'required',
            'Water'=>'required',
            'Type'=>'required' ,
            'Image'  =>'required|max:2047',
            //'Image'  =>'required|max:2047|mimes:jpeg,png,jpg,gif,svg',
            'Field_id'=>'required',
            'Disease_id'=>'required',

        ]) ;

        /*  $Crops = new Crop();
        $Crops->Image = $request->file->hashName();  */

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }
          //$Crop = Crop::create($input , $input['Image']);
          $Crop = Crop::create($input);
          return $this->sendResponse(new CropResource($Crop), 'Crop create  successfully');
    }

/////////////store////////////////////

public function store(Request $request){

  if($request->Image != null){
    $ImgName = time() . $request->Image->getClientOriginalName();
    $profilePath = 'Crops';
    $request->Image->move($profilePath, $ImgName);
    $Crop = Crop::create([
        "Crops_Name" => $request->Crops_Name ,
        "Life_Cycle" => $request->Life_Cycle ,
        "Temp" => $request->Temp,
        "Fertilisers" => $request->Fertilisers ,
        "Water" => $request->Water,
        "Type" => $request->Type ,
        "Field_id" => $request->Field_id,
        "Disease_id" => $request->Disease_id ,
        "Image" => $ImgName]);
   }
    return $this->sendResponse(new CropResource($Crop), 'Crop create  successfully');

}
    ////////////////////////////////////////
    public function show($Crops_Name)
    {
        $Crop = Crop::find($Crops_Name);
        if(is_null($Crop)){

            return $this->sendError('Crop Not Found');

        }
        return $this->sendResponse(new CropResource($Crop), 'Crop Found  successfully');

    }

    public function updatecrnops(Request $request,   $Crops_Name)
    {

        if($Crop = Crop::find($Crops_Name)){

        $input = $request->all() ;
        $validator = Validator::make($input , [
            'Crops_Name' => 'required',
            'Life_Cycle' =>'required',
            'Temp' =>'required' ,
            'Fertilisers' => 'required',
            'Water' =>'required',
            'Type' =>'required' ,
            'Image' =>'required' ,
            'Field_id' =>'required',
            'Disease_id' =>'required'

        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

       /*  if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $validator->errors());

        } */




         // first Crops_Name from database and second from user.
          $Crop->Crops_Name = $input['Crops_Name'];
          $Crop->Life_Cycle = $input['Life_Cycle'];
          $Crop->Temp = $input['Temp'];
          $Crop->Fertilisers = $input['Fertilisers'];
          $Crop->Water = $input['Water'];
          $Crop->Type = $input['Type'];
          $Crop->Image = $input['Image'];
          $Crop->Field_id = $input['Field_id'];
          $Crop->Disease_id = $input['Disease_id'];


          $Crop->save();
         return $this->sendResponse(new CropResource($Crop), 'Crop update  successfully');
    }

    else{
        return response()->json([
            'status' => 0,
            'msg' => 'fail'
        ]);
    }



    }
//___________fact_update_______________________________________________________________________
    public function updatecrops1(Request $request,   $Crops_Name)
    {
          if($Crop = Crop::find($Crops_Name)){

        $input = $request->all() ;
        $validator = Validator::make($input , [
            'Crops_Name' => 'required',
            'Life_Cycle' =>'required',
            'Temp' =>'required' ,
            'Fertilisers' => 'required',
            'Water' =>'required',
            'Type' =>'required' ,
            'Image' =>'required' ,
            'Field_id' =>'required',
            'Disease_id' =>'required'

        ]) ;

        $Crop->Crops_Name = $request->Crops_Name;
        $Crop->Life_Cycle = $request->Life_Cycle;
        $Crop->Temp = $request->Temp;
        $Crop->Fertilisers = $request->Fertilisers;
        $Crop->Water = $request->Water;
        $Crop->Type = $request->Type;
        $Crop->Field_id = $request->Field_id;
        $Crop->Disease_id = $request->Disease_id;
        $Crop->Image = $request->Image;




        if($request->has('Image')) {
            $Image = $request->file('Image');
            $filename =  time() . $request->Image->getClientOriginalName();
            $Image->move(public_path('Crops'), $filename);
            $Crop->Image = $request->file('Image')->getClientOriginalName();
        }

        $Crop->update();

        return $this->sendResponse(new CropResource($Crop), 'Crop update  successfully');
    }

    else{
        return response()->json([
            'status' => 0,
            'msg' => 'fail'
        ]);
    }
    }
//____________________________________________________________________________________
    public function update(Request $request, Crop $Crop)
    {
        $input = $request->all() ;
        $validator = Validator::make($input , [
            'Crops_Name' => 'required',
            'Life_Cycle' =>'required',
            'Temp' =>'required' ,
            'Fertilisers' => 'required',
            'Water' =>'required',
            'Type' =>'required' ,
            'Image' =>'required' ,
            'Field_id' =>'required',
            'Disease_id' =>'required'

        ]) ;

        if($validator->fails()){

            return $this->sendError('please validate error' , $validator->errors());

        }

       /*  if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $validator->errors());

        } */

         // first Crops_Name from database and second from user.
          $Crop->Crops_Name = $input['Crops_Name'];
          $Crop->Life_Cycle = $input['Life_Cycle'];
          $Crop->Temp = $input['Temp'];
          $Crop->Fertilisers = $input['Fertilisers'];
          $Crop->Water = $input['Water'];
          $Crop->Type = $input['Type'];
          $Crop->Image = $input['Image'];
          $Crop->Field_id = $input['Field_id'];
          $Crop->Disease_id = $input['Disease_id'];

          $Crop->save();
         return $this->sendResponse(new CropResource($Crop), 'Crop update  successfully');

    }


    public function destroy(Crop $Crop)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        $Crop->delete();
        return $this->sendResponse(new CropResource($Crop), 'Crop deleted  successfully');

    }


    public function deleteCrops($Crops_Name)
    {
      /*       $errorMessage = [] ;

            if($crop->user_id != Auth::id()){

            return $this->sendError('you dont have rights' , $errorMessage);

        } */
        if($Crop = Crop::find($Crops_Name)){
        $Crop->delete();
        return $this->sendResponse(new CropResource($Crop), 'Crop deleted  successfully');
        }
        else{
            return response()->json([
                'status' => 0,
                'msg' => 'fail'
            ]);
        }



    }



 //get image

 public function get_image($Crops_Name)
 {
   // $Crop = Crop::find('Image')->where('Crops_Name' , $Crops_Name);
     $Crop = Crop::where('Crops_Name' , $Crops_Name)->get('Image');
     if(is_null($Crops_Name)){

         return $this->sendError('this Crop Not Found to display Image');

     }
     return ($Crop);

 }


/////////////////////////////////////////////////////////////////////////////
public function updatecrops(Request $request,    $Crops_Name)
{

    if($Crop = Crop::find($Crops_Name)){

    $input = $request->all() ;
    $validator = Validator::make($input , [
        'Crops_Name' => 'required',
        'Life_Cycle' =>'required',
        'Temp' =>'required' ,
        'Fertilisers' => 'required',
        'Water' =>'required',
        'Type' =>'required' ,
        'Image' =>'required' ,
        'Field_id' =>'required',
        'Disease_id' =>'required'


    ]) ;

    $Crop = Crop::where('Crops_Name' , $Crops_Name)->first();
    //dd($cart);
    if($validator->fails()){

        return $this->sendError('please validate error' , $validator->errors());

    }

        //photo name in request
if($request->Image  != ''){
    $path = public_path().'/Crops/';

    //code for remove old file
    if($Crop->Image != ''  && $Crop->Image != null){
         $file_old = $path.$Crop->Image;
         unlink($file_old);
    }
    $newphoto = $request->Image;
    $new_image_name = time().'.'.$newphoto->getClientOriginalName();
    $newphoto->move($path, $new_image_name);
    Crop::where('Crops_Name',$Crops_Name)->update(array(
    'Image'=>$new_image_name
      ));
  }

         // first Cart_Name from database and second from user.
    $Crop->Crops_Name = $input['Crops_Name'];
    $Crop->Life_Cycle = $input['Life_Cycle'];
    $Crop->Temp = $input['Temp'];
    $Crop->Fertilisers = $input['Fertilisers'];
    $Crop->Water = $input['Water'];
    $Crop->Type = $input['Type'];
   // $Crop->Image = $input['Image'];
    $Crop->Field_id = $input['Field_id'];
    $Crop->Disease_id = $input['Disease_id'];


         $Crop->save();
         $Crop = Crop::where('Crops_Name' , $Crops_Name)->get('Image');
         print  $Crop;
         //print   '"Image" -> ' . $new_image_name  ;
        //return $this->sendResponse(new CropResource($Crop),'Crop update  successfully');
        return response()->json([
            'status' => 1,
            'msg' => 'Crop update  successfully'
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
