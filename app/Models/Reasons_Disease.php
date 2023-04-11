<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reasons_Disease extends Model
{
    use HasFactory;
    protected $table = 'reasons';


    protected $fillable = [
        'id' ,
        'Disease_id',
        'Reasons'



    ];
}
