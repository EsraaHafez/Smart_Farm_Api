<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Crop extends JsonResource
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
            'Crops_Name' => $this->Crops_Name,
            'Life_Cycle' => $this->Life_Cycle,
            'Temp' => $this->Temp,
            'Fertilisers' => $this->Fertilisers,
            'Price' => $this->Price,
            'Type'=> $this->Type,
            'Image'=> $this->Image,
            'Field_id' => $this->Field_id,
            'Disease_id' => $this->Disease_id,



        ];
    }
}
