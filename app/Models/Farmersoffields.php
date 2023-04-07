<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmersoffields extends Model
{
    use HasFactory;
    protected $table = 'work';
   // protected $primaryKey = 'Farmer_id';


    protected $fillable = [
        'id' ,
        'Field_id',
        'Farmer_id'



    ];
}
