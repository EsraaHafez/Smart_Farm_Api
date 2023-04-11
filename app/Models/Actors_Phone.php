<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actors_Phone extends Model
{
    use HasFactory;
    protected $table = 'phone_actor';


    protected $fillable = [
        'id' ,
        'Actor_Name',
        'Phone'



    ];
}
