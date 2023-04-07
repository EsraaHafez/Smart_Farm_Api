<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Harvest extends JsonResource
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

            'Harvest_id' => $this->Harvest_id  ,
            'Name' => $this->Name,
            'Harvest_Date' => $this->Harvest_Date  ,
            'Price' => $this->Price,
            'Type' => $this->Type  ,
            'Quantity' => $this->Quantity,



        ];
    }
}
