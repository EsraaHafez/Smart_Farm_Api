<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    use HasFactory;

    protected $table = 'crops';
    protected $primaryKey = 'Crops_Name';
    public $incrementing = false;

    protected $fillable = [
        'Crops_Name',
        'Life_Cycle',
        'Temp',
        'Fertilisers',
        'Price',
        'Type',
        'Image',
        'Field_id',
        'Disease_id',

    ];


}
