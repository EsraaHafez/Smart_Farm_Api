<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmersoffields extends Model
{
    use HasFactory;
    protected $table = 'work';
    public $incrementing = false;



    protected $fillable = [
        'id' ,
        'Field_id',
        'Farmer_id'



    ];
}
