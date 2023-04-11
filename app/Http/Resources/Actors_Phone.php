<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Actors_Phone extends JsonResource
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
            'Actor_Name' => $this->Actor_Name   ,
            'Phone' => $this->Phone




        ];
    }
}
