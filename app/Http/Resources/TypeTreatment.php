<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TypeTreatment extends JsonResource
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

            'Treatment_ID' => $this->Treatment_ID  ,
            'Name' => $this->Name,
            'Farmer_id' => $this->Farmer_id  ,
            'Disease_id' => $this->Disease_id



        ];
    }
}
