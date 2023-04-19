<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Auth;
use App\Models\User;

class CartUser extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [

            'Name' => $this->Name,
            'Quantity' => $this->Quantity,
            'Image' => $this->Image,
            'Price'=> $this->Price,
            //'user_'.'id'=> Auth::User()->id ,
        ];
    }
}
