<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Field extends JsonResource
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

            'Field_id' => $this->Field_id ,
            'Name' => $this->Name,
            'Last_Harvest_Date' => $this->Last_Harvest_Date,
            'Harvest_id' => $this->Harvest_id,




        ];
    }
}
