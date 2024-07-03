<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class Login extends JsonResource
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

            //'Login_id' => $this->Login_id   ,
            'Name' => $this->Name,
            'Password' => $this->Password ,
            //'Actor_Name' => $this->Actor_Name ,
            //'id' =>  $this->id



        ];




    }
}
