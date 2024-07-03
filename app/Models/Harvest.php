<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harvest extends Model
{
    use HasFactory;
 
    protected $table = 'harvest';
    protected $primaryKey = 'Harvest_id';


    protected $fillable = [
        'Name',
        'Harvest_Date',
        'Price',
        'Price',
        'Type',
        'Quantity',
        'Image',



    ];
}
