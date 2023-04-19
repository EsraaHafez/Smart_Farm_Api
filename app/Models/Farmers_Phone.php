<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmers_Phone extends Model
{
    use HasFactory;
    protected $table = 'mobile';
    public $incrementing = false;

    protected $fillable = [
        'id' ,
        'Farmer_id',
        'Mobile'



    ];

}
