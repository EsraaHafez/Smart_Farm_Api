<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HarvestofCrops extends JsonResource
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
            'Crops_Name' => $this->Crops_Name   ,
            'Harvest_id' => $this->Harvest_id  ,





        ];
    }
}
