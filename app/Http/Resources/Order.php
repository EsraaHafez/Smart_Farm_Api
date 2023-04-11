<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       // return parent::toArray($request);

          return [

            'order_id' => $this->order_id  ,
            'Date' => $this->created_at,
            'Quantity' => $this->Quantity ,
            'Total_Price' => $this->Total_Price ,
            'user_'.'id' => $this->Total_Price,
            'Cart_id' => $this->Cart_id ,



        ];
    }
}
