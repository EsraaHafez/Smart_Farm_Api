<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    use HasFactory;



    protected $fillable = [
        'Crops_Name',
        'Life_Cycle',
        'Temp',
        'Fertilisers',
        'Price',
        'Type',
        'Field_id',
        'Disease_id',

    ];


}
