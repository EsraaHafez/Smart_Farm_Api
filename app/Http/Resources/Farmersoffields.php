<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Farmersoffields extends JsonResource
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

            'id' => $this->id   ,
            'Field_id' => $this->Field_id   ,
            'Farmer_id' => $this->Farmer_id



        ];
    }
}
