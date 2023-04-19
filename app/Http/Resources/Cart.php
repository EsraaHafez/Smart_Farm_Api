<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'Image' => $this->Image,
            'Quantity' => $this->Quantity,
            'Price'=> $this->Price,
            'user_'.'id'=> $this->id,




        ];
    }
}
