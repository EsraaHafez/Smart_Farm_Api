<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Reasons_Disease extends JsonResource
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

            'id' => $this->id    ,
            'Disease_id' => $this->Disease_id    ,
            'Reasons' => $this->Reasons




        ];
    }
}
