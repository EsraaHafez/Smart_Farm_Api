<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Auth;
use App\Models\User;
use App\Models\Storage;

class StorageofClient extends JsonResource
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



            //'Buys_id' => $this->Buys_id   ,
            'user_'.'id' => $this->id   ,
            'Storge_id' => $this->Storge_id,

            //'user_'.'id' => Auth::User()->id  ,

        ];
    }
}
