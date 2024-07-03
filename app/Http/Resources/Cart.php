<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Auth;
class Cart extends JsonResource
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
            'Cart_id' => $this->Cart_id ,
            'Name' => $this->Name,
            //'Image' => $this->Image,
            'Image'  => (asset('Carts/'.$this->Image)),
            'Quantity' => $this->Quantity,
            'Total_Price'=> $this->Price,
           // 'user_'.'id'=> $this->id,
            'user_'.'id'=> Auth::User()->id,



        ];
    }
}
 