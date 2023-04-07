<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Storage extends JsonResource
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

        'Storge_id' => $this->Storge_id  ,
        'Size' => $this->Size,
        'Availability' => $this->Availability ,




    ];
    }
}
