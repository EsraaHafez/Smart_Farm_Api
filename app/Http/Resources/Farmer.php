<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Farmer extends JsonResource
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


            'Farmer_id' => $this->Farmer_id   ,
            'firstname' => $this->firstname  ,
            'lastname' => $this->lastname,
            'email' => $this->email  ,
            'Address' => $this->Address,
            'Harvest_id' => $this->Harvest_id   ,
            'Actor_Name' => $this->Actor_Name


        ];
    }
}
